<?php


class ControlledVocabInstaller
{
	public $vocabId;
	public $dom;
	public $filePath;
	public $vocabName; 
	
	function __construct($fileName)
	{
		$this->fileName = $fileName;
		$this->dom = new DOMDocument();
		$this->dom->load(CONTROLLED_VOCAB_PLUGIN_DIR . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR . "$fileName");
		$this->xpath = new DOMXPath($this->dom);
		$this->vocabName = $this->xpath->query('//vocab/name')->item(0)->textContent;
	}
	
	function install()
	{
		$this->addVocab();
		$this->addTerms();
	}

	
	function addVocab()
	{		
		$vocabNode = $this->xpath->query('vocab')->item(0);		
		$newVocab = new ControlledVocab_Vocab();		
		$newVocab->name = $this->xpath->query('name', $vocabNode)->item(0)->textContent;
		$newVocab->description = $this->xpath->query('description', $vocabNode)->item(0)->textContent;
		$newVocab->uri = $this->xpath->query('uri', $vocabNode)->item(0)->textContent;
		$newVocab->collection = serialize(array());
		$newVocab->save();
		$this->vocabId = $newVocab->id;
	}
	
	function addTerms()
	{		
		
		$terms = $this->xpath->query('//term');

		foreach($terms as $term) {
			$newTerm = new ControlledVocab_Term();			
			$newTerm->name = $this->xpath->query('name', $term)->item(0)->textContent;
			$newTerm->description = $this->xpath->query('description', $term)->item(0)->textContent;
			$newTerm->uri = $this->xpath->query('uri', $term)->item(0)->textContent;
			$newTerm->vocab_id = $this->vocabId;
			$newTerm->element_ids = serialize($this->buildElIdsArray($term) );
			$newTerm->save();			
		}
	}
	
	function buildElIdsArray($term)
	{
		$elTable = get_db()->getTable('Element');
		//PHP thinks xpaths have a dot in front when there's a contextNode
		$elements = $this->xpath->query('.//element', $term); 
		$element_ids = array();
		
		foreach($elements as $element) {
			
			$elSet = $this->xpath->query('elementSet', $element)->item(0)->textContent;
			$elName = $this->xpath->query('elementName', $element)->item(0)->textContent;
			$omekaEl = $elTable->findByElementSetNameAndElementName($elSet, $elName);
			$element_ids[] = $omekaEl->id;			
		}		
		return $element_ids;
	}
	
	function isInstalled()
	{
		try {
			$vocabTable = get_db()->getTable('ControlledVocab_Vocab');
		} catch (Exception $e) {
			return false;
		}
		
		$vocab = $vocabTable->findBy(array('name'=>$this->vocabName));
		
		return (bool) count($vocab);
	}
	
}


?>
