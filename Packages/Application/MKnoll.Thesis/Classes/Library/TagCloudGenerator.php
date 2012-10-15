<?php
namespace MKnoll\Thesis\Library;

/************************************************************\
 *
 *    tagcloud Copyright 2012 Derek Harvey
 *    lotsofcode.com
 *
 *    modifications by Michael Knoll <mimi@kaktusteam.de>
 *
 *    This file is part of tagcloud.
 *
 *    tagcloud is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 *
 *    tagcloud is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with tagCloud; if not, write to the Free Software
 *    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA    02111-1307    USA
 *
\************************************************************/

class TagCloudGenerator {

	/**
	 * Tag cloud version
	 */
	public $version = '3.0.0';



	/*
	  * Tag array container
	  */
	protected $_tagsArray = array();



	/**
	 * List of tags to remove from final output
	 */
	protected $_removeTags = array();



	/**
	 * Cached attributes for order comparison
	 */
	protected $_attributes = array();



	/*
	  * Amount to limit cloud by
	  */
	protected $_limit = null;



	/*
	  * Minimum length of string to filtered in string
	  */
	protected $_minLength = null;



	/**
	 * Holds an array of stopwords to be removed from tag cloud
	 *
	 * @var array
	 */
	protected $stopwords;



	/*
	  * Custom format output of tags
	  *
	  * transformation: upper and lower for change of case
	  * trim: bool, applies trimming to tag
	  */
	protected $_formatting = array(
		'transformation' => 'lower',
		'trim' => true
	);



	/*
	  * Constructor
	  *
	  * @param array $tags
	  *
	  * @return void
	  */
	public function __construct($tags = false) {
		$this->initStopworList();
		if ($tags !== false) {
			if (is_string($tags)) {
				$this->addString($tags);
			} elseif (count($tags)) {
				foreach ($tags as $key => $value) {
					$this->addTag($value);
				}
			}
		}
	}



	/*
	  * Convert a string into a array
	  *
	  * @param string $string    The string to use
	  * @param string $seperator The seperator to extract the tags
	  *
	  * @return void
	  */
	public function addString($string, $seperator = ' ') {
		$inputArray = explode($seperator, $string);
		$tagArray = array();
		foreach ($inputArray as $inputTag) {
			$formattedTag = $this->formatTag($inputTag);
			if ($formattedTag != '') {
				$tagArray[] = $this->formatTag($inputTag);
			}
		}
		$this->addTags($tagArray);
	}



	/*
	  * Parse tag into safe format
	  *
	  * @param string $string
	  *
	  * @return string
	  */
	public function formatTag($string) {
		if ($this->_formatting['transformation']) {
			switch ($this->_formatting['transformation']) {
				case 'upper':
					$string = strtoupper($string);
					break;
				default:
					$string = strtolower($string);
			}
		}

		$string = $this->removeStopwordsInString($string);

		if ($this->_formatting['trim']) {
			$string = trim($string);
		}

		return preg_replace('/[^\w ]/u', '', strip_tags($string));
	}



	/*
	  * Assign tag to array
	  *
	  * @param array $tagAttributes Tags or tag attributes array
	  *
	  * @return array $this->tagsArray
	  */
	public function addTag($tagAttributes = array()) {
		if (is_string($tagAttributes)) {
			$tagAttributes = array('tag' => $tagAttributes);
		}
		$tagAttributes['tag'] = $this->formatTag($tagAttributes['tag']);
		if (!array_key_exists('size', $tagAttributes)) {
			$tagAttributes = array_merge($tagAttributes, array('size' => 1));
		}
		if (!array_key_exists('tag', $tagAttributes)) {
			return false;
		}
		$tag = $tagAttributes['tag'];
		if (empty($this->_tagsArray[$tag])) {
			$this->_tagsArray[$tag] = array();
		}
		if (!empty($this->_tagsArray[$tag]['size']) && !empty($tagAttributes['size'])) {
			$tagAttributes['size'] = ($this->_tagsArray[$tag]['size'] + $tagAttributes['size']);
		} elseif (!empty($this->_tagsArray[$tag]['size'])) {
			$tagAttributes['size'] = $this->_tagsArray[$tag]['size'];
		}
		$this->_tagsArray[$tag] = $tagAttributes;
		$this->addAttributes($tagAttributes);
		return $this->_tagsArray[$tag];
	}



	/*
	  * Add all attributes to cached array
	  *
	  * @return void
	  */
	public function addAttributes($attributes) {
		$this->_attributes = array_unique(
			array_merge(
				$this->_attributes,
				array_keys($attributes)
			)
		);
	}



	/*
	  * Get attributes from cache
	  *
	  * @return array $this->_attibutes
	  */
	public function getAttributes() {
		return $this->_attributes;
	}



	/*
	  * Assign multiple tags to array
	  *
	  * @param array $tags
	  *
	  * @return void
	  */
	public function addTags($tags = array()) {
		if (!is_array($tags)) {
			$tags = func_get_args();
		}
		foreach ($tags as $tagAttributes) {
			$this->addTag($tagAttributes);
		}
	}



	/*
	  * Sets a minimum string length for the
	  * tags to display
	  *
	  * @param int $minLength
	  *
	  * @returns obj $this
	  */
	public function setMinLength($minLength) {
		$this->_minLength = $minLength;
		return $this;
	}



	/*
	  * Gets the minimum length value
	  *
	  * @returns void
	  */
	public function getMinLength() {
		return $this->_minLength;
	}



	/*
	  * Sets a limit for the amount of clouds
	  *
	  * @param int $limit
	  *
	  * @returns obj $this
	  */
	public function setLimit($limit) {
		$this->_limit = $limit;
		return $this;
	}



	/*
	  * Get the limit for the amount tags
	  * to display
	  *
	  * @param int $limit
	  *
	  * @returns int $this->_limit
	  */
	public function getLimit() {
		return $this->_limit;
	}



	/*
	  * Remove a tag from the array
	  *
	  * @param string $tag
	  *
	  * @returns obj $this
	  */
	public function setRemoveTag($tag) {
		$this->_removeTags[] = $this->formatTag($tag);
		return $this;
	}



	/*
	  * Remove multiple tags from the array
	  *
	  * @param array $tags
	  *
	  * @returns obj $this
	  */
	public function setRemoveTags($tags) {
		foreach ($tags as $tag) {
			$this->setRemoveTag($tag);
		}
		return $this;
	}



	/*
	  * Get the list of remove tags
	  *
	  * @returns array $this->_removeTags
	  */
	public function getRemoveTags() {
		return $this->_removeTags;
	}



	/*
	  * Assign the order field and order direction of the array
	  *
	  * Order by tag or size / defaults to random
	  *
	  * @param array  $field
	  * @param string $sortway
	  *
	  * @returns $this->orderBy
	  */
	public function setOrder($field, $direction = 'ASC') {
		return $this->orderBy = array(
			'field' => $field,
			'direction' => $direction
		);
	}



	/**
	 * Returns tag cloud as html
	 *
	 * @return string
	 */
	public function renderAsHtml() {
		return $this->render('html');
	}



	/**
	 * Returns an array of tags with a frequency bigger than given threshold
	 *
	 * @param int $threshold
	 * @return array
	 */
	public function renderAsArrayWithThreshold($threshold = 1) {
		$tags = $this->renderAsArray();
		$filteredTags = array();
		foreach ($tags as $tag => $tagInfo) {
			if ($tagInfo['size'] >= $threshold) {
				$filteredTags[$tag] = $tagInfo;
			}
		}
		return $filteredTags;
	}



	/**
	 * Returns tag cloud as array
	 *
	 * @return array
	 */
	public function renderAsArray() {
		return $this->render('array');
	}



	/*
	  * Generate the output for each tag.
	  *
	  * @returns string/array $return
	  */
	public function render($returnType = 'html') {
		$this->_remove();
		$this->_minLength();
		if (empty($this->orderBy)) {
			$this->_shuffle();
		} else {
			$orderDirection = strtolower($this->orderBy['direction']) == 'desc' ? 'SORT_DESC' : 'SORT_ASC';
			$this->_tagsArray = $this->_order(
				$this->_tagsArray,
				$this->orderBy['field'],
				$orderDirection
			);
		}
		$this->_limit();
		$max = $this->_getMax();
		if (is_array($this->_tagsArray)) {
			$return = ($returnType == 'html' ? '' : ($returnType == 'array' ? array() : ''));
			foreach ($this->_tagsArray as $tag => $arrayInfo) {
				$sizeRange = $this->_getClassFromPercent(($arrayInfo['size'] / $max) * 100);
				$arrayInfo['range'] = $sizeRange;
				if ($returnType == 'array') {
					$return [$tag] = $arrayInfo;
				} elseif ($returnType == 'html') {
					$return .= "<span class='tag size{$sizeRange}'> &nbsp; {$arrayInfo['tag']} &nbsp; </span>";
				}
			}
			return $return;
		}
		return null;
	}



	/*
	  * Removes tags from the whole array
	  *
	  * @returns array $this->_tagsArray
	  */
	protected function _remove() {
		foreach ($this->_tagsArray as $key => $value) {
			if (!in_array($value['tag'], $this->getRemoveTags())) {
				$_tagsArray[$value['tag']] = $value;
			}
		}
		$this->_tagsArray = array();
		$this->_tagsArray = $_tagsArray;
		return $this->_tagsArray;
	}



	/*
	  * Orders the cloud by a specific field
	  *
	  * @param array $unsortedArray
	  * @param string $sortField
	  * @param string $sortWay
	  *
	  * @returns array $unsortedArray
	  */
	protected function _order($unsortedArray, $sortField, $sortWay = 'SORT_ASC') {
		$sortedArray = array();
		foreach ($unsortedArray as $uniqid => $row) {
			foreach ($this->getAttributes() as $attr) {
				if (isset($row[$attr])) {
					$sortedArray[$attr][$uniqid] = $unsortedArray[$uniqid][$attr];
				} else {
					$sortedArray[$attr][$uniqid] = null;
				}
			}
		}
		if ($sortWay) {
			array_multisort($sortedArray[$sortField], constant($sortWay), $unsortedArray);
		}
		return $unsortedArray;
	}



	/*
	  * Parses the array and retuns
	  * limited amount of items
	  *
	  * @returns array $this->_tagsArray
	  */
	protected function _limit() {
		$limit = $this->getLimit();
		if ($limit !== null) {
			$i = 0;
			$_tagsArray = array();
			foreach ($this->_tagsArray as $key => $value) {
				if ($i < $limit) {
					$_tagsArray[$value['tag']] = $value;
				}
				$i++;
			}
			$this->_tagsArray = array();
			$this->_tagsArray = $_tagsArray;
		}
		return $this->_tagsArray;
	}



	/*
	  * Reduces the array by removing strings
	  * with a length shorter than the minLength
	  *
	  * @returns array $this->_tagsArray
	  */
	protected function _minLength() {
		$limit = $this->getMinLength();
		if ($limit !== null) {
			$i = 0;
			$_tagsArray = array();
			foreach ($this->_tagsArray as $key => $value) {
				if (strlen($value['tag']) >= $limit) {
					$_tagsArray[$value['tag']] = $value;
				}
				$i++;
			}
			$this->_tagsArray = array();
			$this->_tagsArray = $_tagsArray;
		}
		return $this->_tagsArray;
	}



	/*
	  * Finds the maximum 'size' value of an array
	  *
	  * @returns string $max
	  */
	protected function _getMax() {
		$max = 0;
		if (!empty($this->_tagsArray)) {
			$p_size = 0;
			foreach ($this->_tagsArray as $cKey => $cVal) {
				$c_size = $cVal['size'];
				if ($c_size > $p_size) {
					$max = $c_size;
					$p_size = $c_size;
				}
			}
		}
		return $max;
	}



	/*
	  * Shuffle associated names in array
	  *
	  * @return array $this->_tagsArray The shuffled array
	  */
	protected function _shuffle() {
		$keys = array_keys($this->_tagsArray);
		shuffle($keys);
		if (count($keys) && is_array($keys)) {
			$tmpArray = $this->_tagsArray;
			$this->_tagsArray = array();
			foreach ($keys as $key => $value)
				$this->_tagsArray[$value] = $tmpArray[$value];
		}
		return $this->_tagsArray;
	}



	/*
	  * Get the class range using a percentage
	  *
	  * @returns int $class The respective class
	  * name based on the percentage value
	  */
	protected function _getClassFromPercent($percent) {
		$percent = floor($percent);
		if ($percent >= 99)
			$class = 9;
		elseif ($percent >= 70)
			$class = 8;
		elseif ($percent >= 60)
			$class = 7;
		elseif ($percent >= 50)
			$class = 6;
		elseif ($percent >= 40)
			$class = 5;
		elseif ($percent >= 30)
			$class = 4;
		elseif ($percent >= 20)
			$class = 3;
		elseif ($percent >= 10)
			$class = 2;
		elseif ($percent >= 5)
			$class = 1;
		else
			$class = 0;
		return $class;
	}



	/**
	 * Removes stopwords from given string
	 *
	 * @param $string
	 * @return string
	 */
	protected function removeStopwordsInString($string) {
		if (in_array($string, $this->stopwords)) {
			return '';
		} else {
			return $string;
		}
	}



	/**
	 * German Stopwords list taken from http://staticfloat.com
	 * Feedback: http://futcheye.com
	 */
	protected function initStopworList() {

		$this->stopwords = array(
			"ab",  "bei ", " da",  "deshalb",  "ein",  "für",  "finde",  "haben",  "hier",  "ich",  "ja",
			"kann",  "machen",  "muesste",  "nach",  "oder",  "seid",  "sonst",  "und",  "vom",  "wann",  "wenn",
			"wie",  "zu",  "bin",  "eines",  "hat",  "manche",  "solches",  "an",  "anderm",  "bis",  "das",  "deinem",
			"demselben",  "dir",  "doch",  "einig",  "er",  "eurer",  "hatte",  "ihnen",  "ihre",  "ins",  "jenen",
			"keinen",  "manchem",  "meinen",  "nichts",  "seine",  "soll",  "unserm",  "welche",  "werden",  "wollte",
			"während",  "alle",  "allem",  "allen",  "aller",  "alles",  "als",  "also",  "am",  "ander",  "andere",
			"anderem",  "anderen",  "anderer",  "anderes",  "andern",  "anders",  "auch",  "auf",  "aus",  "bist",
			"bsp.",  "daher",  "damit",  "dann",  "dasselbe",  "dazu",  "daß",  "dein",  "deine",  "deinen",
			"deiner",  "deines",  "dem",  "den",  "denn",  "denselben",  "der",  "derer",  "derselbe",
			"derselben",  "des",  "desselben",  "dessen",  "dich",  "die",  "dies",  "diese",  "dieselbe",
			"dieselben",  "diesem",  "diesen",  "dieser",  "dieses",  "dort",  "du",  "durch",  "eine",  "einem",
			"einen",  "einer",  "einige",  "einigem",  "einigen",  "einiger",  "einiges",  "einmal",  "es",  "etwas",
			"euch",  "euer",  "eure",  "eurem",  "euren",  "eures",  "ganz",  "ganze",  "ganzen",  "ganzer",
			"ganzes",  "gegen",  "gemacht",  "gesagt",  "gesehen",  "gewesen",  "gewollt",  "hab",  "habe",
			"hatten",  "hin",  "hinter",  "ihm",  "ihn",  "ihr",  "ihrem",  "ihren",  "ihrer",  "ihres",
			"im",  "in",  "indem",  "ist",  "jede",  "jedem",  "jeden",  "jeder",  "jedes",  "jene",  "jenem",
			"jener",  "jenes",  "jetzt",  "kein",  "keine",  "keinem",  "keiner",  "keines",  "konnte",  "könnten",
			"können",  "könnte",  "mache",  "machst",  "macht",  "machte",  "machten",  "man",  "manchen",  "mancher",
			"manches",  "mein",  "meine",  "meinem",  "meiner",  "meines",  "mich",  "mir",  "mit",  "muss",
			"musste",  "müßt",  "nicht",  "noch",  "nun",  "nur",  "ob",  "ohne",  "sage",  "sagen",  "sagt",
			"sagte",  "sagten",  "sagtest",  "sehe",  "sehen",  "sehr",  "seht",  "sein",  "seinem",  "seinen",
			"seiner",  "seines",  "selbst",  "sich",  "sicher",  "sie",  "sind",  "so",  "solche",  "solchem",
			"solchen",  "solcher",  "sollte",  "sondern",  "um",  "uns",  "unse",  "unsen",  "unser",  "unses",
			"unter",  "viel",  "von",  "vor",  "war",  "waren",  "warst",  "was",  "weg",  "weil",  "weiter",
			"welchem",  "welchen",  "welcher",  "welches",  "welche",  "werde",  "wieder",  "will",  "wir",  "wird",
			"wirst",  "wo",  "wolle",  "wollen",  "wollt",  "wollten",  "wolltest",  "wolltet",  "würde",  "würden",
			"z.B.",  "zum",  "zur",  "zwar",  "zwischen",  "über",  "aber",  "abgerufen",  "abgerufene",
			"abgerufener",  "abgerufenes",  "acht",  "allein",  "allerdings",  "allerlei",  "allgemein",
			"allmählich",  "allzu",  "alsbald",  "andererseits",  "andernfalls",  "anerkannt",  "anerkannte",
			"anerkannter",  "anerkanntes",  "anfangen",  "anfing",  "angefangen",  "angesetze",  "angesetzt",
			"angesetzten",  "angesetzter",  "ansetzen",  "anstatt",  "arbeiten",  "aufgehört",  "aufgrund",
			"aufhören",  "aufhörte",  "aufzusuchen",  "ausdrücken",  "ausdrückt",  "ausdrückte",  "ausgenommen",
			"ausser",  "ausserdem",  "author",  "autor",  "außen",  "außer",  "außerdem",  "außerhalb",  "bald",
			"bearbeite",  "bearbeiten",  "bearbeitete",  "bearbeiteten",  "bedarf",  "bedurfte",  "bedürfen",
			"befragen",  "befragte",  "befragten",  "befragter",  "begann",  "beginnen",  "begonnen",  "behalten",
			"behielt",  "beide",  "beiden",  "beiderlei",  "beides",  "beim",  "bei",  "beinahe",  "beitragen",
			"beitrugen",  "bekannt",  "bekannte",  "bekannter",  "bekennen",  "benutzt",  "bereits",  "berichten",
			"berichtet",  "berichtete",  "berichteten",  "besonders",  "besser",  "bestehen",  "besteht",
			"beträchtlich",  "bevor",  "bezüglich",  "bietet",  "bisher",  "bislang",  "bis",  "bleiben",
			"blieb",  "bloss",  "bloß",  "brachte",  "brachten",  "brauchen",  "braucht",  "bringen",  "bräuchte",
			"bzw",  "böden",  "ca.",  "dabei",  "dadurch",  "dafür",  "dagegen",  "dahin",  "damals",  "danach",
			"daneben",  "dank",  "danke",  "danken",  "dannen",  "daran",  "darauf",  "daraus",  "darf",  "darfst",
			"darin",  "darum",  "darunter",  "darüber",  "darüberhinaus",  "dass",  "davon",  "davor",  "demnach",
			"denen",  "dennoch",  "derart",  "derartig",  "derem",  "deren",  "derjenige",  "derjenigen",  "derzeit",
			"desto",  "deswegen",  "diejenige",  "diesseits",  "dinge",  "direkt",  "direkte",  "direkten",
			"direkter",  "doppelt",  "dorther",  "dorthin",  "drauf",  "drei",  "dreißig",  "drin",  "dritte",
			"drunter",  "drüber",  "dunklen",  "durchaus",  "durfte",  "durften",  "dürfen",  "dürfte",  "eben",
			"ebenfalls",  "ebenso",  "ehe",  "eher",  "eigenen",  "eigenes",  "eigentlich",  "einbaün",
			"einerseits",  "einfach",  "einführen",  "einführte",  "einführten",  "eingesetzt",  "einigermaßen",
			"eins",  "einseitig",  "einseitige",  "einseitigen",  "einseitiger",  "einst",  "einstmals",  "einzig",
			"ende",  "entsprechend",  "entweder",  "ergänze",  "ergänzen",  "ergänzte",  "ergänzten",  "erhalten",
			"erhielt",  "erhielten",  "erhält",  "erneut",  "erst",  "erste",  "ersten",  "erster",  "eröffne",
			"eröffnen",  "eröffnet",  "eröffnete",  "eröffnetes",  "etc",  "etliche",  "etwa",  "fall",  "falls",
			"fand",  "fast",  "ferner",  "finden",  "findest",  "findet",  "folgende",  "folgenden",  "folgender",
			"folgendes",  "folglich",  "fordern",  "fordert",  "forderte",  "forderten",  "fortsetzen",  "fortsetzt",
			"fortsetzte",  "fortsetzten",  "fragte",  "frau",  "frei",  "freie",  "freier",  "freies",  "fuer",
			"fünf",  "gab",  "ganzem",  "gar",  "gbr",  "geb",  "geben",  "geblieben",  "gebracht",  "gedurft",
			"geehrt",  "geehrte",  "geehrten",  "geehrter",  "gefallen",  "gefiel",  "gefälligst",  "gefällt",
			"gegeben",  "gehabt",  "gehen",  "geht",  "gekommen",  "gekonnt",  "gemocht",  "gemäss",  "genommen",
			"genug",  "gern",  "gestern",  "gestrige",  "getan",  "geteilt",  "geteilte",  "getragen",
			"gewissermaßen",  "geworden",  "ggf",  "gib",  "gibt",  "gleich",  "gleichwohl",  "gleichzeitig",
			"glücklicherweise",  "gmbh",  "gratulieren",  "gratuliert",  "gratulierte",  "gut",  "gute",  "guten",
			"gängig",  "gängige",  "gängigen",  "gängiger",  "gängiges",  "gänzlich",  "haette",  "halb",  "hallo",
			"hast",  "hattest",  "hattet",  "heraus",  "herein",  "heute",  "heutige",  "hiermit",  "hiesige",
			"hinein",  "hinten",  "hinterher",  "hoch",  "hundert",  "hätt",  "hätte",  "hätten",  "höchstens",
			"igitt",  "immer",  "immerhin",  "important",  "indessen",  "info",  "infolge",  "innen",  "innerhalb",
			"insofern",  "inzwischen",  "irgend",  "irgendeine",  "irgendwas",  "irgendwen",  "irgendwer",
			"irgendwie",  "irgendwo",  "je",  "jedenfalls",  "jederlei",  "jedoch",  "jemand",  "jenseits",
			"jährig",  "jährige",  "jährigen",  "jähriges",  "kam",  "kannst",  "kaum",  "keines",  "keinerlei",
			"keineswegs",  "klar",  "klare",  "klaren",  "klares",  "klein",  "kleinen",  "kleiner",  "kleines",
			"koennen",  "koennt",  "koennte",  "koennten",  "komme",  "kommen",  "kommt",  "konkret",  "konkrete",
			"konkreten",  "konkreter",  "konkretes",  "konnten",  "könn",  "könnt",  "könnten",  "künftig",  "lag",
			"lagen",  "langsam",  "lassen",  "laut",  "lediglich",  "leer",  "legen",  "legte",  "legten",  "leicht",
			"leider",  "lesen",  "letze",  "letzten",  "letztendlich",  "letztens",  "letztes",  "letztlich",
			"lichten",  "liegt",  "liest",  "links",  "längst",  "längstens",  "mag",  "magst",  "mal",
			"mancherorts",  "manchmal",  "mann",  "margin",  "mehr",  "mehrere",  "meist",  "meiste",  "meisten",
			"meta",  "mindestens",  "mithin",  "mochte",  "morgen",  "morgige",  "muessen",  "muesst",  "musst",
			"mussten",  "muß",  "mußt",  "möchte",  "möchten",  "möchtest",  "mögen",  "möglich",  "mögliche",
			"möglichen",  "möglicher",  "möglicherweise",  "müssen",  "müsste",  "müssten",  "müßte",  "nachdem",
			"nacher",  "nachhinein",  "nahm",  "natürlich",  "nacht",  "neben",  "nebenan",  "nehmen",  "nein",
			"neu",  "neue",  "neuem",  "neuen",  "neuer",  "neues",  "neun",  "nie",  "niemals",  "niemand",
			"nimm",  "nimmer",  "nimmt",  "nirgends",  "nirgendwo",  "nutzen",  "nutzt",  "nutzung",  "nächste",
			"nämlich",  "nötigenfalls",  "nützt",  "oben",  "oberhalb",  "obgleich",  "obschon",  "obwohl",  "oft",
			"per",  "pfui",  "plötzlich",  "pro",  "reagiere",  "reagieren",  "reagiert",  "reagierte",  "rechts",
			"regelmäßig",  "rief",  "rund",  "sang",  "sangen",  "schlechter",  "schließlich",  "schnell",  "schon",
			"schreibe",  "schreiben",  "schreibens",  "schreiber",  "schwierig",  "schätzen",  "schätzt",
			"schätzte",  "schätzten",  "sechs",  "sect",  "sehrwohl",  "sei",  "seit",  "seitdem",  "seite",
			"seiten",  "seither",  "selber",  "senke",  "senken",  "senkt",  "senkte",  "senkten",  "setzen",
			"setzt",  "setzte",  "setzten",  "sicherlich",  "sieben",  "siebte",  "siehe",  "sieht",  "singen",
			"singt",  "sobald",  "sodaß",  "soeben",  "sofern",  "sofort",  "sog",  "sogar",  "solange",  "solc",
			"hen",  "solch",  "sollen",  "sollst",  "sollt",  "sollten",  "solltest",  "somit",  "sonstwo",
			"sooft",  "soviel",  "soweit",  "sowie",  "sowohl",  "spielen",  "später",  "startet",  "startete",
			"starteten",  "statt",  "stattdessen",  "steht",  "steige",  "steigen",  "steigt",  "stets",  "stieg",
			"stiegen",  "such",  "suchen",  "sämtliche",  "tages",  "tat",  "tatsächlich",  "tatsächlichen",
			"tatsächlicher",  "tatsächliches",  "tausend",  "teile",  "teilen",  "teilte",  "teilten",  "titel",
			"total",  "trage",  "tragen",  "trotzdem",  "trug",  "trägt",  "toll",  "tun",  "tust",  "tut",  "txt",
			"tät",  "ueber",  "umso",  "unbedingt",  "ungefähr",  "unmöglich",  "unmögliche",  "unmöglichen",
			"unmöglicher",  "unnötig",  "unsem",  "unser",  "unsere",  "unserem",  "unseren",  "unserer",
			"unseres",  "unten",  "unterbrach",  "unterbrechen",  "unterhalb",  "unwichtig",  "usw",  "vergangen",
			"vergangene",  "vergangener",  "vergangenes",  "vermag",  "vermutlich",  "vermögen",  "verrate",
			"verraten",  "verriet",  "verrieten",  "version",  "versorge",  "versorgen",  "versorgt",  "versorgte",
			"versorgten",  "versorgtes",  "veröffentlichen",  "veröffentlicher",  "veröffentlicht",
			"veröffentlichte",  "veröffentlichten",  "veröffentlichtes",  "viele",  "vielen",  "vieler",  "vieles",
			"vielleicht",  "vielmals",  "vier",  "vollständig",  "voran",  "vorbei",  "vorgestern",  "vorher",
			"vorne",  "vorüber",  "völlig",  "während",  "wachen",  "waere",  "warum",  "weder",  "wegen",
			"weitere",  "weiterem",  "weiteren",  "weiterer",  "weiteres",  "weiterhin",  "weiß",  "wem",  "wen",
			"wenig",  "wenige",  "weniger",  "wenigstens",  "wenngleich",  "wer",  "werdet",  "weshalb",  "wessen",
			"weswegen",  "wichtig",  "wieso",  "wieviel",  "wiewohl",  "willst",  "wirklich",  "wodurch",  "wogegen",
			"woher",  "wohin",  "wohingegen",  "wohl",  "wohlweislich",  "womit",  "woraufhin",  "woraus",  "worin",
			"wurde",  "wurden",  "währenddessen",  "wär",  "wäre",  "wären",  "zahlreich",  "zehn",  "zeitweise",
			"ziehen",  "zieht",  "zog",  "zogen",  "zudem",  "zuerst",  "zufolge",  "zugleich",  "zuletzt",  "zumal",
			"zurück",  "zusammen",  "zuviel",  "zwanzig",  "zwei",  "zwölf",  "ähnlich",
			"übel",  "überall",  "überallhin",  "überdies",  "übermorgen",  "übrig",  "übrigens"
		);
	}

}