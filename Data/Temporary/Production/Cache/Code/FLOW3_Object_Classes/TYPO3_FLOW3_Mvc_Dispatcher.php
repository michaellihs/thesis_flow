<?php
namespace TYPO3\FLOW3\Mvc;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Dispatches requests to the controller which was specified by the request and
 * returns the response the controller generated.
 * @\TYPO3\FLOW3\Annotations\Scope("singleton")
 */
class Dispatcher extends Dispatcher_Original implements \TYPO3\FLOW3\Object\Proxy\ProxyInterface {

	private $FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices = array();

	private $FLOW3_Aop_Proxy_groupedAdviceChains = array();

	private $FLOW3_Aop_Proxy_methodIsInAdviceMode = array();


	/**
	 * Autogenerated Proxy Method
	 */
	public function __construct() {

		$this->FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();
		if (get_class($this) === 'TYPO3\FLOW3\Mvc\Dispatcher') \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->setInstance('TYPO3\FLOW3\Mvc\Dispatcher', $this);
		$this->FLOW3_Proxy_injectProperties();
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 protected function FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray() {
		if (method_exists(get_parent_class($this), 'FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray') && is_callable('parent::FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray')) parent::FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();

		$objectManager = \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager;
		$this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices = array(
			'dispatch' => array(
				'TYPO3\FLOW3\Aop\Advice\AroundAdvice' => array(
					new \TYPO3\FLOW3\Aop\Advice\AroundAdvice('TYPO3\FLOW3\Security\Aspect\RequestDispatchingAspect', 'blockIllegalRequestsAndForwardToAuthenticationEntryPoints', $objectManager, NULL),
					new \TYPO3\FLOW3\Aop\Advice\AroundAdvice('TYPO3\FLOW3\Security\Aspect\RequestDispatchingAspect', 'setAccessDeniedResponseHeader', $objectManager, NULL),
				),
			),
			'emitBeforeControllerInvocation' => array(
				'TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice' => array(
					new \TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice('TYPO3\FLOW3\SignalSlot\SignalAspect', 'forwardSignalToDispatcher', $objectManager, NULL),
				),
			),
			'emitAfterControllerInvocation' => array(
				'TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice' => array(
					new \TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice('TYPO3\FLOW3\SignalSlot\SignalAspect', 'forwardSignalToDispatcher', $objectManager, NULL),
				),
			),
		);
	}

	/**
	 * Autogenerated Proxy Method
	 */
	 public function __wakeup() {

		$this->FLOW3_Aop_Proxy_buildMethodsAndAdvicesArray();
		if (get_class($this) === 'TYPO3\FLOW3\Mvc\Dispatcher') \TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->setInstance('TYPO3\FLOW3\Mvc\Dispatcher', $this);

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
				$this->FLOW3_Proxy_injectProperties();
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
	 * @param \TYPO3\FLOW3\Mvc\RequestInterface $request The request to dispatch
	 * @param \TYPO3\FLOW3\Mvc\ResponseInterface $response The response, to be modified by the controller
	 * @return void
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InfiniteLoopException
	 */
	 public function dispatch(\TYPO3\FLOW3\Mvc\RequestInterface $request, \TYPO3\FLOW3\Mvc\ResponseInterface $response) {

				// FIXME this can be removed again once Doctrine is fixed (see fixMethodsAndAdvicesArrayForDoctrineProxiesCode())
			$this->FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies();
		if (isset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['dispatch'])) {
		$result = parent::dispatch($request, $response);

		} else {
			$this->FLOW3_Aop_Proxy_methodIsInAdviceMode['dispatch'] = TRUE;
			try {
			
					$methodArguments = array();

				$methodArguments['request'] = $request;
				$methodArguments['response'] = $response;
			
					$adviceChains = $this->FLOW3_Aop_Proxy_getAdviceChains('dispatch');
					$adviceChain = $adviceChains['TYPO3\FLOW3\Aop\Advice\AroundAdvice'];
					$adviceChain->rewind();
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Mvc\Dispatcher', 'dispatch', $methodArguments, $adviceChain);
					$result = $adviceChain->proceed($joinPoint);

			} catch(\Exception $e) {
				unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['dispatch']);
				throw $e;
			}
			unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['dispatch']);
		}
		return $result;
	}

	/**
	 * Autogenerated Proxy Method
	 * @param \TYPO3\FLOW3\Mvc\RequestInterface $request
	 * @param \TYPO3\FLOW3\Mvc\ResponseInterface $response
	 * @param \TYPO3\FLOW3\Mvc\Controller\ControllerInterface $controller
	 * @return void
	 * @\TYPO3\FLOW3\Annotations\Signal
	 */
	 protected function emitBeforeControllerInvocation(\TYPO3\FLOW3\Mvc\RequestInterface $request, \TYPO3\FLOW3\Mvc\ResponseInterface $response, \TYPO3\FLOW3\Mvc\Controller\ControllerInterface $controller) {

				// FIXME this can be removed again once Doctrine is fixed (see fixMethodsAndAdvicesArrayForDoctrineProxiesCode())
			$this->FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies();
		if (isset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitBeforeControllerInvocation'])) {
		$result = parent::emitBeforeControllerInvocation($request, $response, $controller);

		} else {
			$this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitBeforeControllerInvocation'] = TRUE;
			try {
			
					$methodArguments = array();

				$methodArguments['request'] = $request;
				$methodArguments['response'] = $response;
				$methodArguments['controller'] = $controller;
			
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Mvc\Dispatcher', 'emitBeforeControllerInvocation', $methodArguments);
					$result = $this->FLOW3_Aop_Proxy_invokeJoinPoint($joinPoint);

					$advices = $this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices['emitBeforeControllerInvocation']['TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice'];
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Mvc\Dispatcher', 'emitBeforeControllerInvocation', $joinPoint->getMethodArguments(), NULL, $result);
					foreach ($advices as $advice) {
						$advice->invoke($joinPoint);
					}

			} catch(\Exception $e) {
				unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitBeforeControllerInvocation']);
				throw $e;
			}
			unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitBeforeControllerInvocation']);
		}
		return $result;
	}

	/**
	 * Autogenerated Proxy Method
	 * @param \TYPO3\FLOW3\Mvc\RequestInterface $request
	 * @param \TYPO3\FLOW3\Mvc\ResponseInterface $response
	 * @param \TYPO3\FLOW3\Mvc\Controller\ControllerInterface $controller
	 * @return void
	 * @\TYPO3\FLOW3\Annotations\Signal
	 */
	 protected function emitAfterControllerInvocation(\TYPO3\FLOW3\Mvc\RequestInterface $request, \TYPO3\FLOW3\Mvc\ResponseInterface $response, \TYPO3\FLOW3\Mvc\Controller\ControllerInterface $controller) {

				// FIXME this can be removed again once Doctrine is fixed (see fixMethodsAndAdvicesArrayForDoctrineProxiesCode())
			$this->FLOW3_Aop_Proxy_fixMethodsAndAdvicesArrayForDoctrineProxies();
		if (isset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitAfterControllerInvocation'])) {
		$result = parent::emitAfterControllerInvocation($request, $response, $controller);

		} else {
			$this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitAfterControllerInvocation'] = TRUE;
			try {
			
					$methodArguments = array();

				$methodArguments['request'] = $request;
				$methodArguments['response'] = $response;
				$methodArguments['controller'] = $controller;
			
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Mvc\Dispatcher', 'emitAfterControllerInvocation', $methodArguments);
					$result = $this->FLOW3_Aop_Proxy_invokeJoinPoint($joinPoint);

					$advices = $this->FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices['emitAfterControllerInvocation']['TYPO3\FLOW3\Aop\Advice\AfterReturningAdvice'];
					$joinPoint = new \TYPO3\FLOW3\Aop\JoinPoint($this, 'TYPO3\FLOW3\Mvc\Dispatcher', 'emitAfterControllerInvocation', $joinPoint->getMethodArguments(), NULL, $result);
					foreach ($advices as $advice) {
						$advice->invoke($joinPoint);
					}

			} catch(\Exception $e) {
				unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitAfterControllerInvocation']);
				throw $e;
			}
			unset($this->FLOW3_Aop_Proxy_methodIsInAdviceMode['emitAfterControllerInvocation']);
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
	$reflectedClass = new \ReflectionClass('TYPO3\FLOW3\Mvc\Dispatcher');
	$allReflectedProperties = $reflectedClass->getProperties();
	foreach ($allReflectedProperties as $reflectionProperty) {
		$propertyName = $reflectionProperty->name;
		if (in_array($propertyName, array('FLOW3_Aop_Proxy_targetMethodsAndGroupedAdvices', 'FLOW3_Aop_Proxy_groupedAdviceChains', 'FLOW3_Aop_Proxy_methodIsInAdviceMode'))) continue;
		if ($reflectionService->isPropertyTaggedWith('TYPO3\FLOW3\Mvc\Dispatcher', $propertyName, 'transient')) continue;
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

	/**
	 * Autogenerated Proxy Method
	 */
	 private function FLOW3_Proxy_injectProperties() {
		$this->injectObjectManager(\TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Object\ObjectManagerInterface'));
		$this->injectSettings(\TYPO3\FLOW3\Core\Bootstrap::$staticObjectManager->get('TYPO3\FLOW3\Configuration\ConfigurationManager')->getConfiguration(\TYPO3\FLOW3\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'TYPO3.FLOW3'));
	}
}
#