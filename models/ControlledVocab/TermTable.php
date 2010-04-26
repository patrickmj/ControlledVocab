<?php



class ControlledVocab_TermTable extends Omeka_Db_Table
{

	public function filterByVocab($select, $vocab) 
	{
        $select->joinInner(array('v' => $this->getDb()->ControlledVocab_Vocab), 
                           'vocab_id = v.id', 
                           array());
        
        if ($vocab instanceof ControlledVocab_Vocab) {
            $select->where('v.id = ?', $vocab->id);
        } else if (is_numeric($vocab)) {
            $select->where('v.id = ?', $vocab);
        } else {
            $select->where('v.name = ?', $vocab);
        }		
	}
	

	public function findByVocabAndElement($vocab, $element)
	{
		$results = $this->findBy(array('vocab'=>$vocab));
		
		return $this->_filterResultsByElement($results, $element);
	}
	
	/**
	 * findByVocabAndCollectionAndElementForSelect
	 * returns an array of the form:
	 * array('Vocab'=>array('term_id'=>'term_name', . . . ), 'Vocab2'=>array(. . . ))
	 * That is, an array of the vocabulary names that map onto pairsForSelectForm
	 * @return array
	 */
	
	
	public function findByCollectionAndElementForSelect($collection, $element)
	{
		//first, dig up the vocabs
		$vocabTable = $this->getDb()->getTable('ControlledVocab_Vocab');
		$vocabs = $vocabTable->findByCollection($collection);
		$returnArray = array();
		foreach($vocabs as $vocab) {
			$vocabName = $vocab->name;
			
			$terms = $this->findByVocabAndElement($vocab, $element);
			foreach($terms as $term) {
				$returnArray[$vocabName][$term->id] = $term->name;
				release_object($term);
			}
			release_object($vocab);
		}
		return $returnArray;
	}

	private function _filterResultsByElement($results, $element)
	{
		$element_id = is_numeric($element) ? $element : $element->id;
		
		foreach($results as $index=>$result) {
			$termElements = unserialize($result->element_ids);
			if( ! in_array($element_id, $termElements)) {
			//if (false ===  $result->appliesToElementId($element_id)) {
			//if($element_id == 51) {							
				unset($results[$index]);
				release_object($result);
			}
		}
		
		return $results;
	}
	
	public function getElementSetsAndElements() {
		$terms = $this->findAll();
		$returnArray = array();
		foreach($terms as $term) {
			$termData = $term->getElementSetAndElement();
			$elSets = array_keys($termData);
			foreach($elSets as $elSet) {
				if(isset($returnArray[$elSet])) {
					$returnArray[$elSet] = array_merge($returnArray[$elSet], $termData[$elSet]);	
				} else {
					$returnArray[$elSet] = array();
					$returnArray[$elSet] = array_merge($returnArray[$elSet], $termData[$elSet]);
				}
				
			}

			release_object($term);
		}
		foreach ($returnArray as $elSet=>$array) {
			$returnArray[$elSet] = array_unique($array);
		}
		return $returnArray;
	}

	public function applySearchFilters($select, $params)
	{		
		
		if(isset($params['alpha'])) {
			$select->order('name ASC');	
		}
        if(isset($params['vocab'])) {
            $this->filterByVocab($select, $params['vocab']);
        }      						
	}
		
    protected function _getColumnPairs()
    {
        return array('id', 'name');
    }
	
}

?>
