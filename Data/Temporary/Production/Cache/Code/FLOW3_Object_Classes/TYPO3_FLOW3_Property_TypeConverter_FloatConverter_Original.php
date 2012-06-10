<?php
namespace TYPO3\FLOW3\Property\TypeConverter;

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
use TYPO3\FLOW3\Error\Error;

/**
 * Converter which transforms a simple type to a float, by simply casting it.
 *
 * @api
 * @FLOW3\Scope("singleton")
 */
class FloatConverter_Original extends \TYPO3\FLOW3\Property\TypeConverter\AbstractTypeConverter {

	/**
	 * @var array<string>
	 */
	protected $sourceTypes = array('float', 'integer', 'string');

	/**
	 * @var string
	 */
	protected $targetType = 'float';

	/**
	 * @var integer
	 */
	protected $priority = 1;

	/**
	 * Actually convert from $source to $targetType, by doing a typecast.
	 *
	 * @param float|integer|string $source
	 * @param string $targetType
	 * @param array $convertedChildProperties
	 * @param \TYPO3\FLOW3\Property\PropertyMappingConfigurationInterface $configuration
	 * @return float|\TYPO3\FLOW3\Error\Error
	 * @api
	 */
	public function convertFrom($source, $targetType, array $convertedChildProperties = array(), \TYPO3\FLOW3\Property\PropertyMappingConfigurationInterface $configuration = NULL) {
		if ($source === NULL || strlen($source) === 0) {
			return NULL;
		}

		if (!is_numeric($source)) {
			return new Error('"%s" is no float.' , 1332934124, array($source));
		}
		return (float)$source;
	}
}

#