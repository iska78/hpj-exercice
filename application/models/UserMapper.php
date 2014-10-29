<?php
class Application_Model_UserMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_User');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_User $user)
	{
		if(!$this->findByEmail($user)){
			$data = array(
				'first_name'=> $user->getFirstName(),
				'last_name'	=> $user->getLastName(),
				'email'		=> $user->getEmail(),
				'birth_date'=> $user->getBirthDate(),
				'ip'   		=> $user->getIP(),
				'created' 	=> $user->getCreated(),
			);
			return $this->getDbTable()->insert($data);
		}
		return false;
	}
	
	public function findByEmail(Application_Model_User $user)
	{
		if ($row = $this->getDbTable()->findByEmail($user->getEmail()))
		{
			$user->setBirthDate($row['birth_date']);
			$row['age'] = $user->getAge();
			return $row;
		}
		return false;
	}
}

