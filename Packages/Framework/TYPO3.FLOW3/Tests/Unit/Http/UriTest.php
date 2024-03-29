<?php
namespace TYPO3\FLOW3\Tests\Unit\Http;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use \TYPO3\FLOW3\Http\Uri;

/**
 * Testcase for the URI class
 *
 */
class UriTest extends \TYPO3\FLOW3\Tests\UnitTestCase {

	/**
	 * Checks if a complete URI with all parts is transformed into an object correctly.
	 *
	 * @test
	 */
	public function constructorParsesAFullBlownUriStringCorrectly() {
		$uriString = 'http://username:password@subdomain.domain.com:8080/path1/path2/index.php?argument1=value1&argument2=value2&argument3[subargument1]=subvalue1#anchor';
		$uri = new Uri($uriString);

		$check = (
			$uri->getScheme() == 'http' &&
			$uri->getUsername() == 'username' &&
			$uri->getPassword() == 'password' &&
			$uri->getHost() == 'subdomain.domain.com' &&
			$uri->getPort() === 8080 &&
			$uri->getPath() == '/path1/path2/index.php' &&
			$uri->getQuery() == 'argument1=value1&argument2=value2&argument3[subargument1]=subvalue1' &&
			$uri->getArguments() == array('argument1' => 'value1', 'argument2' => 'value2', 'argument3' => array('subargument1' => 'subvalue1')) &&
			$uri->getFragment() == 'anchor'
		);
		$this->assertTrue($check, 'The valid and complete URI has not been correctly transformed to an URI object');
	}

	/**
	 * Uri strings
	 */
	public function uriStrings() {
		return array(
			array('http://flow3.typo3.org/x'),
			array('http://flow3.typo3.org/foo/bar?baz=1&quux=true'),
			array('https://robert@localhost/arabica/coffee.html'),
			array('http://127.0.0.1/bar.baz.com/foo.js'),
		);
	}

	/**
	 * Checks round trips for various URIs
	 *
	 * @dataProvider uriStrings
	 * @test
	 */
	public function urisCanBeConvertedForthAndBackWithoutLoss($uriString) {
		$uri = new Uri($uriString);
		$this->assertSame($uriString, (string)$uri);
	}

	/**
	 * @test
	 */
	public function constructorParsesArgumentsWithSpecialCharactersCorrectly() {
		$uriString = 'http://www.typo3.com/path1/?argumentäöü1=' . urlencode('valueåø€œ');
		$uri = new Uri($uriString);

		$check = (
			$uri->getScheme() == 'http' &&
			$uri->getHost() == 'www.typo3.com' &&
			$uri->getPath() == '/path1/' &&
			$uri->getQuery() == 'argumentäöü1=value%C3%A5%C3%B8%E2%82%AC%C5%93' &&
			$uri->getArguments() == array('argumentäöü1' => 'valueåø€œ')
		);
		$this->assertTrue($check, 'The URI with special arguments has not been correctly transformed to an URI object');
	}

	/**
	 * URIs for testing host parsing
	 */
	public function hostTestUris() {
		return array(
			array('http://www.typo3.org/about/project', 'www.typo3.org'),
			array('http://flow3.typo3.org/foo', 'flow3.typo3.org')
		);
	}

	/**
	 * @dataProvider hostTestUris
	 * @test
	 */
	public function constructorParsesHostCorrectly($uriString, $expectedHost) {
		$uri = new Uri($uriString);
		$this->assertSame($expectedHost, $uri->getHost());
	}


	/**
	 * Checks if a complete URI with all parts is transformed into an object correctly.
	 *
	 * @test
	 */
	public function stringRepresentationIsCorrect() {
		$uriString = 'http://username:password@subdomain.domain.com:1234/pathx1/pathx2/index.php?argument1=value1&argument2=value2&argument3[subargument1]=subvalue1#anchorman';
		$uri = new Uri($uriString);
		$this->assertEquals($uriString, (string)$uri, 'The string representation of the URI is not equal to the original URI string.');
	}
}
?>