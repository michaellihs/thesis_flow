<?php
namespace TYPO3\FLOW3\Annotations;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Doctrine\Common\Annotations\Annotation as DoctrineAnnotation;

/**
 * @Annotation
 * @DoctrineAnnotation\Target("METHOD")
 */
final class Pointcut {

	/**
	 * @var string
	 */
	public $expression;

	/**
	 * @param array $values
	 * @throws \InvalidArgumentException
	 */
	public function __construct(array $values) {
		if (!isset($values['value']) && !isset($values['expression'])) {
			throw new \InvalidArgumentException('A Pointcut annotation must specify a pointcut expression.', 1318456604);
		}
		$this->expression = isset($values['expression']) ? $values['expression'] : $values['value'];
	}

}

?>