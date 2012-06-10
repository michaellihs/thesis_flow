<?php
namespace TYPO3\FLOW3\Error;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */


/**
 */

/**
 * An object representation of a generic warning. Subclass this to create
 * more specific warnings if necessary.
 *
 * @api
 */
class Warning_Original extends \TYPO3\FLOW3\Error\Message {

	/**
	 * The severity of this message ('Warning').
	 * @var string
	 */
	protected $severity = self::SEVERITY_WARNING;

}

#