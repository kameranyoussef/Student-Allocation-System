<?php


Class GeneralModel extends CI_Model
{

	

	function saveNewServices($data)
	{
		
		$this->db->insert('services', $data);	

	}


	function getDepartments()
	{


		$this->load->database(); 
			$query=$this->db->select("ID,Name")
					->from("departments");
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



	function supEmail($id)
	{
	
	$this->load->database(); 
			$query=$this->db->select("Email")
					->from("supervisor_table")
					->where('ID',$id);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('Email');	
					}
				else
					{
						return "sorry";
					}

	}

	function stdEmail($id)
	{
	
	$this->load->database(); 
			$query=$this->db->select("Email")
					->from("student_table")
					->where('ID',$id);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('Email');	
					}
				else
					{
						return "sorry";
					}

	}

	
	

}


?>