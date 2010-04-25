<?php


class ControlledVocab_TermsController extends Omeka_Controller_Action
{
	
    public function init() 
    {
        $this->_modelClass = 'ControlledVocab_Term';
    } 


	public function addAction()
	{
		$vocabs = get_db()->getTable('ControlledVocab_Vocab')->findPairsForSelectForm();
		
		$this->view->assign(array('vocabs'=>$vocabs, 'debug'=>''));
		if($_POST && isset($_POST['element_ids'])) {
			$_POST['element_ids'] = serialize($_POST['element_ids']);
		}
		
		return parent::addAction();
		
	}
	
	public function editAction()
	{
		$vocabs = get_db()->getTable('ControlledVocab_Vocab')->findPairsForSelectForm();
		$this->view->assign(array('vocabs'=>$vocabs));
 		if($_POST && isset($_POST['element_ids'])) {
			$_POST['element_ids'] = serialize($_POST['element_ids']);
		}
 		return parent::editAction();
	}
	

	public function browseAction()
	{
		$params = $this->_getAllParams();
		if(isset($params['vocab'])) {
			$vocabName = $this->getDb()->getTable('ControlledVocab_Vocab')->find($params['vocab'])->name;
			$this->view->assign(array('vocabName'=>$vocabName) );
		}
		return parent::browseAction();
	}

}






?>
