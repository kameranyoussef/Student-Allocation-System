<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends CI_Controller {

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

	$this->load->view('supervisorViews/topics');

	}

	public function saveNewTopic()

	{
		$this->load->library('session');
		date_default_timezone_set('America/New_York'); # add your city to set local time zone
		$now = date('Y-m-d H:i:s');
		$user=$this->session->userdata('userid');

		$data = array(	
		'ID'=>null,	
		'Name'=>$this->input->post('topicName'),
		'Description'=>$this->input->post('topicDesc'),
		'Objective'=>$this->input->post('topicObj'),
		'Goals'=>$this->input->post('topicGoal'),
		'Complexity'=>$this->input->post('topicComplex'),
		'CourseID'=>$this->input->post('courseID'),
		'SupervisorID'=>$user,
		'DepartmentID'=>$this->input->post('stdDepart'),
		'CreatedBy'=>$user,
		'DateTime'=>$now,
	);

		
		$this->load->model('SupervisorModel');
		$insertId=$this->SupervisorModel->saveNewTopic($data);

		if($insertId!=null)
		{
			
			redirect('Supervisor/showTopicPage');
		}
			
	}

	public function showDashboard()
	{

		$this->load->view("supervisorViews/supervisordashboard");
	}
	public function TopicsRecord()
	{

		$user=$this->session->userdata('userid');
	
		$this->load->library('Datatables');
	 	$this->datatables->select('t.ID,t.Name,t.Description,t.Objective,t.Goals,t.Complexity,t.DateTime,c.Name as CourseName,d.Name as DepartName, s.Name as SupName')
	   ->from('topics_table t')  
	   ->join("departments d",'t.DepartmentID=d.ID','left')
	   ->join("courses c",'t.CourseID=c.ID','left')
	   ->join("supervisor_table s",'t.SupervisorID=s.ID')
	   ->where("t.SupervisorID",$user);

	   
	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">Edit</i></a>','ID');
	   echo $this->datatables->generate();
				
	}


	public function newTopicPage()
	{	
		$this->load->model('SupervisorModel');
		$user=$this->session->userdata('userid');
		$editResult['departments']=$this->SupervisorModel->getSupervisorDepartments($user);
		$editResult['courses']=$this->SupervisorModel->getSupervisorCourse($user);
		if($editResult['courses']=="no")
		{
			redirect('Supervisor/showTopicPage');

		}
		else
		{
		$this->load->view('supervisorViews/newTopic',$editResult);	
		}	
	}

	public function showRequestPage()
	{
		$this->load->view('supervisorViews/requestPage');	
		
	}

	public function RequestsRecord()
	{
		$user=$this->session->userdata('userid');
				

		$this->load->library('Datatables');
	 	$this->datatables->select('tp.ID,st.Name as studentName,c.Name as courseName,d.Name as departmentName,tp.State,tp.DateAdded,tt.Name as topicName')
	   ->from('taken_projects tp')  
	   ->join("departments d",'tp.DepartmentID=d.ID','left')
	   ->join("courses c",'tp.CourseID=c.ID','left')
	   ->join("student_table st",'tp.StudentID=st.ID')
	   ->join("topics_table tt",'tp.TopicID=tt.ID')
	   ->where("tp.SupervisorID",$user)
	   ->where("tp.State","Pending");

	   
	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">More</i></a>','ID');
	   echo $this->datatables->generate();
	}


	public function StudentDetail()
	{

		$id=$this->input->post('id');
		$this->load->model('SupervisorModel');
		$student=$this->SupervisorModel->returnStudentID($id);	

		$this->load->model('userModel');	

		$res['student']=$this->userModel->returnStudentDetail($student);	
		if($res['student']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
			$someJSON = json_encode($res);
 			echo $someJSON;		
 		}
	}

	public function sendEmail($s=null,$t=null,$p=null,$m=null)

	{
			
	$this->load->library('email');
	$config['protocol']    = 'smtp';
	$config['smtp_host']    = 'ssl://smtp.gmail.com';
	$config['smtp_port']    = '465';
	$config['smtp_timeout'] = '7';
	$config['smtp_user']    = $s;
	$config['smtp_pass']    = $p;
	$config['charset']    = 'utf-8';
	$config['newline']    = "\r\n";
	$config['mailtype'] = 'text'; // or html
	$config['validation'] = TRUE; // bool whether to validate email or not      

	$this->email->initialize($config);


	$this->email->from($s, 'sender');
	$this->email->to($t); 
	$this->email->subject('Project Management');
	$this->email->message($m);  
	
	$this->email->send();

	
	

	}


	public function AcceptProject()
	{
		$user=$this->session->userdata('userid');
		
		$this->load->model('SupervisorModel');
		
		$id=$this->input->post('id');
		$pass=$this->input->post('pass');

		$student=$this->SupervisorModel->returnStudentID($id);
		$studentName=$this->SupervisorModel->returnStudentName($student);

		$res['request']=$this->SupervisorModel->AcceptProject($id,$user);	
		if($res['request']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
 			$this->load->model('GeneralModel');
			$supEmail=$this->GeneralModel->supEmail($user);
			$stdEmail=$this->GeneralModel->stdEmail($student);
			
			$message="Hi ".$studentName.", Your project request has been accepted.";

			$this->sendEmail($supEmail,$stdEmail,$pass,$message);

			

			//$someJSON = json_encode($res);
 			//echo $someJSON;	
 		}

	}



	public function CancelProject()
	{
		$user=$this->session->userdata('userid');
		
		$this->load->model('SupervisorModel');
		
		$id=$this->input->post('id');
		$pass=$this->input->post('pass');

		$student=$this->SupervisorModel->returnStudentID($id);
		$studentName=$this->SupervisorModel->returnStudentName($student);

		$res['request']=$this->SupervisorModel->CancelProject($id,$user);	
		if($res['request']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
 			$this->load->model('GeneralModel');
			$supEmail=$this->GeneralModel->supEmail($user);
			$stdEmail=$this->GeneralModel->stdEmail($student);
			
			$message="Hi ".$studentName.", Your project request has been rejected.";

			$this->sendEmail($supEmail,$stdEmail,$pass,$message);

			

			$someJSON = json_encode($res);
 			echo $someJSON;	
 		}

	}

	public function showHistory()
	{
		$this->load->view('supervisorViews/historyPage');		
	}


	public function HistoryRecord()
	{
		$user=$this->session->userdata('userid');
				

		$this->load->library('Datatables');
	 	$this->datatables->select('tp.ID,st.Name as studentName,c.Name as courseName,d.Name as departmentName,tp.State,tp.DateAdded,tt.Name as topicName')
	   ->from('taken_projects tp')  
	   ->join("departments d",'tp.DepartmentID=d.ID','left')
	   ->join("courses c",'tp.CourseID=c.ID','left')
	   ->join("student_table st",'tp.StudentID=st.ID')
	   ->join("topics_table tt",'tp.TopicID=tt.ID')
	   ->where("tp.SupervisorID",$user)
	   ->where("tp.State!=",'Pending');

	  
	   echo $this->datatables->generate();
	}

	public function filterHistoryRecord()
	{
		
		$title=$this->input->post('title');
		$student=$this->input->post('student');
		$state=$this->input->post('state');
		$user=$this->session->userdata('userid');


		$this->load->library('Datatables');
	 	
	 	$this->datatables->select('tp.ID,st.Name as studentName,c.Name as courseName,d.Name as departmentName,tp.State,tp.DateAdded,tt.Name as topicName')
	   ->from('taken_projects tp')  
	   ->join("departments d",'tp.DepartmentID=d.ID','left')
	   ->join("courses c",'tp.CourseID=c.ID','left')
	   ->join("student_table st",'tp.StudentID=st.ID')
	   ->join("topics_table tt",'tp.TopicID=tt.ID')
	   ->where("tp.SupervisorID",$user)
	   ->where("tp.State!=",'Pending')
	   ->where("tt.Name like","%".$title."%")
	   ->where("st.Name like","%".$student."%")
	   ->where("tp.State like","%".$state."%");

	 
	   echo $this->datatables->generate();


	}

	public function showSuggestedTopics()
	{

		$this->load->view('supervisorViews/suggestedTopic');	
	}

	public function SuggestedTopicsRecord()
	{

		$user=$this->session->userdata('userid');
	
		$this->load->library('Datatables');
	 	$this->datatables->select('t.ID,t.Name,t.Description,t.Objective,t.Goals,t.Complexity,t.DateTime,c.Name as CourseName,d.Name as DepartName, s.Name as StdName')
	   ->from('suggested_topics t')  
	   ->join("departments d",'t.DepartmentID=d.ID','left')
	   ->join("courses c",'t.CourseID=c.ID','left')
	   ->join("student_table s",'t.CreatedBy=s.ID')
	   ->where("t.SupervisorID",$user);

	  
	   echo $this->datatables->generate();
				
	}

	public function showAppointments()
	{

		$this->load->view('supervisorViews/appointPage');	
	}


	public function appointmentRecord()
	{

		$user=$this->session->userdata('userid');
	
		$this->load->library('Datatables');
	 	$this->datatables->select('a.ID,s.Name as studentName,a.Date,a.Time,a.Msg')
	   ->from('appoint_requests a')  
	   ->join("student_table s",'a.StudentID=s.ID','left')
	   ->where("a.SupervisorID",$user)
	   ->where("a.State","Pending");

	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">More</i></a>','ID');

	   echo $this->datatables->generate();
				
	}


	public function AcceptAppointment()
	{
		$user=$this->session->userdata('userid');
		
		$this->load->model('SupervisorModel');
		
		$id=$this->input->post('id');
		$pass=$this->input->post('password');

		$student=$this->SupervisorModel->returnStudentIDAppoint($id);
		$appointDate=$this->SupervisorModel->returnAppointDate($id);

		$res['request']=$this->SupervisorModel->AcceptAppointment($id);	
		if($res['request']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
 			$this->load->model('GeneralModel');
			$supEmail=$this->GeneralModel->supEmail($user);
			$stdEmail=$this->GeneralModel->stdEmail($student);
			
			$message="Your appoint for " .$appointDate. " has been accepted.";

			$this->sendEmail($supEmail,$stdEmail,$pass,$message);

			

			$someJSON = json_encode($res);
 			echo $someJSON;	
 		}

	}

	public function RejectAppointment()
	{
		$user=$this->session->userdata('userid');
		
		$this->load->model('SupervisorModel');
		
		$id=$this->input->post('id');
		$pass=$this->input->post('password');

		$student=$this->SupervisorModel->returnStudentIDAppoint($id);
		$appointDate=$this->SupervisorModel->returnAppointDate($id);

		$res['request']=$this->SupervisorModel->RejectAppointment($id);	
		if($res['request']=="sorry")
		{
			$someJSON = json_encode("no");
 			echo $someJSON;		
 		}
 		else
 		{
 			$this->load->model('GeneralModel');
			$supEmail=$this->GeneralModel->supEmail($user);
			$stdEmail=$this->GeneralModel->stdEmail($student);
			
			$message="Your appoint for " .$appointDate. " has been rejected.";

			$this->sendEmail($supEmail,$stdEmail,$pass,$message);

			

			$someJSON = json_encode($res);
 			echo $someJSON;	
 		}

	}
}

		