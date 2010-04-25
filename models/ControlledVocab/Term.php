<?php


class ControlledVocab_Term extends Omeka_Record {

    public $id; 
    public $name;
    public $description;
    public $uri; 
    public $vocab_id; 
    public $element_ids; 


	public function getElementSetAndElement()
	{
		$db = get_db();
		$elTable = $db->getTable('Element');
		$retObject = new StdClass();
		
		$el_ids = unserialize($this->element_ids);
		$retArray = array();	
		foreach($el_ids as $el_id) {
			$el = $elTable->find($el_id);
			$elSet = $el->getElementSet();
			$retArray[$elSet->name][] =$el->name;
			release_object($el);
			release_object($elSet);
		}
		

		return $retArray;		
	}

	public function appliesToElement($element)
	{
		$element_id = is_numeric($element) ? $element : $element->id;
		$termElements = unserialize($this->element_ids);
		return in_array($element_id, $termElements);
	}
	
	public function vocabAppliesToCollection($collection_id)
	{
		$vocab = $this->getDb()->getTable('ControlledVocab_Vocab')->find($this->vocab_id);
		return $vocab->appliesToCollection($collection_id);
	}

}


?>
