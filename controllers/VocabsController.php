<?php

class ControlledVocab_VocabsController extends Omeka_Controller_Action
{
	
	public function init()
	{
		$this->_modelClass = 'ControlledVocab_Vocab';
	}
	
	public function addAction()
	{
       	if($_POST && isset($_POST['collection_ids'] )) {
        	$_POST['collection_ids'] = serialize($_POST['collection_ids']);	
        }
        return parent::addAction();
	}
	
	
}







?>
