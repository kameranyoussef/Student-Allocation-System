<?php


Class StudentModel extends CI_Model
{

	public function getStudentDepartments($id=null)
	{
			$this->load->database(); 
			$query=$this->db->select("DepartmentID")
					->from("student_table")
					->where("ID=",$id);
			$query=$this->db->get();
				if($query->num_rows()>0)
					{
						return $query->row('DepartmentID');
					}
				else
					{
						return "sorry";
					}
	}


	public function getSupervisorByCourse($id=null)
	{
			$this->load->database(); 
			$query=$this->db->select("st.ID,st.Name")
					->from("supervisor_courses sc")
					->join("supervisor_table st",'st.ID=sc.SupervisorID','left')
					->where("sc.CourseID =",$id)
					->where("st.ProjLimit >",0);

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


	function newProjectRequest($data)
	{
		
		$this->db->insert('taken_projects', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}


	public function getSupervisorTopics($c=null,$s=null)
	{

		$this->load->database(); 
			$query=$this->db->select("tt.ID,tt.Name")
					->from("topics_table tt")
					->where("tt.SupervisorID",$s)
					->where("tt.CourseID",$c);

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

	public function getTopicsDetails($c=null)
	{

		$this->load->database(); 
			$query=$this->db->select("tt.Description,tt.Goals,St.Name,tt.CourseID,tt.SupervisorID")
					->from("topics_table tt")
					->join("supervisor_table st","st.ID=tt.SupervisorID")
					->where("tt.ID",$c);

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

	public function getStudentProjects($c=null)
	{

		$this->load->database(); 
			$query=$this->db->select("*")
					->from("taken_projects")
					->where('StudentID',$c)
					->where("(State='Pending' OR State='Accepted')",NULL,FALSE);

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

	function suggestNewTopic($data)
	{
		
		$this->db->insert('suggested_topics', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}


	public function getAllSupervisors($s)
	{
		$this->load->database(); 
			$query=$this->db->select("st.ID,st.Name")
					->from("supervisor_table st")
					->where("st.DepartmentID",$s);

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


	function saveAppointment($data)
	{
		
		$this->db->insert('appoint_requests', $data);	

		$insert_id = $this->db->insert_id();

  		 return  $insert_id;

	}

	

}


?>