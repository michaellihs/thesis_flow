<?php
namespace MKnoll\Thesis\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "MKnoll.Thesis".              *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Standard controller for the MKnoll.Thesis package 
 *
 * @FLOW3\Scope("singleton")
 */
class StandardController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {

	}



	/**
	 * Search action
	 *
	 * @param string $phrase Searchphrase passed by form
	 * @param string $docId Document Id
	 * @return void
	 */
	public function searchAction($phrase = "", $docId = NULL) {
		$this->view->assign('phrase', $phrase);
		$this->view->assign('docId', $docId);
	}



	/**
	 * Autocomplete action for ajax calls
	 *
	 * @param string $phrase
	 */
	public function autoCompleteAction($phrase="") {
		$suggestions = array(
			'results' => array(
				array(
					'title' => 'here comes our title',
					'docId' => '12345'
				),
				array(
					'title' => 'here comes another title',
					'docId' => '12'
				),
				array(
					'title' => '3rd title',
					'docId' => '122'
				),
				array(
					'title' => '4th title',
					'docId' => '123'
				),
			)
		);
		echo json_encode($suggestions);
		exit();
	}

}

?>