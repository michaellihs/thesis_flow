<?php
namespace TYPO3\FLOW3\Security;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * An account model
 * @\TYPO3\FLOW3\Annotations\Entity
 */
class Account extends Account_Original implements \TYPO3\FLOW3\Object\Proxy\ProxyInterface, \TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicInterface {

	/**
	 * @var string
	 * @ORM\Id
	 * @ORM\Column(length=40)
	 * introduced by TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicAspect
	 */
	protected $FLOW3_Persistence_Identifier = NULL;

	private $FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices = array();

	private $FLOW3_Aop_Proxy_groupedAdviceChains = array();

	private $FLOW3_Aop_Proxy_methodIsInAdviceMode = array();


	/**
	 * Autogenerated Proxy Method
	 */
	public function __construct() {

		$this->FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();

			if (isset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__construct'])) {
		parent::__construct();

			} else {
				$this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__construct'] = TRUE;
				try {
				
					$methodArguments = array();

					$advices = $this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices['__construct']['TYPO3\FLOW3\Aop\Advice\BeforeAdvice'];
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Security\Account', '__construct', $methodArguments);
					foreach ($advices as $advice) {
						$advice->invoke($joinPoint);
					}

					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Security\Account', '__construct', $joinPoint->getMethodArguments());
					$result = $this->FLOW3_Aop_Proxy_invokeJoinPoint($joinPoint);

				} catch(\Exception $e) {
					unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__construct']);
					throw $e;
				}
				unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__construct']);
				return;
			}
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 protected function FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray() {
		if (method_exists(get_parent_class($this), 'FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray') && is_callable('parent::FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray')) parent::FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();

		$objectManager = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager;
		$this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices = array(
			'__clone' => array(
				'TYPO3\FLOW3\Aop\Advice\BeforeAdvice' => array(
					new \TYPO3\FLOW3\Aop\Advice\BeforeAdvice('TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicAspect', 'generateUuid', $objectManager, NULL),
				),
				'TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice' => array(
					new \TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice('TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicAspect', 'cloneObject', $objectManager, NULL),
				),
			),
			'__construct' => array(
				'TYPO3\FLOW3\Aop\Advice\BeforeAdvice' => array(
					new \TYPO3\FLOW3\Aop\Advice\BeforeAdvice('TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicAspect', 'generateUuid', $objectManager, NULL),
				),
			),
		);
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function __wakeup() {

		$this->FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();

	if (property_exists($this, 'FLOW3_Persistence_RelatedEntities') && is_array($this->FLOW3_Persistence_RelatedEntities)) {
		$persistenceManager = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Persistence\PersistenceManagerInterface');
		foreach ($this->FLOW3_Persistence_RelatedEntities as $entityInformation) {
			$entity = $persistenceManager->getObjectByIdentifier($entityInformation['identifier'], $entityInformation['entityType'], TRUE);
			if (isset($entityInformation['entityPath'])) {
				$this->$entityInformation['propertyName'] = \TYPO3\FLOW3\Utility\Arrays::setValueByPath($this->$entityInformation['propertyName'], $entityInformation['entityPath'], $entity);
			} else {
				$this->$entityInformation['propertyName'] = $entity;
			}
		}
		unset($this->FLOW3_Persistence_RelatedEntities);
	}
				$result = NULL;
		if (method_exists(get_parent_class($this), '__wakeup') && is_callable('parent::__wakeup')) parent::__wakeup();
		return $result;
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies() {
		if (!isset($this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices) || empty($this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices)) {
			$this->FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();
			if (is_callable('parent::FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies')) parent::FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies();
		}	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function FLOW3_Aop_Proxy_fixInjectedPropertiesForDoctrineProxies() {
		if (!$this instanceof \Doctrine\ORM\Proxy\Proxy || isset($this->FLOW3_Proxy_injectProperties_fixInjectedPropertiesForDoctrineProxies)) {
			return;
		}
		$this->FLOW3_Proxy_injectProperties_fixInjectedPropertiesForDoctrineProxies = TRUE;
		if (is_callable(array($this, 'FLOW3_Proxy_injectProperties'))) {
			$this->FLOW3_Proxy_injectProperties();
		}	}

	/**
	 * Autogenerated Proxy Method
	 */
	 private function FLOW3_Aop_Proxy_getAdviceChains($methodName) {
		$adviceChains = array();
		if (isset($this->FLOW3_Aop_Proxy_groupedAdviceChains[$methodName])) {
			$adviceChains = $this->FLOW3_Aop_Proxy_groupedAdviceChains[$methodName];
		} else {
			if (isset($this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices[$methodName])) {
				$groupedAdvices = $this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices[$methodName];
				if (isset($groupedAdvices['TYPO3\FLOW3\Aop\Advice\AroundAdvice'])) {
					$this->FLOW3_Aop_Proxy_groupedAdviceChains[$methodName]['TYPO3\FLOW3\Aop\Advice\AroundAdvice'] = new \TYPO3\FLOW3\Aop\Advice\AdviceChain($groupedAdvices['TYPO3\FLOW3\Aop\Advice\AroundAdvice']);
					$adviceChains = $this->FLOW3_Aop_Proxy_groupedAdviceChains[$methodName];
				}
			}
		}
		return $adviceChains;
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function FLOW3_Aop_Proxy_invokeJoinPoint(\TYPO3\FLOW3\Aop\JoinPointInterface $joinPoint) {
		if (__CLASS__ !== $joinPoint->getClassName()) return parent::FLOW3_Aop_Proxy_invokeJoinPoint($joinPoint);
		if (isset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode[$joinPoint->getMethodName()])) {
			return call_user_func_array(array('self', $joinPoint->getMethodName()), $joinPoint->getMethodArguments());
		}
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function __clone() {

				// FIXME this can be removed again once Doctrine is fixed (see fixMethodsAndAdvicesArrayForDoctrineProxiesCode())
			$this->FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies();
		if (isset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__clone'])) {
		$result = NULL;

		} else {
			$this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__clone'] = TRUE;
			try {
			
					$methodArguments = array();

					$advices = $this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices['__clone']['TYPO3\FLOW3\Aop\Advice\BeforeAdvice'];
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Security\Account', '__clone', $methodArguments);
					foreach ($advices as $advice) {
						$advice->invoke($joinPoint);
					}

					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Security\Account', '__clone', $joinPoint->getMethodArguments());
					$result = $this->FLOW3_Aop_Proxy_invokeJoinPoint($joinPoint);

					$advices = $this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices['__clone']['TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice'];
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Security\Account', '__clone', $joinPoint->getMethodArguments(), NULL, $result);
					foreach ($advices as $advice) {
						$advice->invoke($joinPoint);
					}

			} catch(\Exception $e) {
				unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__clone']);
				throw $e;
			}
			unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['__clone']);
		}
		return $result;
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function __sleep() {
		$result = NULL;
		$this->FLOW3_Object_PropertiesToSerialize = array();
	$reflectionService = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Reflection\ReflectionService');
	$reflectedClass = new \ReflectionClass('TYPO3\FLOW3\Security\Account');
	$allReflectedProperties = $reflectedClass->getProperties();
	foreach ($allReflectedProperties as $reflectionProperty) {
		$propertyName = $reflectionProperty->name;
		if (in_array($propertyName, array('FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices', 'FLOW3_Aop_Proxy_groupedAdviceChains', 'FLOW3_Aop_Proxy_methodIsInAdviceMode'))) continue;
		if ($reflectionService->isPropertyTaggedWith('TYPO3\FLOW3\Security\Account', $propertyName, 'transient')) continue;
		if (is_array($this->$propertyName) || (is_object($this->$propertyName) && ($this->$propertyName instanceof \ArrayObject || $this->$propertyName instanceof \SplObjectStorage ||$this->$propertyName instanceof \Doctrine\Common\Collections\Collection))) {
			foreach ($this->$propertyName as $key => $value) {
				$this->searchForEntitiesAndStoreIdentifierArray((string)$key, $value, $propertyName);
			}
		}
		if (is_object($this->$propertyName) && !$this->$propertyName instanceof \Doctrine\Common\Collections\Collection) {
			if ($this->$propertyName instanceof \Doctrine\ORM\Proxy\Proxy) {
				$className = get_parent_class($this->$propertyName);
			} else {
				$className = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->getObjectNameByClassName(get_class($this->$propertyName));
			}
			if ($this->$propertyName instanceof \TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicInterface && !\TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Persistence\PersistenceManagerInterface')->isNewObject($this->$propertyName) || $this->$propertyName instanceof \Doctrine\ORM\Proxy\Proxy) {
				if (!property_exists($this, 'FLOW3_Persistence_RelatedEntities') || !is_array($this->FLOW3_Persistence_RelatedEntities)) {
					$this->FLOW3_Persistence_RelatedEntities = array();
					$this->FLOW3_Object_PropertiesToSerialize[] = 'FLOW3_Persistence_RelatedEntities';
				}
				$identifier = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Persistence\PersistenceManagerInterface')->getIdentifierByObject($this->$propertyName);
				if (!$identifier && $this->$propertyName instanceof \Doctrine\ORM\Proxy\Proxy) {
					$identifier = current(\TYPO3\FLOW3\Reflection\ObjectAccess::getProperty($this->$propertyName, '_identifier', TRUE));
				}
				$this->FLOW3_Persistence_RelatedEntities[$propertyName] = array(
					'propertyName' => $propertyName,
					'entityType' => $className,
					'identifier' => $identifier
				);
				continue;
			}
			if ($className !== FALSE && \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->getScope($className) === \TYPO3\FLOW3\Object\Configuration\Configuration::SCOPE_SINGLETON) {
				continue;
			}
		}
		$this->FLOW3_Object_PropertiesToSerialize[] = $propertyName;
	}
	$result = $this->FLOW3_Object_PropertiesToSerialize;
		return $result;
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 private function searchForEntitiesAndStoreIdentifierArray($path, $propertyValue, $originalPropertyName) {

		if (is_array($propertyValue) || (is_object($propertyValue) && ($propertyValue instanceof \ArrayObject || $propertyValue instanceof \SplObjectStorage))) {
			foreach ($propertyValue as $key => $value) {
				$this->searchForEntitiesAndStoreIdentifierArray($path . '.' . $key, $value, $originalPropertyName);
			}
		} elseif ($propertyValue instanceof \TYPO3\FLOW3\Persistence\Aspect\PersistenceMagicInterface && !\TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Persistence\PersistenceManagerInterface')->isNewObject($propertyValue) || $propertyValue instanceof \Doctrine\ORM\Proxy\Proxy) {
			if (!property_exists($this, 'FLOW3_Persistence_RelatedEntities') || !is_array($this->FLOW3_Persistence_RelatedEntities)) {
				$this->FLOW3_Persistence_RelatedEntities = array();
				$this->FLOW3_Object_PropertiesToSerialize[] = 'FLOW3_Persistence_RelatedEntities';
			}
			if ($propertyValue instanceof \Doctrine\ORM\Proxy\Proxy) {
				$className = get_parent_class($propertyValue);
			} else {
				$className = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->getObjectNameByClassName(get_class($propertyValue));
			}
			$identifier = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Persistence\PersistenceManagerInterface')->getIdentifierByObject($propertyValue);
			if (!$identifier && $propertyValue instanceof \Doctrine\ORM\Proxy\Proxy) {
				$identifier = current(\TYPO3\FLOW3\Reflection\ObjectAccess::getProperty($propertyValue, '_identifier', TRUE));
			}
			$this->FLOW3_Persistence_RelatedEntities[$originalPropertyName . '.' . $path] = array(
				'propertyName' => $originalPropertyName,
				'entityType' => $className,
				'identifier' => $identifier,
				'entityPath' => $path
			);
			$this->$originalPropertyName = \TYPO3\FLOW3\Utility\Arrays::setValueByPath($this->$originalPropertyName, $path, NULL);
		}
			}
}
#