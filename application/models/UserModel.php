<?php


Class userModel extends CI_Model
{

	

	function saveNewStudent($data)
	{
		
		$this->db->insert('student_table', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}

	function saveLoginDetails($data)
	{
		
		$this->db->insert('logindetails', $data);	
					
		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}

		function returnStudentDetail($data)
	{

			$this->load->database(); 	
		
			$query=$this->db->select("u.Name,u.ID,u.Email,U.Phone,l.Password")
				->from("student_table u")
				->join("logindetails l","l.UserID=u.ID")
				->where("u.ID",$data);
				
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->result_array();	
					}
				else
					{
						return "sorry";
					}

	}


	function updateStudent($id=null,$name=null,$email=null,$mobile=null,$password=null)
{
    
        date_default_timezone_set('America/New_York'); # add your city to set local time zone
		//$now = date('Y-m-d');
		$now=date("Y-m-d");
			
			if($name!="" && $email!="")
			{
		
				$this->db->set('Name', $name);
		        $this->db->set('Email', $email);
		        $this->db->set('Phone', $mobile);
		        $this->db->set('UpdateDate', $now);
		        $this->db->where('ID', $id);
				$this->db->update('student_table');

				$encrypted=md5($password);

		        $this->db->set('Password', $encrypted);
				$this->db->where('UserID', $id);
				$this->db->update('logindetails');		
			        		
			    return "updated";
			          		
			}
    
}

	function UpdateSupervisor($id=null,$name=null,$email=null,$mobile=null,$password=null,$limit=null)
{
    
        date_default_timezone_set('America/New_York'); # add your city to set local time zone
		//$now = date('Y-m-d');
		$now=date("Y-m-d");
			
			if($name!="" && $email!="")
			{
		
				$this->db->set('Name', $name);
		        $this->db->set('Email', $email);
		        $this->db->set('Phone', $mobile);
		        $this->db->set('UpdateDate', $now);
		        $this->db->set('ProjLimit', $limit);
		        $this->db->where('ID', $id);
				$this->db->update('supervisor_table');

				$encrypted=md5($password);

		        $this->db->set('Password', $encrypted);
				$this->db->where('UserID', $id);
				$this->db->update('logindetails');		
			        		
			    return "updated";
			          		
			}
    
}

	
	function deleteStudent($id)
	{
	    	$this->load->database(); 	
			$this->db->where('UserID', $id);
	        $this->db->delete('logindetails'); 	
	        $num=$this->db->affected_rows();	
	        if($num>0)
	        {
	        	$this->load->database(); 	
				$this->db->where('ID', $id);
	        	$this->db->delete('student_table'); 	
	        
	        	return "deleted";
	        }
	        else
	        {
	    	    return "error";
	        }

	}

	function saveNewSupervisor($data)
	{
		
		$this->db->insert('supervisor_table', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}

		function returnSupervisorDetail($data)
	{

			$this->load->database(); 	
		
			$query=$this->db->select("u.Name,u.ID,u.Email,U.Phone,U.ProjLimit,l.Password")
				->from("supervisor_table u")
				->join("logindetails l","l.UserID=u.ID")
				->where("u.ID",$data);
				
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->result_array();	
					}
				else
					{
						return "sorry";
					}

	}


	function saveUserServices($data)
	{
		
		$this->db->insert('user_services', $data);	

		return "saved";
	}

	function returnConsultants($data)
	{

			$this->load->database(); 	
		
			$query=$this->db->select("u.name,u.id")
				->from("users u")
				->where("u.role","Consultant");
				
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->result_array();	
					}
				else
					{
						return "sorry";
					}

	}



	function returnUserId($name)
{
	
	$this->load->database(); 
			$query=$this->db->select("id")
					->from("users")
					->where('email',$name);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('id');	
					}
				else
					{
						return "sorry";
					}

}

	function checkUserPassword($id,$password)
{
	
	$this->load->database(); 
			$query=$this->db->select("password")
					->from("users")
					->where('id',$id)
					->where('password',$password);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('password');	
					}
				else
					{
						return "sorry";
					}

}


	function getUserDetails($name)
	{

			$this->load->database(); 	
		
			$query=$this->db->select("u.name,u.id,u.email,u.Designation,u.Phone,u.Mobile,u.Whatsapp,u.Skype,u.role")
				->from("users u")
				->where("u.id",$name);
				
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->result_array();	
					}
				else
					{
						return "sorry";
					}



	}

	public function getUserServices($data)
	{

		$this->load->database(); 
			$query=$this->db->select("s.Service,s.Service_ID,s.ServiceType")
					->from("user_services as us")
					->join("services as s",'s.Service_ID=us.Service_ID')
					->where("us.userId",$data)
					->where("status","active");
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->result_array();
					}
				else
					{
						return "sorry";
					}

	}

	function updateUsers($id,$name,$email,$designation,$phone,$mobile,$whtsapp,$role,$password)
	{
		$this->db->set('name', $name);
		$this->db->set('email', $email);
		$this->db->set('Designation', $designation);
		$this->db->set('Phone', $phone);
		$this->db->set('Mobile', $mobile);
		$this->db->set('Whatsapp', $whtsapp);
		$this->db->set('role', $role);
		$this->db->set('password', $password);

		$this->db->where('id', $id); //which row want to upgrade  
		$this->db->update('users'); 
	}


    function updateUsersSelf($id,$name,$email,$phone,$mobile,$skype,$encrypted)
	{
		$this->db->set('name', $name);
		$this->db->set('email', $email);
		$this->db->set('Phone', $phone);
		$this->db->set('Mobile', $mobile);
		$this->db->set('skype', $skype);
		$this->db->set('password', $encrypted);

		$this->db->where('id', $id); //which row want to upgrade  
		$this->db->update('users'); 
		
	        if($this->db->affected_rows()>0)
	        {
	        	echo"updated";
	        }
	        else
	        {
	    	    echo"sorry";
	        }

	}



		function checkUserServices($id)
	{

		$this->db->set('status', "inactive");
		$this->db->where('userId', $id); //which row want to upgrade  
		$this->db->update('user_services'); 


	}


		function checkExistService($ser,$id)
	{

		$this->load->database(); 
			$query=$this->db->select("*")
					->from("user_services")
					->where('userId',$id)
					->where('Service_ID',$ser);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return "yes";	
					}
				else
					{
						return "sorry";
					}


	}

		function updateUserServices($ser,$id)
	{
		$this->db->set('status', "active");
		$this->db->where('Service_ID', $ser);
		$this->db->where('userId', $id); //which row want to upgrade  
		$this->db->update('user_services'); 
	}
	
	
	function deleteUsers($id)
	{
	    	$this->load->database(); 	
			$this->db->where('id', $id);
	        $this->db->delete('users'); 	
	        $num=$this->db->affected_rows();	
	        if($num>0)
	        {
	        	echo"deleted";
	        }
	        else
	        {
	    	    echo"not";
	        }

	}


	

}


?>