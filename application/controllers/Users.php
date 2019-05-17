<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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


	public function saveNewStudent()

	{
		$this->load->library('session');
		date_default_timezone_set('America/New_York'); # add your city to set local time zone
		$now = date('Y-m-d H:i:s');
		$password=$this->input->post('password');
        $encrypted=md5($password);

		$user=$this->session->userdata('userid');

		$data = array(	
		'ID'=>null,	
		'Email'=>$this->input->post('email'),
		'Name'=>$this->input->post('stdName'),
		'DepartmentID'=>$this->input->post('stdDepart'),
		'Phone'=>$this->input->post('stdPhone'),
		'Address'=>$this->input->post('stdAddress'),
		'FatherName'=>$this->input->post('fname'),
		'CreatedBy'=>$user,
		'DateAdded'=>$now,
	);

		
		$this->load->model('userModel');
		$insertId=$this->userModel->saveNewStudent($data);

		if($insertId!=null)
		{
				$data2 = array(	
			'ID'=>null,	
			'UserID'=>$insertId,
			'username'=>$this->input->post('uName'),
			'Password'=>$encrypted,
			'LoginTime'=>$now,
			'UserType'=>"Student",
			'DepartmentID'=>$this->input->post('stdDepart'),

		);

			$res=$this->userModel->saveLoginDetails($data2);

			//$this->load->view('usersPage');		
			redirect('Welcome/showUserPage');	
		}
			
	}


	public function StudentRecord()
	{

		$this->load->library('Datatables');
	 	$this->datatables->select('u.ID as userid,ld.username,u.Name,u.Email,u.FatherName,u.Phone,u.Address,d.Name as DepartName')
	   ->from('student_table u')  
	   ->join("departments d",'u.DepartmentID=d.ID')
	   ->join("logindetails ld",'ld.UserID=u.ID');

	   
	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">Edit</i></a>','ID');
	   echo $this->datatables->generate();
				
	}

	public function dashboardRecordStd()
	{
		$this->load->library('Datatables');
	 	$this->datatables->select('u.ID as userid,ld.username,u.Name,tp.State as enrolled,d.Name as DepartName')
	   ->from('student_table u')  
	   ->join("departments d",'u.DepartmentID=d.ID')
	   ->join("logindetails ld",'ld.UserID=u.ID')
	   ->join("taken_projects tp",'tp.StudentID=u.ID','left');


	
	   echo $this->datatables->generate();

	}


	public function dashboardRecordSup()
	{
		$this->load->library('Datatables');
	 	/*$this->datatables->select('st.ID as userid,ld.username,st.Name,Count(tp.ID) as ProjectCount,d.Name as DepartName')
	   ->from('taken_projects tp')  
	   ->join("('supervisor_table  st",'st.ID=tp.SupervisorID')
	   ->join("departments d",'d.ID=st.DepartmentID')
	   ->join("logindetails ld",'ld.UserID=st.ID');*/

	  /* $this->datatables->select('st.ID as userid,ld.username,st.Name,Count(tp.ID) as ProjectCount,d.Name as DepartName')
	   ->from('supervisor_table st')  
	   ->join("departments d",'st.DepartmentID=d.ID')
	   ->join("logindetails ld",'ld.UserID=st.ID')
	   ->join("taken_projects tp",'tp.SupervisorID=st.ID','left');*/


	   $this->datatables->select('st_t.Name as stdName,d.Name as DepartName,st.ID as userid,st.Name,ld.username,tp.State,tp_t.Name as topicName')
	   ->from('taken_projects tp')
	   ->join('student_table st_t','st_t.ID=tp.StudentID')
	   ->join ('supervisor_table st','st.ID=SupervisorID')
	   ->join("departments d",'d.ID=tp.DepartmentID')
	   ->join("logindetails ld",'ld.UserID=tp.SupervisorID')
	   ->join('topics_table tp_t','tp_t.ID=tp.TopicID');

	  /* $this->datatables->select('tp.Count as ')
	   ->from('taken_projects tp')
	   ->join ('supervisor_table st','st.ID=SupervisorID')
	   ->join("departments d",'st.DepartmentID=d.ID')
	   ->join("logindetails ld",'ld.UserID=st.ID');
*/

	
	   echo $this->datatables->generate();

	}



	public function StudentDetail()
	{

		$id=$this->input->post('id');

		$this->load->model('userModel');	

		$res['student']=$this->userModel->returnStudentDetail($id);	
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

	public function UpdateStudent()
	{

		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$email=$this->input->post('email');
        $mobile=$this->input->post('mobile');
		$password=$this->input->post('password');

    
		$this->load->model('userModel');	
		$result=$this->userModel->updateStudent($id,$name,$email,$mobile,$password);
		echo json_encode($result);

	}



	public function UpdateSupervisor()
	{

		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$email=$this->input->post('email');
        $mobile=$this->input->post('mobile');
		$password=$this->input->post('password');
		$limit=$this->input->post('limit');
		
    
		$this->load->model('userModel');	
		$result=$this->userModel->UpdateSupervisor($id,$name,$email,$mobile,$password,$limit);
		echo json_encode($result);

	}

	public function RemoveStudent(){
        
        $id=$this->input->post('id');
        $this->load->model('UserModel');
		$result=$this->UserModel->deleteStudent($id);
		echo json_encode($result);
           
    }





    public function saveNewSupervisor()

	{
		$this->load->library('session');
		date_default_timezone_set('America/New_York'); # add your city to set local time zone
		$now = date('Y-m-d H:i:s');
		$password=$this->input->post('password');
        $encrypted=md5($password);

		$user=$this->session->userdata('userid');

		$data = array(	
		'ID'=>null,	
		'Email'=>$this->input->post('email'),
		'Name'=>$this->input->post('stdName'),
		'DepartmentID'=>$this->input->post('stdDepart'),
		'Phone'=>$this->input->post('stdPhone'),
		'Address'=>$this->input->post('stdAddress'),
		'ProjLimit'=>$this->input->post('plimit'),
		'CreatedBy'=>$user,
		'DateAdded'=>$now,

	);

		
		$this->load->model('userModel');
		$insertId=$this->userModel->saveNewSupervisor($data);

		if($insertId!=null)
		{
				$data2 = array(	
			'ID'=>null,	
			'UserID'=>$insertId,
			'username'=>$this->input->post('stdName'),
			'Password'=>$encrypted,
			'LoginTime'=>$now,
			'UserType'=>"Supervisor",
			'DepartmentID'=>$this->input->post('stdDepart'),

		);

			$res=$this->userModel->saveLoginDetails($data2);

			//$this->load->view('usersPage');		
			redirect('Welcome/showSupervisorPage');	
		}
			
	}

	public function SupervisorRecord()
	{

		$this->load->library('Datatables');
	 	$this->datatables->select('u.ID,u.Name,u.Email,u.ProjLimit,ld.username,u.Phone,u.Address,d.Name as DepartName')
	   ->from('supervisor_table u')  
	   ->join("departments d",'.u.DepartmentID=d.ID')
	   ->join("logindetails ld",'ld.UserID=u.ID');


	   
	   $this->datatables->add_column('edit','<a><i class="fa fa-table fa-fw">Edit</i></a>','ID');
	   echo $this->datatables->generate();
				
	}

	public function SupervisorDetail()
	{

		$id=$this->input->post('id');

		$this->load->model('userModel');	

		$res['supervisor']=$this->userModel->returnSupervisorDetail($id);	
		if($res['supervisor']=="sorry")
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

	public function SupervisorCourseRecord($product=null)
	{
		//$product=$this->input->post('id');
		//echo $product;
		$this->load->library('Datatables');
	 	$this->datatables->select('sc.ID,sup.Name as SupervisorName,d.Name as DepartName,c.Name as CourseName')
	   ->from('supervisor_courses sc')  
	   ->join("departments d",'d.ID=sc.DepartmentID','left')
	   ->join("supervisor_table sup",'sup.ID=sc.SupervisorID','left')
	   ->join("courses c",'c.ID=sc.CourseID','left')
	   ->where("sc.SupervisorID",$product);

	   echo $this->datatables->generate();
				
	}

	public function saveSupervisorCourse()

	{
		$this->load->library('session');
		date_default_timezone_set('America/New_York'); # add your city to set local time zone
		$now = date('Y-m-d H:i:s');
		

		$user=$this->session->userdata('userid');
		$sup=$this->input->post('supID');
		$course=$this->input->post('cID');

		$data = array(	
		'ID'=>null,	
		'SupervisorID'=>$this->input->post('supID'),
		'DepartmentID'=>$this->input->post('stdDepart'),
		'CourseID'=>$this->input->post('cID'),
		'CreatedBy'=>$user,
		'DateAdded'=>$now,

	);

		
		$this->load->model('SupervisorModel');
		$checkcourse=$this->SupervisorModel->checkExistCourse($sup,$course);
		if($checkcourse=="no")
		{

			$insertId=$this->SupervisorModel->saveNewSupervisorCourse($data);
			redirect('Welcome/ShowSupervisorCoursesPage/'.$sup);		
		}
		else{
			$this->load->view("adminViews/ErrorPageCourses");
		}	
		
			
	}

	public function editUser($product=null)
	{
		$this->load->model('userModel');
		$this->load->model('servicesModel');

		$userDetail['user']=$this->userModel->getUserDetails($product);
		$userDetail['servicesAll']=$this->servicesModel->getServices();
		$userDetail['services']=$this->userModel->getUserServices($product);


		$this->load->view('editUserPage',$userDetail);

	}
	
	public function checkPassword()
	{
	    $id=$this->input->post('id');
		$password=$this->input->post('password');
		$this->load->model('userModel');
		
		$encrypted=md5($password);

        
        $userDetail=$this->userModel->checkUserPassword($id,$encrypted);
		
	    echo json_encode($userDetail);
	    
	}
	
	function updateUserSelf()
	{
	 
	 	$id=$this->input->post('user_id');
		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$mobile=$this->input->post('mobile');
		$skype=$this->input->post('skype');
		$password=$this->input->post('c_pass');
	
        $encrypted=md5($password);


		$this->load->model('UserModel');
		$editResult=$this->UserModel->updateUsersSelf($id,$name,$email,$phone,$mobile,$skype,$encrypted);
   
        echo json_encode($editResult);
	}

	public function updateUsers()
	{
		$id=$this->input->post('id');
		$name=$this->input->post('u_name');
		$email=$this->input->post('u_email');
		$designation=$this->input->post('u_designation');
		$phone=$this->input->post('phone');
		$mobile=$this->input->post('mobile');
		$whtsapp=$this->input->post('whtsapp');
		$role=$this->input->post('role');
        $password=$this->input->post('password');
        
        $encrypted=md5($password);
  

		$this->load->model('UserModel');
		$editResult=$this->UserModel->updateUsers($id,$name,$email,$designation,$phone,$mobile,$whtsapp,$role,$encrypted);

		$service=$this->input->post('services');
		//$freq=$this->input->post('freq');
		//$date=$this->input->post('date');

		$this->load->library('session');

		$user=$this->session->userdata('username');


		
					
		$delete=$this->UserModel->checkUserServices($id);

		if($service!=null)

		{
			    
					for($i=0,$count=count($service);$i<$count;$i++)
					{
						$ser=$service[$i];
					
					
						$checkservice=$this->UserModel->checkExistService($ser,$id);
						
						if($checkservice=="yes")
						{

						$result=$this->UserModel->updateUserServices($ser,$id);
		
						}
						else
						{

						$data2 = array(	
						'id'=>null,	
						'userId'=>$id,
						'Service_ID'=>$ser,
						'status'=>"active",
					
						);

						$result=$this->UserModel->saveUserServices($data2);
						$data2=null;
					

						}

					
				

					}	
					
			      
		}
		
	}

    public function deleteUser(){
        
        $id=$this->input->post('id');
        print_r($id);		
        $this->load->model('UserModel');
		$editResult=$this->UserModel->deleteUsers($id);
		redirect('Welcome/showUserPage');
        
        
    }
	

}

		