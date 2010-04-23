<?php




class ControlledVocab_IndexController extends Omeka_Controller_Action
{
	
	
	
	public function indexAction()
	{
		$vocabs = get_db()->getTable('ControlledVocab_Vocab')->findAll();
		$terms = get_db()->getTable('ControlledVocab_Term')->findAll();
		$this->view->assign(array('vocabs'=>$vocabs, 'terms'=>$terms));
	}
}
?>
