<?php


class ControlledVocab_Vocab extends Omeka_Record {
    public $id; 
    public $name; 
    public $description;
    public $collection_ids;
    public $uri; 
    public $api_url;


	public function appliesToCollectionId($collection_id)
	{
		$vocabCollections = unserialize($this->collection_ids);
		return in_array($collection_id, $vocabCollections);
	}


}

?>
