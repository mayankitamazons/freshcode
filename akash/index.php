<?php
class Person implements JsonSerializable
{
    public $name;
    public  $password;
	public function __construct()
	{
	   require_once('connection.php');
	}
    
    public function getusername() 
    {
        $this->name = $n['name'];
        $this->password = $p['password'];
    }
    
    public function getname() 
    {
        return $this->name;
    }
    
    public function getpassword() 
    {
        return $this->password;
    }

    public function jsonSerialize()
    {
        return
		[
            'name'=>$this->getname();
            'password'=> $this->getpassword();
		];
       
    }
}
$person = new Person(array('name' =>'akash', 'password' => '14234')
echo json_encode($person);
?>