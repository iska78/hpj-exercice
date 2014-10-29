<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'hpj_users';
	
	public function findByEmail($email)
    {
		$row = $this->fetchRow(array('email = ?'=>$email));
        return ($row)?$row->toArray():false;
    }
}

