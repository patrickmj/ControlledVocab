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
		return parent::addAction();
		
	}
	
	public function editAction()
	{
		$vocabs = get_db()->getTable('ControlledVocab_Vocab')->findPairsForSelectForm();
        $varName = strtolower($this->_modelClass);
        
        $record = $this->findById();
        
        try {
            if ($record->saveForm($_POST)) {    
                $this->redirect->goto('show', null, null, array('id'=>$record->id));
            }
        } catch (Omeka_Validator_Exception $e) {
            $this->flashValidationErrors($e);
        } catch (Exception $e) {
            $this->flash($e->getMessage());
        }
        
        		
		$this->view->assign(array('vocabs'=>$vocabs, $varName=>$record , 'debug'=>$debug));
				
	}
}






?>
