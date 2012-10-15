<?php
namespace MKnoll\Thesis\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "MKnoll.Thesis".              *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use Everyman\Neo4j\Client,
    Everyman\Neo4j\Transport,
    Everyman\Neo4j\Node,
    Everyman\Neo4j\Relationship;

use MKnoll\Thesis\Library;


// TODO think about how to prevent this
spl_autoload_register(function ($className) {
	if (strpos($className, 'Everyman\Neo4j\\') !== 0) {
		return;
	}
	$libPath = '/usr/share/php/neo4jphp/lib/';
	$classFile = str_replace('\\',DIRECTORY_SEPARATOR,$className).'.php';
	$classPath = $libPath.$classFile;
	if (file_exists($classPath)) {
		require($classPath);
	}
});


/**
 * Standard controller for the MKnoll.Thesis package 
 *
 * @FLOW3\Scope("singleton")
 */
class StandardController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	const DESCRIPTION = 'RECOMMENDER_OBJECT_description';

	const DOC_ID = 'RECOMMENDER_OBJECT_BIBTIP';

	const SET_DIFFERENCE = 'additional_values__setDifference';

	const NORMALIZED_SET_DIFFERENCE = 'additional_values__normalizedSetDifference';

	const COSINE_SIMILARITY = 'additional_values__cosineSimilarity';

	const NORMALIZED_TOP_N_SET_DIFFERENCE = 'additional_values__normalizedTop10SetDifference';



	/**
	 * @FLOW3\Inject
	 * @var \MKnoll\Thesis\Library\TagCloudGenerator
	 */
	protected $tagCloudGenerator;



	/**
	 * Holds client for neo4j database requests
	 *
	 * @var Everyman\Neo4j\Client
	 */
	private $client;



	/**
	 * Initializes controller before invoking any actions
	 */
	protected function initializeAction() {
		$this->client = new Client(new Transport('172.17.33.1', 7474));
	}



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
		$starttime = microtime(TRUE);

		if ($phrase !== "") {
			// If query starts with "id:" you can directly query for a document id
			if (strpos(strtolower($phrase), 'id:') == 0 && intval(substr($phrase,3)) > 0) {
				$id = substr($phrase, 3);
				$query = new \Everyman\Neo4j\Cypher\Query($this->client, "START n = node($id) RETURN n");
			} else {
				$query = new \Everyman\Neo4j\Cypher\Query($this->client, "START n = node(*) WHERE has(n." . self::DESCRIPTION . ") AND n." . self::DESCRIPTION . " =~/(?i).*{$phrase}.*/ RETURN n");
			}

			$results = $this->client->executeCypherQuery($query);
			$docs = array();
			foreach($results as $result) {
				$document = array();
				$document['title'] = $result['n']->getProperty(self::DESCRIPTION);
				$document['docId'] = $result['n']->getProperty(self::DOC_ID);
				$document['result'] = print_r($result, true);
				$document['nodeId'] = $result['n']->getId();
				$docs[] = $document;
			}
			$this->view->assign('docs', $docs);
			$this->view->assign('phrase', $phrase);
			$this->view->assign('count', count($docs));
		}

		$time = microtime(TRUE) - $starttime;
		$this->view->assign('time', $time);
	}



	/**
	 * Single action
	 *
	 * Shows information about single node.
	 *
	 * Neo4j query used here:
	 * START n = node(136) MATCH (n)-[:IS_MERGED_INTO*4]->(b)-[:CONTAINS*1..]->c WHERE has(c.description) RETURN c;
	 *
	 * @param string $nodeId Node id of object to be displayed
	 * @param int $depth Merge depth in dendrogram starting from given node
	 * @param int $increase Set step for increasing depth (increase is added to depth)
	 * @param int $decrease Set step for decreasing depth (decrease is subtracted from depth)
	 */
	public function singleAction($nodeId, $depth = 1, $increase = 0, $decrease = 0) {
		$starttime = microtime(TRUE);

		if ($increase > 0) {
			$depth += $increase;
		}

		if ($decrease > 0 && ($depth - $decrease) > 0) {
			$depth -= $decrease;
		}

		// Query cluster for given depth and given node id
		$queryString =  "START n = node({$nodeId}) MATCH (n)-[:IS_MERGED_INTO*{$depth}]->(b)-[:CONTAINS*1..]->c WHERE has(c." . self::DESCRIPTION . ") RETURN c;";
		$query = new \Everyman\Neo4j\Cypher\Query($this->client, $queryString);
		$results = $this->client->executeCypherQuery($query);
		$documents = array();
		foreach($results as $result) {
			$document = array();
			$document['title'] = $result['n']->getProperty(self::DESCRIPTION);
			$document['docId'] = $result['n']->getProperty(self::DOC_ID);
			$document['nodeId'] = $result['n']->getId();
			$document['_from_clustering'] = 1;
			$documents[$result['n']->getId()] = $document;
		}

		// TODO think about we should create tag cloud AFTER adding recommendations
		$tagCloudArray = $this->createTagCloud($documents);

		// Query recommendations for given node id
		$recQueryString = "START n = node({$nodeId}) MATCH (n)-[:IS_RECOMMENDATION_FOR]->(c) RETURN n, c;";
		$query = new \Everyman\Neo4j\Cypher\Query($this->client, $recQueryString);
		$results = $this->client->executeCypherQuery($query);

		foreach($results as $result) {
			if (!array_key_exists($result['c']->getId(), $documents)) {
				$document = array();
				$document['title'] = $result['c']->getProperty(self::DESCRIPTION);
				$document['docId'] = $result['c']->getProperty(self::DOC_ID);
				$document['nodeId'] = $result['c']->getId();
				$document['_from_recommendations'] = 1;
				$documents[$result['c']->getId()] = $document;
			} else {
				$documents[$result['c']->getId()]['_from_recommendations'] = 1;
			}
		}

		#echo "<pre>"; var_dump($tagCloudArray); echo "</pre>";

		$this->view->assign('docs', $documents);
		$this->view->assign('depth', $depth);
		$this->view->assign('query', $queryString);
		$this->view->assign('nodeId', $nodeId);
		$this->view->assign('tagCloud', $tagCloudArray);
		$this->view->assign('setDifferences', $this->arrayToProtovisDataString($this->querySetDifferenceFromN4JNode($nodeId), 'setDifferences'));
		$this->view->assign('normalizedTopNSetDifferences', $this->arrayToProtovisDataString($this->queryNormalizedTopNSetDifferencesFromN4JNode($nodeId), 'normalizedTopNSetDifferences'));
		$this->view->assign('normalizedSetDifferences', $this->arrayToProtovisDataString($this->queryNormalizedSetDifferenceFromN4JNode($nodeId), 'normalizedSetDifferences'));
		$this->view->assign('cosineSimilarities', $this->arrayToProtovisDataString($this->queryCosineSimilaritesFromN4JNode($nodeId), 'cosineSimilarities'));

		$time = microtime(TRUE) - $starttime;
		$this->view->assign('time', $time);
	}



	/**
	 * Autocomplete action for ajax calls
	 *
	 * @param string $phrase
	 */
	public function autoCompleteAction($phrase="") {

		$starttime = microtime(TRUE);

		$query = new \Everyman\Neo4j\Cypher\Query($this->client, "START n = node(*) WHERE has(n." . self::DESCRIPTION . ") AND n." . self::DESCRIPTION . " =~/(?i){$phrase}.*/ RETURN n");
		$results = $this->client->executeCypherQuery($query);
		$suggestions = array();
		foreach($results as $result) {
			#var_dump($result);
			$suggestion = array();
			$suggestion['title'] = $result['n']->getProperty(self::DESCRIPTION);
			$suggestion['docId'] = $result['n']->getProperty(self::DOC_ID);
			$suggestions['results'][] = $suggestion;
		}

		$suggestions['length'] = $results->count();
		$suggestions['time'] = microtime(TRUE) - $starttime;

		/*
		 * Format required for suggestions:
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

		*/

		echo json_encode($suggestions);
		exit();
	}



	/**
	 * Creates a tag cloud array for given documents
	 *
	 * @param array $documents
	 */
	protected function createTagCloud(array $documents) {
		foreach ($documents as $document) {
			$this->tagCloudGenerator->addString($document['title']);
		}
		return $this->tagCloudGenerator->renderAsArrayWithThreshold(2);
	}



	/**
	 * Returns an array of set differences for given node
	 *
	 * @param int $nodeId Id of node to get set differences for
	 * @return array Set differences for given node
	 */
	protected function querySetDifferenceFromN4JNode($nodeId) {
		return $this->queryTagCloudSimilarities($nodeId, self::SET_DIFFERENCE);
	}



	/**
	 * Returns array of normalized set differences for given node
	 *
	 * @param int $nodeId Id of node to get normalized set differences for
	 * @return array Normalized set differences for given node
	 */
	protected function queryNormalizedSetDifferenceFromN4JNode($nodeId) {
		return $this->queryTagCloudSimilarities($nodeId, self::NORMALIZED_SET_DIFFERENCE);
	}



	/**
	 * Returns array of cosine similarities for given node
	 *
	 * @param int $nodeId Id of node to get cosine similarities for
	 * @return array Cosine similarities for given node
	 */
	protected function queryCosineSimilaritesFromN4JNode($nodeId) {
		return $this->queryTagCloudSimilarities($nodeId, self::COSINE_SIMILARITY);
	}



	/**
	 * Returns array normalized top n set differences for given node
	 *
	 * @param int $nodeId Id of node to get normalized top-n set differences for
	 * @return array Normalized top-n set differences for given node
	 */
	protected function queryNormalizedTopNSetDifferencesFromN4JNode($nodeId) {
		return $this->queryTagCloudSimilarities($nodeId, self::NORMALIZED_TOP_N_SET_DIFFERENCE);
	}



	/**
	 * Returns set of tag cloud comparison measures
	 *
	 * @param $nodeId
	 * @param $comparisonType
	 * @return array Array of tag cloud similarities for given node
	 */
	protected function queryTagCloudSimilarities($nodeId, $comparisonType) {
		$query = new \Everyman\Neo4j\Cypher\Query($this->client, "start n = node($nodeId) MATCH n-[:IS_MERGED_INTO*1..]->c WHERE has(c.$comparisonType) RETURN c.$comparisonType");
		$rows = $this->client->executeCypherQuery($query);
		$result = array();
		foreach($rows as $row) {
			#var_dump($result);
			$result[] = $row[0];
		}
		return $result;
	}



	/**
	 * @param $array
	 * @return string
	 */
	protected function arrayToProtovisDataString($array, $jsVarName) {
		return 'var ' . $jsVarName . '_i = 0; var ' . $jsVarName . ' = [' . implode(', ', $array) . '].map(function(x){return {x: ' . $jsVarName . '_i++, y: x};});';
	}

}
?>