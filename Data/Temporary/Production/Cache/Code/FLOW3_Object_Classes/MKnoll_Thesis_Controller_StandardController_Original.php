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
class StandardController_Original extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

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
	 * @return void
	 */
	public function searchAction($phrase="") {
		$this->view->assign('phrase', $phrase);
	}



	/**
	 * Autocomplete action for ajax calls
	 *
	 * @param string $phrase
	 */
	public function autoCompleteAction($phrase="") {
		$suggestions = array('test');
		echo json_encode($suggestions);
		exit();
	}

}


#