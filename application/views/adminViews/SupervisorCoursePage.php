
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

<title>Home</title>

<link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/main_style.css">


<script type="text/javascript">

function checkDelete(id)
{
 // alert(id);

    $.ajax({
                type:'POST',
                url:'<?php echo base_url("welcome/deleteManager"); ?>',
                data:{'mng_id':id},
                success:function(res){
                    alert(res);
                }
            });

}

$(document).ready(function() {

      //var id= document.getElementById("supID").value;
         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Users/SupervisorCourseRecord/<?php echo $supervisor ?>"
            ,
            "type": "POST"
        },
        
        
        "columns": [
          { 
              "targets": 0,
              "className":'myClass',
              "data": "ID"
               
          },
            { 
                "targets": 1,
                "className":'myClass',
                "data": "CourseName"},
            { 
                "targets": 2,
                "className":'myClass',
                "data": "DepartName" 
            },
           
            { 
                "targets": 3,
                "className":'myClass',
                "data": "SupervisorName" },
           
        ],
     
        
        
    } );

   
} );


</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  
  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showUserPage">Students<span style="margin-left:5px;" class="glyphicon glyphicon-user"></span></a></li>
          
  <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showSupervisorPage">Supervisors<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showHistory">History<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>


  <li style="float: right;"><h4>Admin Panel</h4></li>

  

  </ul>
  <br>
  
</div>

        <div class="main" >
        
         <br> 
   

          

                <div class='container'>
				<h4>Supervisor Courses..</h4>
                <div class='row'>
                <div class='col-md-12'> 
                <table class='table table-striped table-responsive mb-0' id='projTable'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Cousre Name</th>
                <th>Deparment Name</th>
                <th>Supervisor Name</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
                </table>
        </div>
        </div>      
          <div class="row">
          <div class="col-md-10">    
            <?php  echo form_open("welcome/newSupervisorCoursePage");
              echo"<div class='row'>";
              echo"<div class='col-md-1' style='float:right; '>";
              echo"<input type='text' value='".$supervisor."' id='supID' name='supID' style='display:none;'>";
              echo"<button type='submit'  class='btn' >Add Courses</button>";

              echo"</div>";
              echo"</div>";
              echo form_close();
              echo "</div>";  

          ?>
          </div>
          </div>

      </div>
    </div>

</body>

</html>