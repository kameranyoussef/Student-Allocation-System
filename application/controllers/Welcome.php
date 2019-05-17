<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$result["message"]="";
		$this->load->view('welcome_message',$result);
	


	}

	public function logoutUser()
	{
		$this->load->library('session');
		unset($_SESSION['username']); 
    	unset($_SESSION['role']); 

		  redirect(base_url()); 
		
	}



	public function process()

	{
		$this->load->library('session');
		$this->load->helper('html');
		$this->load->model('CheckUser');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$usertype=$this->input->post('userType');
		
		$encrypted=md5($password);

		$data=$this->CheckUser->returnUsers($username,$encrypted,$usertype);

		if($data!="sorry")
		{	
		    	
        		$arraydata = array(
                'userid'  => $data,
                'usertype'  => $usertype,
               );

    	    $this->session->set_userdata($arraydata); 
    	    if($usertype=="Admin")
    	    {
           
	    		redirect("Welcome/showUserPage");		    	
        	}

        	 if($usertype=="Supervisor")
    	    {
		 
				redirect("Supervisor/showTopicPage");	
				 	
        	}
        	if($usertype=="Student")	
        	{
        	   
            	redirect("student/showTopicPage");

        	}
		}
		else
		{
					$result["message"]="Invalid usernid or password";
					$this->load->view('welcome_message',$result);

		}

	}

	
	
	public function returnBack()
	{
	    $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
	}
	
	public function editUser($id=null,$page=null)
	{
	    $this->load->model('userModel');
	    $result['details']=$this->userModel->getUserDetails($id);
	    $result['page']=$page;
	    $this->load->view('editUser',$result);

	}
	
	


	public function showUserPage()
		{

		$this->load->view('adminViews/usersPage');

		}


	public function newUserPage()
		{

		$this->load->model('GeneralModel');
		$editResult['departments']=$this->GeneralModel->getDepartments();
	
		$this->load->view('adminViews/newUserPage',$editResult);

		}



	public function showSupervisorPage()
	{

		$this->load->view('adminViews/supervisorPage');

	}

	public function newSupervisorPage()
	{
	   	$this->load->model('GeneralModel');
		$editResult['departments']=$this->GeneralModel->getDepartments();		
	   	$this->load->view('adminViews/NewSupervisorPage',$editResult);

	}

	public function ShowSupervisorCoursesPage($product=null)
	{
		//print_r($product);
		$select["supervisor"]=$product;
		$this->load->view('adminViews/SupervisorCoursePage',$select);

	}

	public function newSupervisorCoursePage()
	{
	   	$this->load->model('SupervisorModel');
	   	$supID=$this->input->post('supID');
		$editResult['departments']=$this->SupervisorModel->getSupervisorDepartments($supID);
		foreach($editResult['departments'] as $ser) {
			$depID=$ser['ID'];
		}
	
		$editResult['supervisor']=$this->SupervisorModel->getSupervisor($supID);
		
		$editResult['Courses']=$this->SupervisorModel->getCourses($depID);


	   	$this->load->view('adminViews/NewSupervisorCoursePage',$editResult);

	}

	public function newServicePage()
	{
        $this->load->model('servicesModel');
        $result['intervals']=$this->servicesModel->getServiceTypes();
		$this->load->view('newServicePage',$result);

	}

	public function showHistory()
	{

		$this->load->view("adminViews/historyPage");
	}
	public function showDashboard()
	{

		$this->load->view("adminViews/admindashboard");
	}

	public function HistoryRecord()
	{
		$user=$this->session->userdata('userid');
				

		$this->load->library('Datatables');
	 	$this->datatables->select('tp.ID,spt.Name as supervisorName,st.Name as studentName,c.Name as courseName,d.Name as departmentName,tp.State,tp.DateAdded,tt.Name as topicName')
	   ->from('taken_projects tp')  
	   ->join("departments d",'tp.DepartmentID=d.ID','left')
	   ->join("courses c",'tp.CourseID=c.ID','left')
	   ->join("student_table st",'tp.StudentID=st.ID')
	   ->join("topics_table tt",'tp.TopicID=tt.ID')
	   ->join("supervisor_table spt",'tp.SupervisorID=spt.ID');

	  
	   echo $this->datatables->generate();
	}


	public function filterHistoryRecord()
	{
		
		$title=$this->input->post('title');
		$student=$this->input->post('student');
		$supervisor=$this->input->post('supervisor');
		$state=$this->input->post('state');
		$user=$this->session->userdata('userid');


		$this->load->library('Datatables');
	 	
	 	$this->datatables->select('tp.ID,spt.Name as supervisorName,st.Name as studentName,c.Name as courseName,d.Name as departmentName,tp.State,tp.DateAdded,tt.Name as topicName')
	   ->from('taken_projects tp')  
	   ->join("departments d",'tp.DepartmentID=d.ID','left')
	   ->join("courses c",'tp.CourseID=c.ID','left')
	   ->join("student_table st",'tp.StudentID=st.ID')
	   ->join("topics_table tt",'tp.TopicID=tt.ID')
	   ->join("supervisor_table spt",'tp.SupervisorID=spt.ID')
	   ->where("tt.Name like","%".$title."%")
	   ->where("st.Name like","%".$student."%")
	   ->where("tp.State like","%".$state."%")
	   ->where("spt.Name like","%".$supervisor."%");

	 
	   echo $this->datatables->generate();


	}


}

		