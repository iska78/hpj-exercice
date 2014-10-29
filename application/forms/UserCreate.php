<?php

class Application_Form_UserCreate extends Zend_Form
{
	public function init()
    {
        $this->setMethod('post')
			->setName('formSign');
			
		/*
			Creation input email field including validation "email"
		*/
        $this->addElement('text', 'email', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-12 no-padding form-group'))
					),
					'placeholder'   				  => 'Email address',
					'class'							  => 'form-control',
					'data-validation-engine' 		  => "validate[required,custom[email]]",
					'required'   					  => true,
					'filters'    					  => array('StringTrim','StripTags'),
					'validators' 					  => array(
						'EmailAddress'
					),
				));
				
		/*
			Creation input First Name field including validation "onlyLetterSp"
		*/
		$this->addElement('text', 'fname', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-12 no-padding form-group'))
					),
					'placeholder'   => 'First Name',
					'class'			=> 'form-control',
					'data-validation-engine' 		  => "validate[required,custom[onlyLetterSp]]",
					'required'   	=> true,
					'filters'    	=> array('StringTrim','StripTags'),
					'validators' 	=> array(
						'NotEmpty'
					),
				));
				
		/*
			Creation input Last Name field including validation "onlyLetterSp"
		*/
		$this->addElement('text', 'lname', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-12 no-padding form-group'))
					),
					'placeholder'   => 'Last Name',
					'class'			=> 'form-control',
					'data-validation-engine' 		  => "validate[required,custom[onlyLetterSp]]",
					'required'   	=> true,
					'filters'    	=> array('StringTrim','StripTags'),
					'validators' 	=> array(
						'NotEmpty'
					),
				));
		/*
			Creation input Birth date field including validation "date"
		*/		
		$this->addElement('text', 'bdate', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-5 no-padding form-group'))
					),
					'placeholder'   => 'YYYY-MM-DD',
					'class'			=> 'form-control',
					'data-validation-engine' 		  => "validate[required,custom[date]]",
					'required'   	=> true,
					'filters'    	=> array('StringTrim','StripTags'),
					'validators' => array(
						  array('regex', false, array(
						  'pattern'   => '/^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/i',
						  'messages'  =>  'Your birdth date doesn correct:'))
					),
					
				));
		
        $this->addElement('submit', 'submit', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-12 no-padding form-group'))
					),
					'label'    => 'Save',
					'class'=>'col-xs-12 btn btn-success'));
		/*
			Add CSRF protection
		*/			
        $this->addElement('hash', 'csrf', array('decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div'))
					),'ignore' => true,));
    }

}

