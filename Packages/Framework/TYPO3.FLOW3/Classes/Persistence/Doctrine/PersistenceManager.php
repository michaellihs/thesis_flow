<?php
namespace TYPO3\FLOW3\Persistence\Doctrine;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * FLOW3's Doctrine PersistenceManager
 *
 * @FLOW3\Scope("singleton")
 * @api
 */
class PersistenceManager extends \TYPO3\FLOW3\Persistence\AbstractPersistenceManager {

	/**
	 * @var \TYPO3\FLOW3\Log\SystemLoggerInterface
	 */
	protected $systemLogger;

	/**
	 * @var \Doctrine\Common\Persistence\ObjectManager
	 */
	protected $entityManager;

	/**
	 * @var \TYPO3\FLOW3\Validation\ValidatorResolver
	 */
	protected $validatorResolver;

	/**
	 * @var \TYPO3\FLOW3\Reflection\ReflectionService
	 */
	protected $reflectionService;

	/**
	 * @param \Doctrine\Common\Persistence\ObjectManager $entityManager
	 * @return void
	 */
	public function injectEntityManager(\Doctrine\Common\Persistence\ObjectManager $entityManager) {
		$this->entityManager = $entityManager;
	}

	/**
	 * @param \TYPO3\FLOW3\Log\SystemLoggerInterface $systemLogger
	 * @return void
	 */
	public function injectSystemLogger(\TYPO3\FLOW3\Log\SystemLoggerInterface $systemLogger) {
		$this->systemLogger = $systemLogger;
	}

	/**
	 * @param \TYPO3\FLOW3\Validation\ValidatorResolver $validatorResolver
	 * @return void
	 */
	public function injectValidatorResolver(\TYPO3\FLOW3\Validation\ValidatorResolver $validatorResolver) {
		$this->validatorResolver = $validatorResolver;
	}

	/**
	 * @param \TYPO3\FLOW3\Reflection\ReflectionService $reflectionService
	 * @return void
	 */
	public function injectReflectionService(\TYPO3\FLOW3\Reflection\ReflectionService $reflectionService) {
		$this->reflectionService = $reflectionService;
	}

	/**
	 * Initializes the persistence manager, called by FLOW3.
	 *
	 * @return void
	 */
	public function initialize() {
		$this->entityManager->getEventManager()->addEventListener(array(\Doctrine\ORM\Events::onFlush), $this);
	}

	/**
	 * An onFlush event listener used to validate entities upon persistence.
	 *
	 * @param \Doctrine\ORM\Event\OnFlushEventArgs $eventArgs
	 * @return void
	 */
	public function onFlush(\Doctrine\ORM\Event\OnFlushEventArgs $eventArgs) {
		$unitOfWork = $this->entityManager->getUnitOfWork();
		$entityInsertions = $unitOfWork->getScheduledEntityInsertions();

		$validatedInstancesContainer = new \SplObjectStorage();
		$knownValueObjects = array();
		foreach ($entityInsertions as $entity) {
			if ($this->reflectionService->getClassSchema($entity)->getModelType() === \TYPO3\FLOW3\Reflection\ClassSchema::MODELTYPE_VALUEOBJECT) {
				$identifier = $this->getIdentifierByObject($entity);
				$className = $this->reflectionService->getClassNameByObject($entity);

				if (isset($knownValueObjects[$className][$identifier]) || $unitOfWork->getEntityPersister($className)->exists($entity)) {
					unset($entityInsertions[spl_object_hash($entity)]);
					continue;
				}

				$knownValueObjects[$className][$identifier] = TRUE;
			}
			$this->validateObject($entity, $validatedInstancesContainer);
		}

		\TYPO3\FLOW3\Reflection\ObjectAccess::setProperty($unitOfWork, 'entityInsertions', $entityInsertions, TRUE);

		foreach ($unitOfWork->getScheduledEntityUpdates() AS $entity) {
			$this->validateObject($entity, $validatedInstancesContainer);
		}
	}

	/**
	 * Validates the given object and throws an exception if validation fails.
	 *
	 * @param object $object
	 * @return void
	 * @throws \TYPO3\FLOW3\Persistence\Exception\ObjectValidationFailedException
	 */
	protected function validateObject($object, \SplObjectStorage $validatedInstancesContainer) {
		$className = $this->entityManager->getClassMetadata(get_class($object))->getName();
		$validator = $this->validatorResolver->getBaseValidatorConjunction($className, array('Persistence', 'Default'));
		if ($validator === NULL) return;

		$validator->setValidatedInstancesContainer($validatedInstancesContainer);
		$validationResult = $validator->validate($object);
		if ($validationResult->hasErrors()) {
			$errorMessages = '';
			$allErrors = $validationResult->getFlattenedErrors();
			foreach ($allErrors as $path => $errors) {
				$errorMessages .= $path . ':' . PHP_EOL;
				foreach ($errors as $error) {
					$errorMessages .= (string)$error . PHP_EOL;
				}
			}
			throw new \TYPO3\FLOW3\Persistence\Exception\ObjectValidationFailedException('An instance of "' . get_class($object) . '" failed to pass validation with ' . count($errors) . ' error(s): ' . PHP_EOL . $errorMessages, 1322585164);
		}
	}

	/**
	 * Commits new objects and changes to objects in the current persistence
	 * session into the backend
	 *
	 * @return void
	 * @api
	 */
	public function persistAll() {
		if ($this->entityManager->isOpen()) {
			$this->entityManager->flush();
			$this->emitAllObjectsPersisted();
		} else {
			$this->systemLogger->log('persistAll() skipped flushing data, the Doctrine EntityManager is closed. Check the logs for error message.', LOG_ERR);
		}
	}

	/**
	 * Clears the in-memory state of the persistence.
	 *
	 * Managed instances become detached, any fetches will
	 * return data directly from the persistence "backend".
	 *
	 * @return void
	 */
	public function clearState() {
		parent::clearState();
		$this->entityManager->clear();
	}

	/**
	 * Checks if the given object has ever been persisted.
	 *
	 * @param object $object The object to check
	 * @return boolean TRUE if the object is new, FALSE if the object exists in the repository
	 * @api
	 */
	public function isNewObject($object) {
		return ($this->entityManager->getUnitOfWork()->getEntityState($object, \Doctrine\ORM\UnitOfWork::STATE_NEW) === \Doctrine\ORM\UnitOfWork::STATE_NEW);
	}

	/**
	 * Returns the (internal) identifier for the object, if it is known to the
	 * backend. Otherwise NULL is returned.
	 *
	 * Note: this returns an identifier even if the object has not been
	 * persisted in case of AOP-managed entities. Use isNewObject() if you need
	 * to distinguish those cases.
	 *
	 * @param object $object
	 * @return mixed The identifier for the object if it is known, or NULL
	 * @api
	 * @todo improve try/catch block
	 */
	public function getIdentifierByObject($object) {
		if ($this->entityManager->contains($object)) {
			try {
				return current($this->entityManager->getUnitOfWork()->getEntityIdentifier($object));
			} catch (\Doctrine\ORM\ORMException $e) {
				return NULL;
			}
		} elseif (property_exists($object, 'FLOW3_Persistence_Identifier')) {
			return \TYPO3\FLOW3\Reflection\ObjectAccess::getProperty($object, 'FLOW3_Persistence_Identifier', TRUE);
		} else {
			return NULL;
		}
	}

	/**
	 * Returns the object with the (internal) identifier, if it is known to the
	 * backend. Otherwise NULL is returned.
	 *
	 * @param mixed $identifier
	 * @param string $objectType
	 * @param boolean $useLazyLoading Set to TRUE if you want to use lazy loading for this object
	 * @return object The object for the identifier if it is known, or NULL
	 * @throws \RuntimeException
	 * @api
	 */
	public function getObjectByIdentifier($identifier, $objectType = NULL, $useLazyLoading = FALSE) {
		if ($objectType === NULL) {
			throw new \RuntimeException('Using only the identifier is not supported by Doctrine 2. Give classname as well or use repository to query identifier.', 1296646103);
		}
		if (isset($this->newObjects[$identifier])) {
			return $this->newObjects[$identifier];
		}
		if ($useLazyLoading === TRUE) {
			return $this->entityManager->getReference($objectType, $identifier);
		} else {
			return $this->entityManager->find($objectType, $identifier);
		}
	}

	/**
	 * Return a query object for the given type.
	 *
	 * @param string $type
	 * @return \TYPO3\FLOW3\Persistence\Doctrine\Query
	 */
	public function createQueryForType($type) {
		return new \TYPO3\FLOW3\Persistence\Doctrine\Query($type);
	}

	/**
	 * Adds an object to the persistence.
	 *
	 * @param object $object The object to add
	 * @return void
	 * @throws \TYPO3\FLOW3\Persistence\Exception\KnownObjectException if the given $object is not new
	 * @throws \TYPO3\FLOW3\Persistence\Exception if another error occurs
	 * @api
	 */
	public function add($object) {
		if (!$this->isNewObject($object)) {
			throw new \TYPO3\FLOW3\Persistence\Exception\KnownObjectException('The object of type "' . get_class($object) . '" (identifier: "' . $this->getIdentifierByObject($object) . '") which was passed to EntityManager->add() is not a new object. Check the code which adds this entity to the repository and make sure that only objects are added which were not persisted before. Alternatively use update() for updating existing objects."', 1337934295);
		} else {
			try {
				$this->entityManager->persist($object);
			} catch (\Exception $exception) {
				throw new \TYPO3\FLOW3\Persistence\Exception('Could not add object of type "' . get_class($object) . '"', 1337934455, $exception);
			}
		}
	}

	/**
	 * Removes an object to the persistence.
	 *
	 * @param object $object The object to remove
	 * @return void
	 * @api
	 */
	public function remove($object) {
		$this->entityManager->remove($object);
	}

	/**
	 * Update an object in the persistence.
	 *
	 * @param object $object The modified object
	 * @return void
	 * @throws \TYPO3\FLOW3\Persistence\Exception\UnknownObjectException if the given $object is new
	 * @throws \TYPO3\FLOW3\Persistence\Exception if another error occurs
	 * @api
	 */
	public function update($object) {
		if ($this->isNewObject($object)) {
			throw new \TYPO3\FLOW3\Persistence\Exception\UnknownObjectException('The object of type "' . get_class($object) . '" (identifier: "' . $this->getIdentifierByObject($object) . '") which was passed to EntityManager->update() is not a previously persisted object. Check the code which updates this entity and make sure that only objects are updated which were persisted before. Alternatively use add() for persisting new objects."', 1313663277);
		}
		try {
			$this->entityManager->persist($object);
		} catch (\Exception $exception) {
			throw new \TYPO3\FLOW3\Persistence\Exception('Could not merge object of type "' . get_class($object) . '"', 1297778180, $exception);
		}
	}

	/**
	 * Called from functional tests, creates/updates database tables and compiles proxies.
	 *
	 * @return boolean
	 */
	public function compile() {
			// "driver" is used only for Doctrine, thus we (mis-)use it here
			// additionally, when no path is set, skip this step, assuming no DB is needed
		if ($this->settings['backendOptions']['driver'] !== NULL && $this->settings['backendOptions']['path'] !== NULL) {
			$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
			if ($this->settings['backendOptions']['driver'] === 'pdo_sqlite') {
				$schemaTool->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
			} else {
				$schemaTool->updateSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
			}

			$proxyFactory = $this->entityManager->getProxyFactory();
			$proxyFactory->generateProxyClasses($this->entityManager->getMetadataFactory()->getAllMetadata());

			$this->systemLogger->log('Doctrine 2 setup finished');
			return TRUE;
		} else {
			$this->systemLogger->log('Doctrine 2 setup skipped, driver and path backend options not set!', LOG_NOTICE);
			return FALSE;
		}
	}

	/**
	 * Called after a functional test in FLOW3, dumps everything in the database.
	 *
	 * @return void
	 */
	public function tearDown() {
			// "driver" is used only for Doctrine, thus we (mis-)use it here
			// additionally, when no path is set, skip this step, assuming no DB is needed
		if ($this->settings['backendOptions']['driver'] !== NULL && $this->settings['backendOptions']['path'] !== NULL) {
			$this->entityManager->clear();

			$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
			$schemaTool->dropDatabase();
			$this->systemLogger->log('Doctrine 2 schema destroyed.', LOG_NOTICE);
		} else {
			$this->systemLogger->log('Doctrine 2 destroy skipped, driver and path backend options not set!', LOG_NOTICE);
		}
	}

	/**
	 * Signals that all persistAll() has been executed successfully.
	 *
	 * @FLOW3\Signal
	 * @return void
	 */
	protected function emitAllObjectsPersisted() {
	}

}

?>