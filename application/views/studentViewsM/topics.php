
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
<style >
  
.green {
background-color:#16A085;
color:white;
}
</style>

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

         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "searching":false, 
         "ajax": {
            "url": "<?= base_url(); ?>index.php/student/TopicsRecord",
            "type": "POST"
        
    
        },
    
        "columns": [
     
            { 
                "targets": 0,
                "className":'myClass',
                "data": "Name"},
            { 
                "targets": 1,
                "className":'myClass',
                "data": "Description" 
            },
            { 
                "targets": 2,
                "className":'myClass',
                "data": "Objective" },
            { 
                "targets": 3,
                "className":'myClass',
                "data": "Goals" },
            { 
                "targets": 4,
                "className":'myClass',
                "data": "Complexity" },
            {  
                "targets": 5,
                "className":'myClass',
                "data": "CourseName",
           
           },
            {  
                "targets": 6,
                "className":'myClass',
                "data": "SupName",
           
           },

           { 
                "targets": 7,
                "className":'myClass',
                "data": "edit",
                 render: function ( data, type, row ) {
                    
                    
                    return '<input type="button" value="Apply" id='+ row["ID"] +' name='+ row["ID"] +' onclick="callModal(id)" data-toggle="modal" data-target="#myModal"/>';
                }
              
           },
           
           
        ],
     
        
        
    } );

   
} );



function filter()
{

  
  var title=document.getElementById('topicTitle').value;
  var supervisor=document.getElementById('topicSupervisor').value;
  var course=document.getElementById('topicCourse').value;
  var complexity=document.getElementById('topicComplexity').value;

 

    if(title=="")
    {
        
        title="%";
    }
    if(supervisor=="")
    {
       supervisor="%";

    }
    if(course=="")
    {
      course="%";

    }

    if(complexity=="")
    {
      complexity="%";
   
    }


    $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "searching":false, 
        "destroy": true,
        "responsive": true,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/student/filterTopicRecord",
            "type": "POST",
            "data": {"title":title,"supervisor":supervisor,"course":course,"complexity":complexity},
        
    
        },
    
        "columns": [
        
            { 
                "targets": 0,
                "className":'myClass',
                "data": "Name"},
            { 
                "targets": 1,
                "className":'myClass',
                "data": "Description",
                 render: function ( data, type, row ) {
                    
                    return '<p class="green">'+data+'</p>';
                }  
            },
            { 
                "targets": 2,
                "className":'myClass',
                "data": "Objective" },
            { 
                "targets": 3,
                "className":'myClass',
                "data": "Goals" },
            { 
                "targets": 4,
                "className":'myClass',
                "data": "Complexity" },
            {  
                "targets": 5,
                "className":'myClass',
                "data": "CourseName",
           
           },
            {  
                "targets": 6,
                "className":'myClass',
                "data": "SupName",
           
           },
           { 
                "targets": 7,
                "className":'myClass',
                "data": "edit",
                 render: function ( data, type, row ) {
                    
                    return '<input type="button" value="Apply" id='+ row["ID"] +' name='+ row["ID"] +' onclick="callModal(id)" data-toggle="modal" data-target="#myModal"/>';
                }
              
           },
           
           
        ],
     
        
        
    } );

   
}

function callModal(id)
{
    document.getElementById('topicID').value=id;
    
     $.ajax({

                type:'POST',
                url:'<?php echo base_url("student/getTopicsDetail"); ?>',
                data:{'topic':id},
                dataType: 'json',
                success:function(data){
                    var c=data;
                    if(c=="no")
                    {
                       alert("Student record not found!");
                    }
                    
                    else{ 

                      var jsonObj=data["topicsDetails"];
                      //iterate over the data and append a select option
                      $.each(jsonObj, function(key, val){
                          console.log(val.name);

                        document.getElementById('supName').value=val.Name;
                        document.getElementById('supID').value=val.SupervisorID;
                        document.getElementById('TopicDetails').value=val.Description;
                        document.getElementById('courseID').value=val.CourseID;

                   })  
                    }
               }
      });
  
               
}


function applyProject()
{
    var id=document.getElementById('topicID').value;
    var supervisor=document.getElementById('supID').value;
    var msg=document.getElementById('msgText').value;
    var course=document.getElementById('courseID').value;

    
     $.ajax({

                type:'POST',
                url:'<?php echo base_url("student/saveStudentProject"); ?>',
                data:{'topic':id,'supervisor':supervisor,'message':msg,'course':course},
                dataType: 'json',
                success:function(data){
                    var c=data;
                    if(c=="no")
                    {
                       alert("Error in applying");
                    }
                    
                    else{ 

                     alert("Project Applied");
                    }
               }
      });
  
               
}

</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
     
 <li  class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showMobileTopics">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showMobileAppliedProjects">Applied Projects<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showMobileAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li style="float: right;"><h4>Student Panel</h4></li>

  

  </ul>
  <br>
  
</div>

        <div>
          <div class="row">
            <div class='col-md-10'>
                <div >
                <h4 style="margin-left: 5px;">Search By</h4>
                <div class="col-md-3">
                <input class="form-control" type="text" name="topicTitle" id="topicTitle" placeholder="Search by title" onkeyup="filter();">
                </div>

                <div class="col-md-3">
                <input class="form-control" type="text" name="topicSupervisor" id="topicSupervisor" placeholder="Search by Supervisor"
                 onkeyup='filter();'>
                </div>

                <div class="col-md-3">
                <input class="form-control" type="text" name="topicCourse" id="topicCourse" placeholder="Search by course" onkeyup='filter();'>
                </div>

                <div class="col-md-3">
                <input class="form-control" type="text" name="topicComplexity" id="topicComplexity" placeholder="Search by complexity" 
                 onkeyup='filter();'>
                </div>
                </div>
            </div>  
          </div>
          <h4 style='margin-left:5px;'>Topics</h4>

      <div >
        <div >
         <div > 
                <table id='projTable'>
                <thead>
                <tr>

                <th>Name</th>
                <th>Description</th>
                <th>Objective</th>
                <th>Goals</th>
                <th>Complexity</th>
                <th>Course</th>
                <th>Supervisor</th>
                <th>Edit</th>

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
                              <h4 class="modal-title">Apply for project</h4>
                            </div>
                            <div class="modal-body">
                                
                                <input style='display:none;' class='form-control' type='text' id='topicID' name='topicID'/>

                                <input style='display:none;' class='form-control' type='text' id='courseID' name='courseID'/>

                                <input style='display:none;' class='form-control' type='text' id='supID' name='supID'/>

                                <fieldset>
                                   <label>Supervisor</label><input type="text" class="form-control" id='supName' name='supName'>

                                </fieldset>
                  
                                <fieldset>
                                   <label>Description</label><textarea  type="tel" class="form-control" id='TopicDetails' name='TopicDetails'></textarea>

                                </fieldset>
                    
                                <fieldset>
                                   <label>Message</label><textarea type='text' class='form-control' id='msgText' name='msgText'></textarea>
                                </fieldset>
                            
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default"  onclick='applyProject()' data-dismiss="modal" value='Apply'>

                               <input type="button" id='secondaryButton' class="btn btn-default"  data-dismiss="modal" value='Cancel'>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                      
</body>

</html>