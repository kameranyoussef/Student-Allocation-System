<?php


Class SupervisorModel extends CI_Model
{

	public function getSupervisorDepartments($id=null)
	{
		
			$this->load->database(); 
			$query=$this->db->select("dep.ID,dep.Name")
					->from("supervisor_table st")
					->join("departments dep","dep.ID=st.DepartmentID")
					->where("st.ID=",$id);
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


	public function getSupervisor($id=null)
	{
			$this->load->database(); 
			$query=$this->db->select("st.ID,st.Name")
					->from("supervisor_table st")
					->where("st.ID=",$id);
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


	public function getCourses($id)
	{
			$this->load->database(); 
			$query=$this->db->select("c.ID,c.Name")
					->from("courses c")
					->where("c.DepartmentID",$id);
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

	function saveNewSupervisorCourse($data)
	{
		
		$this->db->insert('supervisor_courses', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}


	public function getSupervisorCourse($s)
	{
		$this->load->database(); 
			$query=$this->db->select("c.ID,c.Name")
					->from("supervisor_courses sc")
					->join("courses c",'c.ID=sc.CourseID','left')
					->where("sc.SupervisorID",$s);

			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->result_array();
					}
				else
					{
						return "no";
					}

	}


	public function checkExistCourse($s,$c)
	{
		$this->load->database(); 
			$query=$this->db->select("*")
					->from("supervisor_courses sc")
					->where("sc.CourseID",$c)
					->where("sc.SupervisorID",$s);

			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return "yes";
					}
				else
					{
						return "no";
					}

	}


	function saveNewTopic($data)
	{
		
		$this->db->insert('topics_table', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}
	

	function returnStudentID($name)
	{
	
	$this->load->database(); 
			$query=$this->db->select("StudentID")
					->from("taken_projects")
					->where('ID',$name);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('StudentID');	
					}
				else
					{
						return "sorry";
					}

	}

	
	function returnStudentName($name)
	{
	
	$this->load->database(); 
			$query=$this->db->select("Name")
					->from("student_table")
					->where('ID',$name);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('Name');	
					}
				else
					{
						return "sorry";
					}

	}


	

	public function AcceptProject($id=null,$user=null)
	{
		$this->db->set('State', "Accepted");
        $this->db->where('ID', $id);
		$this->db->update('taken_projects');

			if ($this->db->affected_rows() > 0)
		        {
		        	$this->db->set('ProjLimit', "ProjLimit-1",false);
        			$this->db->where('ID', $user);
					$this->db->update('supervisor_table');

					if ($this->db->affected_rows() > 0)
					{
						return "updated";

					}
					else
					{
						return "sorry";	

					}

		        }
		    else
					{
						return "sorry";	

					}    

	}



	public function CancelProject($id=null,$user=null)
	{
		$this->db->set('State', "Rejected");
        $this->db->where('ID', $id);
		$this->db->update('taken_projects');

			if ($this->db->affected_rows() > 0)
		        {
		        	
						return "updated";
		        }
		    else
				{
						return "sorry";	

				}    

	}

	function returnStudentIDAppoint($name)
	{
	
	$this->load->database(); 
			$query=$this->db->select("StudentID")
					->from("appoint_requests")
					->where('ID',$name);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('StudentID');	
					}
				else
					{
						return "sorry";
					}

	}

	function returnAppointDate($name)
	{
	
	$this->load->database(); 
			$query=$this->db->select("Date")
					->from("appoint_requests")
					->where('ID',$name);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('Date');	
					}
				else
					{
						return "sorry";
					}

	}

	public function AcceptAppointment($id=null)
	{
		$this->db->set('State', "Accepted");
        $this->db->where('ID', $id);
		$this->db->update('appoint_requests');

			if ($this->db->affected_rows() > 0)
		        {
		        	
						return "updated";
		        }
		    else
				{
						return "sorry";	

				}    

	}

	public function RejectAppointment($id=null)
	{
		$this->db->set('State', "Rejected");
        $this->db->where('ID', $id);
		$this->db->update('appoint_requests');

			if ($this->db->affected_rows() > 0)
		        {
		        	
						return "Rejected";
		        }
		    else
				{
						return "sorry";	

				}    

	}


	
	

}


?>