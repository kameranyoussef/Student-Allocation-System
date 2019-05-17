
<html>
<head>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


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


         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": true,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Supervisor/RequestsRecord",
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
                "data": "studentName"},
            { 
                "targets": 2,
                "className":'myClass',
                "data": "courseName" 
            },
            { 
                "targets": 3,
                "className":'myClass',
                "data": "topicName" },
            { 
                "targets": 4,
                "className":'myClass',
                "data": "departmentName" },
            { 
                "targets": 5,
                "className":'myClass',
                "data": "State", render: function ( data, type, row ) {
                     //alert("consultant time"+row['ConsultancyTime']+"wait time"+row['WaitTime']);

                    if (row['State']== "Pending") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #EC871B ;color:white;">'+data+'</p>';
                    } 
                  }

                 },
            {  
                "targets": 6,
                "className":'myClass',
                "data": "DateAdded",
                "render": function (data) {
                    var date = new Date(data);
                    var month = date.getMonth() + 1;
                    return (month.length > 1 ? month : month) + "/" + date.getDate() + "/" + date.getFullYear();}
           
           },

            { 
                "targets": 7,
                "className":'myClass',
                "data": "edit",
                 render: function ( data, type, row ) {
                    
                    return '<input type="button" value="More" id='+ row["ID"] +' name='+ row["ID"] +' onclick="callModal(id)" data-toggle="modal" data-target="#myModal"/>';
                }
              
           },
            
           
        ],
     
        
        
    } );

   
} );

function callModal(id)
{
    document.getElementById('stdId').value=id;


    
     $.ajax({

                type:'POST',
                url:'<?php echo base_url("Supervisor/StudentDetail"); ?>',
                data:{'id':id},
                dataType: 'json',
                success:function(data){
                    var c=data;
                    if(c=="no")
                    {
                       alert("Student record not found!");
                    }
                    
                    else{ 

                      var jsonObj=data["student"];
                      //iterate over the data and append a select option
                      $.each(jsonObj, function(key, val){
                          console.log(val.name);

                        document.getElementById('stdName').value=val.Name;
                        document.getElementById('stdMobile').value=val.Phone;
                        document.getElementById('stdEmail').value=val.Email;

                   })  
                    }
               }
      });
  
               
}

function AcceptRequest()
{
   var id=document.getElementById('stdId').value;
   var pass=document.getElementById('EmailPass').value;
    // alert(id);


    if(pass=="")
    {
      alert("Please enter the required password!");
    }

    else
    {

    document.getElementById('loadID').style.display='block';   
    $.ajax({

                type:'POST',
                url:'<?php echo base_url("Supervisor/AcceptProject"); ?>',
                data:{'id':id,'pass':pass},
                dataType: 'json',
                 success: function (data) {

                  var c=data;
                if(c!="sorry")
                  {
                    alert('Project Accepted');
                    
                    setTimeout (function () {
                    window.location.reload();
                
                    },4);              
    
                  }
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }

      });
  }

}


function RejectRequest()
{
   var id=document.getElementById('stdId').value;
   var pass=document.getElementById('EmailPass').value;
    // alert(id);

    if(pass=="")
    {
      alert("Please enter the required password!");
    }
    else
    {
    document.getElementById('loadID').style.display='block';   
    $.ajax({

                type:'POST',
                url:'<?php echo base_url("Supervisor/CancelProject"); ?>',
                data:{'id':id,'pass':pass},
                dataType: 'json',
                 success: function (data) {
                  document.getElementById('loadID').style.display='solid';
                  var c=data;
                if(c!="sorry")
                  {
                    alert('Project Rejected');
                    
                    setTimeout (function () {
                    window.location.reload();
                
                    },4);              
    
                  }
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }

      });

  }

}
</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  
  <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showRequestPage">Requests<span style="margin-left:5px;" class="glyphicon glyphicon-user"></span></a></li>
          
  <li  ><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showTopicPage">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showHistory">History<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showSuggestedTopics">Suggested Topics<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>
 
<li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>


  <li style="float: right;"><h4>Supervisor Panel</h4></li>

  

  </ul>  
</div>
       

        <div class="main">
         
          
         <br> 

                <div class='container'>
				<h4>Project Requests</h4>
                <div class='row'>
                <div class='col-md-12'> 
                <table class='table table-striped table-responsive mb-0' id='projTable'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Topic</th>
                <th>Department</th>
                <th>Status</th>
                <th>Req Date</th>
                <th>Options</th>
                

                </tr>
                </thead>

                <tbody>

                </tbody>
                </table>
        </div>
        </div>      

      </div>
    </div>

    <div class='row'>
          <div class='col-md-4'>
            <div id='loadID' style='margin-left: 600px;display: none;'class="loader"></div>
          </div>
    </div>
     <!-- Modal -->
                      <div class="modal fade" id="myModal" role="dialog"> 

                        <div class="modal-dialog">
                          
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Student Details</h4>
                            </div>
                            <div class="modal-body">
                                
                                <input style='display:none;' class='form-control' type='text' id='stdId' name='stdId'/>

                                <fieldset style="margin-top: 4px;">
                                   <label>Name</label><input readonly type="text" class="form-control" id='stdName' name='stdName'>

                                </fieldset>
                  
                                <fieldset style="margin-top: 4px;">
                                   <label>Mobile</label><input readonly type="tel" class="form-control" id='stdMobile' name='stdMobile'>

                                </fieldset>
                    

                                  <fieldset style="margin-top: 4px;">
                                   <label>Email</label><input readonly type='Email' class='form-control' id='stdEmail' name='stdEmail'>
                                </fieldset>

                                <fieldset style="margin-top: 4px;">
                                   <label>Your Email Password</label><input type='password' class='form-control' id='EmailPass' name='EmailPass'>
                                </fieldset>
                     
                            
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default"  onclick='AcceptRequest()' data-dismiss="modal" value='Accept'>

                               <input type="button" id='secondaryButton' class="btn btn-default"  onclick='RejectRequest()' data-dismiss="modal" value='Reject'>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                   

</body>

</html>