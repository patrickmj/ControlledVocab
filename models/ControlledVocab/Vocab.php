<?php


class ControlledVocab_Vocab extends Omeka_Record {
    public $id; 
    public $name; 
    public $description;
    public $collection_ids;
    public $uri; 
    public $api_url;


	public function appliesToCollection($collection)
	{
		$collection_id = is_numeric($collection) ? $collection : $collection->id;
		$vocabCollections = unserialize($this->collection_ids);
		if(false === $vocabCollections) {
			$vocabCollections = array();
		}
		return in_array($collection_id, $vocabCollections);
	}

	public function getCollectionNames()
	{
		$collectionTable = $this->getDb()->getTable('Collection');
		$returnArray = array();
		if(is_array(unserialize($this->collection_ids) ) ) {
			foreach(unserialize($this->collection_ids) as $collection_id)
			{
				$collection = $collectionTable->find($collection_id);
				$returnArray[] = $collection->name;
				release_object($collection);
			}			
			
		}

		return $returnArray;
	}
}

?>
