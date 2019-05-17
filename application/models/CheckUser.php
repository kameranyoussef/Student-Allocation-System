<?php





Class CheckUser extends CI_Model

{



function returnUsers($username,$password,$UserType)

{

		$this->load->database(); 
		$query=$this->db->select("*")
				->from("logindetails")
				->where("username", $username)
				->where("Password", $password)
				->where("UserType", $UserType);
				$query=$this->db->get();

				if($query->num_rows()>0)

					{
						return $query->row('UserID');

					}
				else
					{
						return "sorry";

					}

}



}





?>