<?php




class ControlledVocab_VocabTable extends Omeka_Db_Table
{
	
	protected function _getColumnPairs()
	{
		return array(id, name);
	}
	
	public function applySearchFilters($select, $params)
	{		
        if(isset($params['name'])) {
            $this->filterByName($select, $params['name']);
        }      						
	}
	
	public function findByCollection($collection)
	{
		$vocabs = $this->findAll();
		return $this->_filterResultsByCollection($vocabs, $collection);
	}
	
	private function _filterResultsByCollection($results, $collection)
	{
		$collection_id = is_numeric($collection) ? $collection : $collection->id;
				
		foreach($results as $index=>$result) {
			if (! $result->appliesToCollection($collection_id)) {
				unset($results[$index]);
				release_object($result);
			}
		}
		return $results;		
	}	
	
	public function filterByName($select, $name)
	{
		$select->where("name = ?", $name);
		return $select;
	}
	
}
?>
