<?php
namespace TYPO3\FLOW3\Tests\Functional\Mvc\Fixtures\Controller;

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
 * An action controller test fixture
 *
 * @FLOW3\Scope("singleton")
 */
class ActionControllerTestBController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	public function initializeAction() {
		$this->arguments['argument']->getPropertyMappingConfiguration()->allowAllProperties();
	}

	/**
	 * @param \TYPO3\FLOW3\Tests\Functional\Mvc\Fixtures\Controller\TestObjectArgument $argument
	 * @FLOW3\IgnoreValidation(argumentName="$argument")
	 * @return string
	 */
	public function showObjectArgumentAction(TestObjectArgument $argument) {
		return $argument->getEmailAddress();
	}

	/**
	 * @param \TYPO3\FLOW3\Tests\Functional\Mvc\Fixtures\Controller\TestObjectArgument $argument
	 * @return string
	 */
	public function requiredObjectAction(TestObjectArgument $argument) {
		return $argument->getEmailAddress();
	}

	/**
	 * @param \TYPO3\FLOW3\Tests\Functional\Mvc\Fixtures\Controller\TestObjectArgument $argument
	 * @return string
	 */
	public function optionalObjectAction(TestObjectArgument $argument = NULL) {
		if ($argument === NULL) {
			return 'null';
		}
		return $argument->getEmailAddress();
	}

	/**
	 * @param string $argument
	 * @return string
	 */
	public function requiredStringAction($argument) {
		return var_export($argument, TRUE);
	}

	/**
	 * @param string $argument
	 * @return string
	 */
	public function optionalStringAction($argument = 'default') {
		return var_export($argument, TRUE);
	}

	/**
	 * @param integer $argument
	 * @return string
	 */
	public function requiredIntegerAction($argument) {
		return var_export($argument, TRUE);
	}

	/**
	 * @param integer $argument
	 * @return string
	 */
	public function optionalIntegerAction($argument = 123) {
		return var_export($argument, TRUE);
	}

	/**
	 * @param float $argument
	 * @return string
	 */
	public function requiredFloatAction($argument) {
		return var_export($argument, TRUE);
	}

	/**
	 * @param float $argument
	 * @return string
	 */
	public function optionalFloatAction($argument = 12.34) {
		return var_export($argument, TRUE);
	}

	/**
	 * @param \DateTime $argument
	 * @return string
	 */
	public function requiredDateAction(\DateTime $argument) {
		return $argument->format('Y-m-d');
	}

	/**
	 * @param \DateTime $argument
	 * @return string
	 */
	public function optionalDateAction(\DateTime $argument = NULL) {
		if ($argument === NULL) {
			return 'null';
		}
		return $argument->format('Y-m-d');
	}

}
?>