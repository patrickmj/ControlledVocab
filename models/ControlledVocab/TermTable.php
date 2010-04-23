<?php



class ControlledVocab_TermTable extends Omeka_Db_Table
{

	public function findByElementId($elId)
	{
		$sel = $this->getSelect();
		$sel->where("element_id = ?", $elId);
		return $this->fetchObjects($sel);
		
		
	}

	public function findByElement($element)
	{
		return $this->findByElementId($element->id);
	}

	public function findByElementSetNameAndElementName($elementSetName, $elementName)
	{
		
		$el = get_db()->getTable('Element')->findByElementSetNameAndElementName($elementSetName, $elementName); 
		return $this->findByElement($el);	
	}
	
	public function getFilterElements()
	{
		
	}
		
    protected function _getColumnPairs()
    {
        return array('id', 'name');
    }
	
}

?>
