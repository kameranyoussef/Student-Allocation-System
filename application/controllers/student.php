<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()
	{
	
	}


	public function showTopicPage()
	{

	$this->load->view('studentViews/topics');

	}

	public function saveStudentProject()

	{
		$this->load->library('session');
		$this->load->model('StudentModel');

		date_default_timezone_set('America/New_York'); # add your city to set local time zone
		$now = date('Y-m-d H:i:s');
		$user=$this->session->userdata('userid');
		$userDep=$this->StudentModel->getStudentDepartments($user);

		$data = array(	
		'ID'=>null,	
		'SupervisorID'=>$this->input->post('supervisor'),
		'StudentID'=>$user,
		'CourseID'=>$this->input->post('course'),
		'DepartmentID'=>$userDep,
		'TopicID'=>$this->input->post('topic'),
		'State'=>"Pending",
		'Message'=>$this->input->post('message'),
		'DateAdded'=>$now,

	);

		
		$insertId=$this->StudentModel->newProjectRequest($data);

		if($insertId!=null)
		{
			$someJSON = json_encode("yes");
 			echo $someJSON;		
			//redirect('student/showTopicPage');
		}
		else
		{
			$someJSON = json_encode("no");
 			echo $someJSON;	
		}
			
	}


	public function TopicsRecord()
	{
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');
		$userDep=$this->StudentModel->getStudentDepartments($user);
	
		$this->load->library('Datatables');
	 	$this->datatables->select('t.ID,t.Name,t.Description,t.Objective,t.Goals,t.Complexity,t.DateTime,c.Name as CourseName,d.Name as DepartName, s.Name as SupName')
	   ->from('topics_table t')  
	   ->join("departments d",'t.DepartmentID=d.ID','left')
	   ->join("courses c",'t.CourseID=c.ID','left')
	   ->join("supervisor_table s",'t.SupervisorID=s.ID')
	   ->where("t.DepartmentID",$userDep);

	   
	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">Edit</i></a>','ID');
	   echo $this->datatables->generate();
				
	}

	public function filterTopicRecord()
	{
		
		$title=$this->input->post('title');
		$supervisor=$this->input->post('supervisor');
		$course=$this->input->post('course');
		$complexity=$this->input->post('complexity');

		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');
		$userDep=$this->StudentModel->getStudentDepartments($user);

		$this->load->library('Datatables');
	 	$this->datatables->select('t.ID,t.Name,t.Description,t.Objective,t.Goals,t.Complexity,t.DateTime,c.Name as CourseName,d.Name as DepartName, s.Name as SupName')
	   ->from('topics_table t')  
	   ->join("departments d",'t.DepartmentID=d.ID','left')
	   ->join("courses c",'t.CourseID=c.ID','left')
	   ->join("supervisor_table s",'t.SupervisorID=s.ID')
	   ->where("t.DepartmentID",$userDep)
	   ->where("t.Name like","%".$title."%")
	   ->where("s.Name like","%".$supervisor."%")
	   ->where("c.Name like","%".$course."%")
	   ->where("t.Complexity like","%".$complexity."%");

	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">Edit</i></a>','ID');
	   echo $this->datatables->generate();


	}

	public function showNewApplyProject()
	{
			$this->load->model('StudentModel');
			$user=$this->session->userdata('userid');
			$userValid=$this->StudentModel->getStudentProjects($user);
			if($userValid=="yes")
			{

				redirect("student/showAppliedProjects");
			}
			else
			{
			$userDep=$this->StudentModel->getStudentDepartments($user);

			$result['courses']=$this->StudentModel->getCourses($userDep);
			$this->load->view('studentViews/newProjectPage',$result);
			}
	}

	public function getSupervisors()
	{
		$course=$this->input->post('course');


		$this->load->model('StudentModel');
		$result['supervisors']=$this->StudentModel->getSupervisorByCourse($course);
		if($result['supervisors']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
			$someJSON = json_encode($result);
 			echo $someJSON;		
 		}

	}

	public function getSupervisorsTopics()
	{
		$course=$this->input->post('course');
		$supervisor=$this->input->post('supervisor');

		$this->load->model('StudentModel');
		$result['topics']=$this->StudentModel->getSupervisorTopics($course,$supervisor);

		if($result['topics']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
			$someJSON = json_encode($result);
 			echo $someJSON;		
 		}

	}


	public function getTopicsDetail()
	{
		$course=$this->input->post('topic');

		$this->load->model('StudentModel');
		$result['topicsDetails']=$this->StudentModel->getTopicsDetails($course);

		if($result['topicsDetails']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
			$someJSON = json_encode($result);
 			echo $someJSON;		
 		}

	}

	public function showAppliedProjects()
	{
		$this->load->view('studentViews/appliedProjects');

	}


	public function getCurrentProject()
	{
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');
	
		$this->load->library('Datatables');
	 	$this->datatables->select('tp.ID,tp.DateAdded,tp.State,tt.Name as topicName,c.Name as courseName,s.Name as supervisorName')
	   ->from('taken_projects tp')  
	   ->join("topics_table tt",'tt.ID=tp.TopicID','left')
	   ->join("courses c",'tp.CourseID=c.ID','left')
	   ->join("supervisor_table s",'tp.SupervisorID=s.ID')
	   ->where("tp.StudentID",$user);

	   
	   echo $this->datatables->generate();
				
	}

	public function showSuggestTopic()
	{
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');

		$editResult['departments']=$this->StudentModel->getStudentDepartments($user);
		$editResult['supervisor']=$this->StudentModel->getStudentDepartments($user);
		
		$editResult['courses']=$this->StudentModel->getCourses($editResult['departments']);
		$this->load->view('studentViews/suggestTopic',$editResult);

	}

	public function saveSuggestedTopic()

	{
		$this->load->library('session');
		date_default_timezone_set('America/New_York'); # add your city to set local time zone
		$now = date('Y-m-d H:i:s');
		$this->load->model('StudentModel');
		
		$user=$this->session->userdata('userid');

		$editResult['departments']=$this->StudentModel->getStudentDepartments($user);

		$data = array(	
		'ID'=>null,	
		'Name'=>$this->input->post('topicName'),
		'Description'=>$this->input->post('topicDesc'),
		'Objective'=>$this->input->post('topicObj'),
		'Goals'=>$this->input->post('topicGoal'),
		'Complexity'=>$this->input->post('topicComplex'),
		'CourseID'=>$this->input->post('courseID'),
		'SupervisorID'=>$this->input->post('stdSup'),
		'DepartmentID'=>$editResult['departments'],
		'State'=>"Waiting",
		'CreatedBy'=>$user,
		'DateTime'=>$now,
	);

		
		$insertId=$this->StudentModel->suggestNewTopic($data);

		if($insertId!=null)
		{
			
			redirect('student/showTopicPage');
		}
			
	}

	public function showAppointments()
	{	
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');

		$editResult['departments']=$this->StudentModel->getStudentDepartments($user);
		$editResult['supervisors']=$this->StudentModel->getAllSupervisors($editResult['departments']);

		$this->load->view('studentViews/appointmentPage',$editResult);


	}

	public function saveAppointment()
	{
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');

		$data = array(	
		'ID'=>null,	
		'StudentID'=>$user,
		'SupervisorID'=>$this->input->post('supID'),
		'Date'=>$this->input->post('apDate'),
		'Time'=>$this->input->post('apTime'),
		'Msg'=>$this->input->post('apMsg'),

		'State'=>"Pending",
		
		);

		$insertId=$this->StudentModel->saveAppointment($data);

		if($insertId!=null)
		{
			redirect('student/showTopicPage');
		}

	}
	
	//for mobile 
	public function showMobileTopics()
	{	
		$this->load->view('studentViewsM/topics');
	}
	public function showMobileAppliedProjects()
	{	
		$this->load->view('studentViewsM/appliedProjects');
	}
	public function showMobileAppointments()
	{	
	
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');

		$editResult['departments']=$this->StudentModel->getStudentDepartments($user);
		$editResult['supervisors']=$this->StudentModel->getAllSupervisors($editResult['departments']);

		$this->load->view('studentViewsM/appointmentPage',$editResult);
	}
	
	public function saveMobileAppointment()
	{
		$this->load->model('StudentModel');
		$user=$this->session->userdata('userid');

		$data = array(	
		'ID'=>null,	
		'StudentID'=>$user,
		'SupervisorID'=>$this->input->post('supID'),
		'Date'=>$this->input->post('apDate'),
		'Time'=>$this->input->post('apTime'),
		'Msg'=>$this->input->post('apMsg'),

		'State'=>"Pending",
		
		);

		$insertId=$this->StudentModel->saveAppointment($data);

		if($insertId!=null)
		{
			redirect('student/showMobileTopics');
		}

	}
}

		