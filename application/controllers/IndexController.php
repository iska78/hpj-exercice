<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$form = new Application_Form_UserSearch();
		$this->view->form = $form;
		/*
			User Search Detector
		*/
		if ($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())) {
                $mapper  = new Application_Model_UserMapper();
				if($user = $mapper->findByEmail(new Application_Model_User($form->getValues())))
				{
					/*
						Found a user in our DB
					*/
					$this->view->user = $user;
				}
				else{
					/*
						Noithing we redirect to user page to demande user to create a new user
					*/
					$this->_helper->redirector('index','user');
				}
			}
        }
    }
}







