
<html>
<style>

.myClass
{
    text-align:center;
    
}

</style>


<head>

<title>PM Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/demo.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/header-user-dropdown.css">
  <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>


<?php $this->session->set_userdata('referred_from', current_url()); ?>

<title>Dashboard</title>

<link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/main_style.css">


<script type="text/javascript">

$(document).ready(function() {


         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Users/dashboardRecordStd",
            "type": "POST"
        
    
        },
        
        
        "columns": [

         { 
              "targets": 0,
              "className":'myClass',
              "data": "userid"
               
          },
        
          { 
              "targets": 1,
              "className":'myClass',
              "data": "username"
               
          },
            { 
                "targets": 2,
                "className":'myClass',
                "data": "Name"},
            { 
                "targets": 3,
                "className":'myClass',
                "data": "enrolled",
                 render: function ( data, type, row ) {
                    if(row['enrolled']=="Pending")
                    {
                      return '<p style="height:30px; text-align:center;padding-top:7px; background-color: #EC871B ;color:white;">'+row['enrolled']+'</p>';  
                    }
                    else if(row['enrolled']=="Rejected")
                    {
                      return '<p style="height:30px; text-align:center;padding-top:7px; background-color: #c0392b ;color:white;">'+row['enrolled']+'</p>';  
                    }

                    else if(row['enrolled']=="Accepted")
                    {
                      return '<p style="height:30px; text-align:center;padding-top:7px; background-color: #1EBB1E ;color:white;">'+row['enrolled']+'</p>';  
                    }
                    else
                    {
                      $not="Not Enrolled";
                    return '<p style="height:30px; text-align:center;padding-top:7px; background-color: #F4D03F ;color:white;">'+$not+'</p>';  

                    }
                    
                } 
            },
            
          
            {  
                "targets": 4,
                "className":'myClass',
                "data": "DepartName",
           
           },
           
        ],     
    } );

   



         $('#projTable2').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Users/dashboardRecordSup",
            "type": "POST"
        
    
        },
        
        
        "columns": [

         { 
              "targets": 0,
              "className":'myClass',
              "data": "userid"
               
          },
        
          { 
              "targets": 1,
              "className":'myClass',
              "data": "username"
               
          },
            { 
                "targets": 2,
                "className":'myClass',
                "data": "Name"},
            { 
                "targets": 3,
                "className":'myClass',
                "data": "stdName",
                
            },
             { 
                "targets": 4,
                "className":'myClass',
                "data": "topicName",
                
            },
            {  
                "targets": 5,
                "className":'myClass',
                "data": "State", render: function ( data, type, row ) {
                     //alert("consultant time"+row['ConsultancyTime']+"wait time"+row['WaitTime']);

                    if (row['State']== "Accepted") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #1EBB1E ;color:white;">'+data+'</p>';
                    } 
                    else if(row['State']=="Rejected")
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #c0392b ;color:white;">'+data+'</p>';

                    }
                    else if(row['State']=="Pending")
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #EC871B ;color:white;">'+data+'</p>';
                    }


                  }

           
           },
            
          
            {  
                "targets": 6,
                "className":'myClass',
                "data": "DepartName",
           
           },
           
        ],     
    } );

   
} );



</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  
 <li ><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showRequestPage">Requests<span style="margin-left:5px;" class="glyphicon glyphicon-user"></span></a></li>
          
  <li  ><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showTopicPage">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li ><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showHistory">History<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showSuggestedTopics">Suggested Topics<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>


 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

<li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>


  <li style="float: right;"><h4>Supervisor Panel</h4></li>

  

  </ul>
  <br>
  
</div>

        <div class="main" >
         <br> 

                <div class='container'>
				<h4>Students Info..</h4>
                <div class='row'>
                <div class='col-md-12'> 
                <table class='table table-striped table-responsive mb-0' id='projTable'>
                <thead>
                <tr>
                <th>Userid</th>
                <th>Username</th>
                <th>Name</th>
                <th>Enrolled</th>
                <th>Department</th>

                </tr>
                </thead>

                <tbody>

                </tbody>
                </table>
        </div>
        </div>      

        <div class='row'>
          <h4>Supervisor Info..</h4>
                <div class='col-md-12'> 
                <table class='table table-striped table-responsive mb-0' id='projTable2'>
                <thead>
                <tr>
                <th>Userid</th>
                <th>Username</th>
                <th>Name</th>
                <th>Student Name</th>
                <th>Topic</th>
                <th>State</th>
                <th>Department</th>

                </tr>
                </thead>

                <tbody>

                </tbody>
                </table>
        </div>
        </div>      
       

      </div>
    </div>


       <!-- Modal -->
                      <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Student</h4>
                            </div>
                            <div class="modal-body">
                                
                                <input style='display:none;' class='form-control' type='text' id='stdId' name='stdId'/>

                                <fieldset>
                                   <label>Name</label><input type="text" class="form-control" id='stdName' name='stdName'>

                                </fieldset>
                  
                                <fieldset>
                                   <label>Mobile</label><input type="tel" class="form-control" id='stdMobile' name='stdMobile'>

                                </fieldset>
                    
                                <fieldset>
                                   <label>New Password</label><input type='text' class='form-control' id='stdPass' name='stdPass'>
                                </fieldset>

                                  <fieldset>
                                   <label>Email</label><input type='Email' class='form-control' id='stdEmail' name='stdEmail'>
                                </fieldset>
                     
                            
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default"  onclick='updateStudent()' data-dismiss="modal" value='Update'>

                               <input type="button" id='secondaryButton' class="btn btn-default"  onclick='removeStudent()' data-dismiss="modal" value='Delete'>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                      

</body>

</html>