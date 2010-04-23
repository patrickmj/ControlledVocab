<?php


class ControlledVocab_Term extends Omeka_Record {

    public $id; 
    public $name;
    public $description;
    public $uri; 
    public $vocab_id; 
    public $element_id; 


	public function findElementSetAndElement()
	{
		$db = get_db();
		$el = $db->getTable('Element')->findById($this->element_id);
		$elSet = $db->getTable('ElementSet')->findById($el->element_set_id);
		$retArray = array($elSet->name=>$el->name);
		$retObject = new StdClass();
		$retObject->elSet = $elSet->name;
		$retObject->el = $el->name;
		release_object($el);
		release_object($elSet);
		return $retObject;
		
	}

}


?>
