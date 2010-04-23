<?php




class ControlledVocab_VocabTable extends Omeka_Db_Table
{
	
	protected function _getColumnPairs()
	{
		return array(id, name);
	}
	
	
	
}
?>
