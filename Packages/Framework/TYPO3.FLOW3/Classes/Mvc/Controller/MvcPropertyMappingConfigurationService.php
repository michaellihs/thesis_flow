<?php
namespace TYPO3\FLOW3\Mvc\Controller;

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
 * This is a Service which can generate a request hash and check whether the currently given arguments
 * fit to the request hash.
 *
 * It is used when forms are generated and submitted:
 * After a form has been generated, the method "generateRequestHash" is called with the names of all form fields.
 * It cleans up the array of form fields and creates another representation of it, which is then serialized and hashed.
 *
 * Both serialized form field list and the added hash form the request hash, which will be sent over the wire (as an argument __hmac).
 *
 * On the validation side, the validation happens in two steps:
 * 1) Check if the request hash is consistent (the hash value fits to the serialized string)
 * 2) Check that _all_ GET/POST parameters submitted occur inside the form field list of the request hash.
 *
 * Note: It is crucially important that a private key is computed into the hash value! This is done inside the HashService.
 *
 * @FLOW3\Scope("singleton")
 */
class MvcPropertyMappingConfigurationService {

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\Cryptography\HashService
	 */
	protected $hashService;

	/**
	 * Generate a request hash for a list of form fields
	 *
	 * @param array $formFieldNames Array of form fields
	 * @param string $fieldNamePrefix
	 * @return string trusted properties token
	 */
	public function generateTrustedPropertiesToken($formFieldNames, $fieldNamePrefix = '') {
		$formFieldArray = array();
		foreach ($formFieldNames as $formField) {
			$formFieldParts = explode('[', $formField);
			$currentPosition =& $formFieldArray;
			for ($i=0; $i < count($formFieldParts); $i++) {
				$formFieldPart = $formFieldParts[$i];
				$formFieldPart = rtrim($formFieldPart, ']');

				if (!is_array($currentPosition)) {
					throw new \TYPO3\FLOW3\Security\Exception\InvalidArgumentForHashGenerationException('The form field "' . $formField . '" is declared as array, but it collides with a previous form field of the same name which declared the field as string. This is an inconsistency you need to fix inside your Fluid form. (String overridden by Array)', 1255072196);
				}

				if ($i === count($formFieldParts) - 1) {
					if (isset($currentPosition[$formFieldPart]) && is_array($currentPosition[$formFieldPart])) {
						throw new \TYPO3\FLOW3\Security\Exception\InvalidArgumentForHashGenerationException('The form field "' . $formField . '" is declared as string, but it collides with a previous form field of the same name which declared the field as array. This is an inconsistency you need to fix inside your Fluid form. (Array overridden by String)', 1255072587);
					}
					// Last iteration - add a string
					if ($formFieldPart === '') {
						$currentPosition[] = 1;
					} else {
						$currentPosition[$formFieldPart] = 1;
					}
				} else {
					if ($formFieldPart === '') {
						throw new \TYPO3\FLOW3\Security\Exception\InvalidArgumentForHashGenerationException('The form field "' . $formField . '" is invalid. Reason: "[]" used not as last argument, but somewhere in the middle (like foo[][bar]).', 1255072832);
					}
					if (!isset($currentPosition[$formFieldPart])) {
						$currentPosition[$formFieldPart] = array();
					}
					$currentPosition =& $currentPosition[$formFieldPart];
				}
			}
		}
		if ($fieldNamePrefix !== '') {
			$formFieldArray = (isset($formFieldArray[$fieldNamePrefix]) ? $formFieldArray[$fieldNamePrefix] : array() );
		}
		return $this->serializeAndHashFormFieldArray($formFieldArray);
	}

	/**
	 * Serialize and hash the form field array
	 *
	 * @param array $formFieldArray form field array to be serialized and hashed
	 * @return string Hash
	 */
	protected function serializeAndHashFormFieldArray($formFieldArray) {
		$serializedFormFieldArray = serialize($formFieldArray);
		return $this->hashService->appendHmac($serializedFormFieldArray);
	}


	/**
	 * Initialize the property mapping configuration in $controllerArguments if
	 * the trusted properties are set inside the request.
	 *
	 * @param \TYPO3\FLOW3\Mvc\ActionRequest $request
	 * @param \TYPO3\FLOW3\Mvc\Controller\Arguments $controllerArguments
	 * @return void
	 */
	public function initializePropertyMappingConfigurationFromRequest(\TYPO3\FLOW3\Mvc\ActionRequest $request, \TYPO3\FLOW3\Mvc\Controller\Arguments $controllerArguments) {
		$trustedPropertiesToken = $request->getInternalArgument('__trustedProperties');
		if (!is_string($trustedPropertiesToken)) {
			return;
		}
		$serializedTrustedProperties = $this->hashService->validateAndStripHmac($trustedPropertiesToken);

		$trustedProperties = unserialize($serializedTrustedProperties);

		foreach ($trustedProperties as $propertyName => $propertyConfiguration) {
			if (!$controllerArguments->hasArgument($propertyName)) {
				continue;
			}
			$propertyMappingConfiguration = $controllerArguments->getArgument($propertyName)->getPropertyMappingConfiguration();
			$this->modifyPropertyMappingConfiguration($propertyConfiguration, $propertyMappingConfiguration);
		}
	}

	/**
	 * Modify the passed $propertyMappingConfiguration according to the $propertyConfiguration which
	 * has been generated by Fluid. In detail, if the $propertyConfiguration contains
	 * an __identity field, we allow modification of objects; else we allow creation.
	 *
	 * All other properties are specified as allowed properties.
	 *
	 * @param array $propertyConfiguration
	 * @param \TYPO3\FLOW3\Property\PropertyMappingConfiguration $propertyMappingConfiguration
	 * @return void
	 */
	protected function modifyPropertyMappingConfiguration($propertyConfiguration, \TYPO3\FLOW3\Property\PropertyMappingConfiguration $propertyMappingConfiguration) {
		if (!is_array($propertyConfiguration)) {
			return;
		}
		if (isset($propertyConfiguration['__identity'])) {
			$propertyMappingConfiguration->setTypeConverterOption('TYPO3\FLOW3\Property\TypeConverter\PersistentObjectConverter', \TYPO3\FLOW3\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_MODIFICATION_ALLOWED, TRUE);
			unset($propertyConfiguration['__identity']);
		} else {
			$propertyMappingConfiguration->setTypeConverterOption('TYPO3\FLOW3\Property\TypeConverter\PersistentObjectConverter', \TYPO3\FLOW3\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);
		}

		foreach ($propertyConfiguration as $innerKey => $innerValue) {
			if (is_array($innerValue)) {
				$this->modifyPropertyMappingConfiguration($innerValue, $propertyMappingConfiguration->forProperty($innerKey));
			}
			$propertyMappingConfiguration->allowProperties($innerKey);
		}
	}
}
?>