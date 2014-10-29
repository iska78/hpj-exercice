<?php
class Application_Model_User
{
    protected $id;
	protected $first_name;
	protected $last_name;
	protected $email;
	protected $birth_date;
	protected $ip;
	protected $created;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
			$this->__set($key,$value);
        }
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }
	
	public function getEmail()
    {
        return $this->email;
    }
	
	public function setFirstName($name)
    {
        $this->first_name = (string) $name;
        return $this;
    }
	
	public function getFirstName()
    {
        return $this->first_name;
    }
	
	public function setLastName($name)
    {
        $this->last_name = (string) $name;
        return $this;
    }
	
	public function getLastName()
    {
        return $this->last_name;
    }
	
	public function setBirthDate($date)
    {
        $this->birth_date = (string) $date;
        return $this;
    }
	
	public function getBirthDate()
    {
        return $this->stringToDate($this->birth_date);
    }
	
	public function getAge()
    {
        return date_diff(date_create($this->birth_date), date_create('now'))->y;
    }
	
	public function setIP()
    {
        $this->ip = Zend_Controller_Front::getInstance()->getRequest()->getServer('REMOTE_ADDR');
        return $this;
    }
	
	public function getIP()
    {
		if(!isset($this->ip))
		{
			$this->setIP();
		}
        return $this->ip;
    }
	
	public function setCreated()
    {
        $this->created = date('Y-m-d H:i:s');
        return $this;
    }
	
	public function getCreated()
    {
		if(!isset($this->created))
		{
			$this->setCreated();
		}
        return $this->created;
    }
	
	public function stringToDate($str,$type = 'Y-m-d',$default)
	{
		if(!preg_match("/^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/i",$str))
		{
			return (!isset($default))?date($type):$default;
		}
		$rows = preg_split('/[\s\-\/\:]/',$str);
		return date($type,strtotime($rows[2].'-'.$rows[0].'-'.$rows[1]));
	}
}	

