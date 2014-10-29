<?php

class UserController extends Zend_Controller_Action
{
    public function indexAction()
    {
		$form = new Application_Form_UserCreate();
		$this->view->form = $form;
		if ($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getPost())) {	
				$rows = $form->getValues();
				/*
					Create instance of User class with personalization from user data
				*/
				$user = new Application_Model_User(
							array(
								'email'			=> $rows['email'],
								'first_name'	=> $rows['fname'],
								'last_name'		=> $rows['lname'],
								'birth_date'	=> $rows['bdate'],
							));
				$mapper  = new Application_Model_UserMapper();
				/*
					Save new user in hpj_user
				*/
				if($mapper->save($user)){
					Zend_Layout::getMvcInstance()->assign('alert', "Thanks {$rows['fname']} you account created");
					$this->_helper->redirector('index','index');
				}
				else{
					Zend_Layout::getMvcInstance()->assign('alert', "The mail {$rows['email']} is not available");	
				}
			}
		}
    }
}



