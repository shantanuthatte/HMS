<?php
class User extends CI_Model {
	
	var $userId = '';
	var $userName = '';
	var $recoveryEmail = "";
	var $person = NULL;
	var $type = 0;
	var $permission = 0;
	
	function User($id, $username, $recoveryEmail, $personId, $type, $permission)
	{
		$this->userId=$id;
		$this->userName=$username;
		$this->recoveryEmail=$recoveryEmail;
		$this->person=new Person();
		$this->type=$type;
		$this->permission=$permission;
		return $this;
	}
	
	function __construct()
	{
		//Use default constructor
		parent::__construct();
	}
	
	function validUser($username,$password){
		if(User::selectUser(TRUE,0,$username,$password) == 1)
			return TRUE;
		else
			return FALSE;
		
	}
	
	function selectUser($num=FALSE, $id=0, $username="", $password="", $email="", $personId=0)
	{
		
		$this->db->select('*');
		$this->db->from('users');
		if($id!=0)
			$this->db->where('userId', $id);
		if($username!="")
			$this->db->where('userName', $username);
		if($password!="")
			$this->db->where('password', $password);
		if($email!="")
			$this->db->where('recoveryEmail', $email);
		if($personId!=0)
			$this->db->where('personId', $personId);
		
		$this->db->where('password', $this->input->post('password'));
		$query = $this->db->get();
		if($num)
			return $query->num_rows();
		else
			if($query->num_rows() == 1)
			{
				$row = $query->row();
				return new User($row->userID, $row->userName, $row->recoveryEmail, $row->personId, $row->type, $row->permission);
			}
			else
			{
				return FALSE;
			}
	}
}

?>