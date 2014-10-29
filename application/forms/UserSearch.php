<?php
class Application_Form_UserSearch extends Zend_Form
{
    public function init()
    {
		/*
			Defined Post type data transfert to server
			Defined Action place
		*/
        $this->setMethod('post')
				->setAction('');
		/*
			Creation input Email field including validation "email"
		*/
		$this->addElement('text', 'email', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-10 no-padding'))
					),
					'placeholder'   => 'Email address',
					'class'			=> 'form-control',
					'required'   	=> true,
					'filters'    	=> array('StringTrim','StripTags'),
					'validators' 	=> array(
						'EmailAddress'
					),
				));
		$this->addElement('submit', 'submit', array(
					'decorators' => array(
						'ViewHelper',
						array(array('div' => 'HtmlTag'), array('tag' => 'div', 'class' => 'col-xs-2 no-padding'))
					),
					'label'    => 'Search',
					'class'=>'btn btn-primary'));
		/*
			Add CSRF protection
		*/
		$this->addElement('hash', 'csrf', array('ignore' => true,));
		
		/*
			Personalize Decors of form tag
		*/
		$this->setDecorators(
			array(
				'FormElements',
				array('HtmlTag', array('tag' => 'div','class'=>'form-group')),
				'Form'
			)
		);
		$this->setAttrib('class','col-xs-12 col-sm-5 pull-right');
    }
}

