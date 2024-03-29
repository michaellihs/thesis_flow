<?php
namespace TYPO3\FLOW3\Mvc;

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
use TYPO3\FLOW3\Http\Uri;
use TYPO3\FLOW3\Http\Request as HttpRequest;

/**
 * Represents an internal request targeted to a controller action
 *
 * @api
 */
class ActionRequest implements RequestInterface {

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\FLOW3\Security\Cryptography\HashService
	 * @FLOW3\Inject
	 */
	protected $hashService;

	/**
	 * Package key of the controller which is supposed to handle this request.
	 * @var string
	 */
	protected $controllerPackageKey = NULL;

	/**
	 * Subpackage key of the controller which is supposed to handle this request.
	 * @var string
	 */
	protected $controllerSubpackageKey = NULL;

	/**
	 * Object name of the controller which is supposed to handle this request.
	 * @var string
	 */
	protected $controllerName = NULL;

	/**
	 * Name of the action the controller is supposed to take.
	 * @var string
	 */
	protected $controllerActionName = NULL;

	/**
	 * The arguments for this request. They must be only simple types, no
	 * objects allowed.
	 * @var array
	 */
	protected $arguments = array();

	/**
	 * Framework-internal arguments for this request, such as __referrer.
	 * All framework-internal arguments start with double underscore (__),
	 * and are only used from within the framework. Not for user consumption.
	 * Internal Arguments can be objects, in contrast to public arguments.
	 * @var array
	 */
	protected $internalArguments = array();

	/**
	 * Arguments and configuration for plugins – including widgets – which are
	 * sub controllers to the controller referred to by this request.
	 * @var array
	 */
	protected $pluginArguments = array();

	/**
	 * An optional namespace for arguments of this request. Used, for example, in
	 * plugins and widgets.
	 * @var string
	 */
	protected $argumentNamespace = '';

	/**
	 * The requested representation format
	 * @var string
	 */
	protected $format = NULL;

	/**
	 * If this request has been changed and needs to be dispatched again
	 * @var boolean
	 */
	protected $dispatched = FALSE;

	/**
	 * The parent request – either another ActionRequest or Http Request
	 * @var object
	 */
	protected $parentRequest;

	/**
	 * Cached pointer to the root request (usually an HTTP request)
	 * @var object
	 */
	protected $rootRequest;

	/**
	 * Cached pointer to a request referring to this one (if any)
	 * @var \TYPO3\FLOW3\Mvc\ActionRequest
	 */
	protected $referringRequest;

	/**
	 * Constructs this action request
	 *
	 * @param object $parentRequest Either an HTTP request or another ActionRequest
	 * @api
	 */
	public function __construct($parentRequest) {
		if (!$parentRequest instanceof HttpRequest && !$parentRequest instanceof ActionRequest) {
			throw new \InvalidArgumentException('The parent request passed to ActionRequest::__construct() must be either an HTTP request or another ActionRequest', 1327846149);
		}
		$this->parentRequest = $parentRequest;
	}

	/**
	 * Returns the parent request
	 *
	 * @return object
	 * @api
	 */
	public function getParentRequest() {
		return $this->parentRequest;
	}

	/**
	 * Returns the top level request: the HTTP request object
	 *
	 * @return \TYPO3\FLOW3\Http\Request
	 * @api
	 */
	public function getHttpRequest() {
		if ($this->rootRequest === NULL) {
			$this->rootRequest = ($this->parentRequest instanceof HttpRequest) ? $this->parentRequest : $this->parentRequest->getHttpRequest();
		}
		return $this->rootRequest;
	}

	/**
	 * Returns the top level ActionRequest: the one just below the HTTP request
	 *
	 * @return \TYPO3\FLOW3\Mvc\ActionRequest
	 * @api
	 */
	public function getMainRequest() {
		return ($this->parentRequest instanceof HttpRequest) ? $this : $this->parentRequest->getMainRequest();
	}

	/**
	 * Checks if this request is the uppermost ActionRequest, just one below the
	 * HTTP request.
	 *
	 * @return boolean
	 * @api
	 */
	public function isMainRequest() {
		return ($this->parentRequest instanceof HttpRequest);
	}

	/**
	 * Returns an ActionRequest which referred to this request, if any.
	 *
	 * The referring request is not set or determined automatically but must be
	 * explictly set through the corresponding internal argument "__referrer".
	 * This mechanism is used by FLOW3's form and validation mechanisms.
	 *
	 * @return \TYPO3\FLOW3\Mvc\ActionRequest the referring request, or NULL if no referrer found
	 */
	public function getReferringRequest() {
		if ($this->referringRequest !== NULL) {
			return $this->referringRequest;
		}
		if (!isset($this->internalArguments['__referrer'])) {
			return NULL;
		}
		if (is_array($this->internalArguments['__referrer'])) {
			$referrerArray = $this->internalArguments['__referrer'];

			$referringRequest = $this->getHttpRequest()->createActionRequest();

			$arguments = array();
			if (isset($referrerArray['arguments'])) {
				$serializedArgumentsWithHmac = $referrerArray['arguments'];
				$serializedArguments = $this->hashService->validateAndStripHmac($serializedArgumentsWithHmac);
				$arguments = unserialize(base64_decode($serializedArguments));
				unset($referrerArray['arguments']);
			}

			$referringRequest->setArguments(\TYPO3\FLOW3\Utility\Arrays::arrayMergeRecursiveOverrule($arguments, $referrerArray));
			return $referringRequest;
		} else {
			$this->referringRequest = $this->internalArguments['__referrer'];
		}
		return $this->referringRequest;
	}

	/**
	 * Sets the dispatched flag
	 *
	 * @param boolean $flag If this request has been dispatched
	 * @return void
	 * @api
	 */
	public function setDispatched($flag) {
		$this->dispatched = $flag ? TRUE : FALSE;
	}

	/**
	 * If this request has been dispatched and addressed by the responsible
	 * controller and the response is ready to be sent.
	 *
	 * The dispatcher will try to dispatch the request again if it has not been
	 * addressed yet.
	 *
	 * @return boolean TRUE if this request has been disptached successfully
	 * @api
	 */
	public function isDispatched() {
		return $this->dispatched;
	}

	/**
	 * Returns the object name of the controller defined by the package key and
	 * controller name
	 *
	 * @return string The controller's Object Name
	 * @api
	 */
	public function getControllerObjectName() {
		$possibleObjectName = '@package\@subpackage\Controller\@controllerController';
		$possibleObjectName = str_replace('@package', str_replace('.', '\\', $this->controllerPackageKey), $possibleObjectName);
		$possibleObjectName = str_replace('@subpackage', $this->controllerSubpackageKey, $possibleObjectName);
		$possibleObjectName = str_replace('@controller', $this->controllerName, $possibleObjectName);
		$possibleObjectName = str_replace('\\\\', '\\', $possibleObjectName);

		$controllerObjectName = $this->objectManager->getCaseSensitiveObjectName($possibleObjectName);
		return ($controllerObjectName !== FALSE) ? $controllerObjectName : '';
	}

	/**
	 * Explicitly sets the object name of the controller
	 *
	 * @param string $unknownCasedControllerObjectName The fully qualified controller object name
	 * @return void
	 * @throws \TYPO3\FLOW3\Object\Exception\UnknownObjectException
	 * @api
	 */
	public function setControllerObjectName($unknownCasedControllerObjectName) {
		$controllerObjectName = $this->objectManager->getCaseSensitiveObjectName($unknownCasedControllerObjectName);

		if ($controllerObjectName === FALSE) {
			throw new \TYPO3\FLOW3\Object\Exception\UnknownObjectException('The object "' . $unknownCasedControllerObjectName . '" is not registered.', 1268844071);
		}

		$this->controllerPackageKey = $this->objectManager->getPackageKeyByObjectName($controllerObjectName);

		$matches = array();
		$subject = substr($controllerObjectName, strlen($this->controllerPackageKey) + 1);
		preg_match('/
			^(
				Controller
			|
				(?P<subpackageKey>.+)\\\\Controller
			)
			\\\\(?P<controllerName>[a-z\\\\]+)Controller
			$/ix', $subject, $matches
		);

		$this->controllerSubpackageKey = (isset($matches['subpackageKey'])) ? $matches['subpackageKey'] : NULL;
		$this->controllerName = $matches['controllerName'];
	}

	/**
	 * Sets the package key of the controller.
	 *
	 * This function tries to determine the correct case for the given package key.
	 * If the Package Manager does not know the specified package, the package key
	 * cannot be verified or corrected and is stored as is.
	 *
	 * @param string $packageKey The package key
	 * @return void
	 * @api
	 */
	public function setControllerPackageKey($packageKey) {
		$upperCamelCasedPackageClassName = $this->objectManager->getCaseSensitiveObjectName(str_replace('.', '\\', $packageKey) . '\Package');
		$this->controllerPackageKey = ($upperCamelCasedPackageClassName !== FALSE) ? substr(str_replace('\\', '.', $upperCamelCasedPackageClassName), 0, strlen($packageKey)) : $packageKey;
	}

	/**
	 * Returns the package key of the specified controller.
	 *
	 * @return string The package key
	 * @api
	 */
	public function getControllerPackageKey() {
		return $this->controllerPackageKey;
	}

	/**
	 * Sets the subpackage key of the controller.
	 *
	 * @param string $subpackageKey The subpackage key.
	 * @return void
	 */
	public function setControllerSubpackageKey($subpackageKey) {
		$this->controllerSubpackageKey = (empty($subpackageKey) ? NULL : $subpackageKey);
	}

	/**
	 * Returns the subpackage key of the specified controller.
	 * If there is no subpackage key set, the method returns NULL.
	 *
	 * @return string The subpackage key
	 * @api
	 */
	public function getControllerSubpackageKey() {
		return $this->controllerSubpackageKey;
	}

	/**
	 * Sets the name of the controller which is supposed to handle the request.
	 * Note: This is not the object name of the controller!
	 *
	 * Examples: "Standard", "Account", ...
	 *
	 * @param string $controllerName Name of the controller
	 * @return void
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InvalidControllerNameException
	 */
	public function setControllerName($controllerName) {
		if (!is_string($controllerName)) {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidControllerNameException('The controller name must be a valid string, ' . gettype($controllerName) . ' given.', 1187176358);
		}
		if (strpos($controllerName, '_') !== FALSE) {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidControllerNameException('The controller name must not contain underscores.', 1217846412);
		}
		$this->controllerName = $controllerName;
	}

	/**
	 * Returns the object name of the controller supposed to handle this request, if one
	 * was set already (if not, the name of the default controller is returned)
	 *
	 * @return string Name of the controller
	 * @api
	 */
	public function getControllerName() {
		$controllerObjectName = $this->getControllerObjectName();
		if ($controllerObjectName !== '')  {

				// Extract the controller name from the controller object name to assure that
				// the case is correct.
				// Note: Controller name can also contain sub structure like "Foo\Bar\Baz"
			return substr($controllerObjectName, -(strlen($this->controllerName)+10), -10);
		} else {
			return $this->controllerName;
		}
	}

	/**
	 * Sets the name of the action contained in this request.
	 *
	 * Note that the action name must start with a lower case letter and is case sensitive.
	 *
	 * @param string $actionName Name of the action to execute by the controller
	 * @return void
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InvalidActionNameException if the action name is not valid
	 */
	public function setControllerActionName($actionName) {
		if (!is_string($actionName)) {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidActionNameException('The action name must be a valid string, ' . gettype($actionName) . ' given (' . $actionName . ').', 1187176358);
		}
		if ($actionName === '') {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidActionNameException('The action name must not be an empty string.', 1289472991);
		}
		if ($actionName[0] !== strtolower($actionName[0])) {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidActionNameException('The action name must start with a lower case letter, "' . $actionName . '" does not match this criteria.', 1218473352);
		}
		$this->controllerActionName = $actionName;
	}

	/**
	 * Returns the name of the action the controller is supposed to execute.
	 *
	 * @return string Action name
	 * @api
	 */
	public function getControllerActionName() {
		$controllerObjectName = $this->getControllerObjectName();
		if ($controllerObjectName !== '' && ($this->controllerActionName === strtolower($this->controllerActionName)))  {
			$controllerClassName = $this->objectManager->getClassNameByObjectName($controllerObjectName);
			$actionMethodName = $this->controllerActionName . 'Action';
			foreach (get_class_methods($controllerClassName) as $existingMethodName) {
				if (strtolower($existingMethodName) === strtolower($actionMethodName)) {
					$this->controllerActionName = substr($existingMethodName, 0, -6);
					break;
				}
			}
		}
		return $this->controllerActionName;
	}

	/**
	 * Sets the value of the specified argument
	 *
	 * @param string $argumentName Name of the argument to set
	 * @param mixed $value The new value
	 * @return void
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InvalidArgumentNameException if the given argument name is no string
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InvalidArgumentTypeException if the given argument value is an object
	 */
	public function setArgument($argumentName, $value) {
		if (!is_string($argumentName) || strlen($argumentName) === 0) {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidArgumentNameException('Invalid argument name (must be a non-empty string).', 1210858767);
		}

		if (substr($argumentName, 0, 2) === '__') {
			$this->internalArguments[$argumentName] = $value;
			return;
		}

		if (is_object($value)) {
			throw new \TYPO3\FLOW3\Mvc\Exception\InvalidArgumentTypeException('You are not allowed to store objects in the request arguments. Please convert the object of type "' . get_class($value) . '" given for argument "' . $argumentName . '" to a simple type first.', 1302783022);
		}

		if (substr($argumentName, 0, 2) === '--') {
			$this->pluginArguments[substr($argumentName, 2)] = $value;
			return;
		}

		switch ($argumentName) {
			case '@package':
				$this->setControllerPackageKey($value);
				break;
			case '@subpackage':
				$this->setControllerSubpackageKey($value);
				break;
			case '@controller':
				$this->setControllerName($value);
				break;
			case '@action':
				$this->setControllerActionName($value);
				break;
			case '@format':
				$this->setFormat($value);
				break;
			default:
				$this->arguments[$argumentName] = $value;
		}

	}

	/**
	 * Returns the value of the specified argument
	 *
	 * @param string $argumentName Name of the argument
	 * @return string Value of the argument
	 * @throws \TYPO3\FLOW3\Mvc\Exception\NoSuchArgumentException if such an argument does not exist
	 * @api
	 */
	public function getArgument($argumentName) {
		if (!isset($this->arguments[$argumentName])) throw new \TYPO3\FLOW3\Mvc\Exception\NoSuchArgumentException('An argument "' . $argumentName . '" does not exist for this request.', 1176558158);
		return $this->arguments[$argumentName];
	}

	/**
	 * Checks if an argument of the given name exists (is set)
	 *
	 * @param string $argumentName Name of the argument to check
	 * @return boolean TRUE if the argument is set, otherwise FALSE
	 * @api
	 */
	public function hasArgument($argumentName) {
		return isset($this->arguments[$argumentName]);
	}

	/**
	 * Sets the specified arguments.
	 *
	 * The arguments array will be reset therefore any arguments
	 * which existed before will be overwritten!
	 *
	 * @param array $arguments An array of argument names and their values
	 * @return void
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InvalidArgumentNameException if an argument name is no string
	 * @throws \TYPO3\FLOW3\Mvc\Exception\InvalidArgumentTypeException if an argument value is an object
	 */
	public function setArguments(array $arguments) {
		$this->arguments = array();
		foreach ($arguments as $key => $value) {
			$this->setArgument($key, $value);
		}
	}

	/**
	 * Returns an Array of arguments and their values
	 *
	 * @return array Array of arguments and their values (which may be arguments and values as well)
	 * @api
	 */
	public function getArguments() {
		return $this->arguments;
	}

	/**
	 * Returns the value of the specified internal argument.
	 *
	 * Internal arguments are set via setArgument(). In order to be handled as an
	 * internal argument, its name must start with two underscores.
	 *
	 * @param string $argumentName Name of the argument, for example "__fooBar"
	 * @return string Value of the argument, or NULL if not set.
	 */
	public function getInternalArgument($argumentName) {
		return (isset($this->internalArguments[$argumentName]) ? $this->internalArguments[$argumentName] : NULL);
	}

	/**
	 * Returns the internal arguments of the request, that is, all arguments whose
	 * name starts with two underscores.
	 *
	 * @return array
	 */
	public function getInternalArguments() {
		return $this->internalArguments;
	}

	/**
	 * Sets a namespace for the arguments of this request.
	 *
	 * This doesn't affect the actual behavior of argument handling within this
	 * classes' methods but is used in other parts of FLOW3 and its libraries to
	 * render argument names which don't conflict with each other.
	 *
	 * @param string $namespace Argument namespace
	 * @return void
	 */
	public function setArgumentNamespace($namespace) {
		$this->argumentNamespace = $namespace;
	}

	/**
	 * Returns the argument namespace, if any.
	 *
	 * @return string
	 */
	public function getArgumentNamespace() {
		return $this->argumentNamespace;
	}

	/**
	 * Returns an array of plugin argument configurations
	 *
	 * @return array
	 */
	public function getPluginArguments() {
		return $this->pluginArguments;
	}

	/**
	 * Sets the requested representation format
	 *
	 * @param string $format The desired format, something like "html", "xml", "png", "json" or the like. Can even be something like "rss.xml".
	 * @return void
	 */
	public function setFormat($format) {
		$this->format = strtolower($format);
	}

	/**
	 * Returns the requested representation format
	 *
	 * @return string The desired format, something like "html", "xml", "png", "json" or the like.
	 * @api
	 */
	public function getFormat() {
		return $this->format;
	}

	/**
	 * Resets the dispatched status to FALSE
	 */
	public function __clone() {
		$this->dispatched = FALSE;
	}

}
?>