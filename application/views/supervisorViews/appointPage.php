
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


function callModal(id)
{
    document.getElementById('stdId').value=id;
    //document.getElementById('SelSupervisor').id=id;
              
}
$(document).ready(function() {


         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "searching":false,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Supervisor/appointmentRecord",
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
                "data": "Msg"},
            { 
                "targets": 3,
                "className":'myClass',
                "data": "Date" 
            },
            { 
                "targets": 4,
                "className":'myClass',
                "data": "Time" },
            { 
                "targets": 5,
                "className":'myClass',
                "data": "edit",
                 render: function ( data, type, row ) {
                    
                    return '<input type="button" value="More" id='+ row["ID"] +' name='+ row["ID"] +' onclick="callModal(id)" data-toggle="modal" data-target="#myModal"/>';
                }  

                 },
             
           
        ],
     
        
        
    } );

   
} );



function updateAppointment()
{
    

     var id=document.getElementById('stdId').value;
     var pass=document.getElementById('pass').value;

   
    $.ajax({

                type:'POST',
                url:'<?php echo base_url("Supervisor/AcceptAppointment"); ?>',
                data:{'id':id,'password':pass},
                dataType: 'json',
                 success: function (data) {
                 
                  var c=data;
                if(c!="sorry")
                  {
                    alert("Appointment Accepted");   
                    setTimeout (function () {
                    window.location.reload();
                
                    },4);              
    
                  }
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }

      });
    
   // refreshTable();
         
       

 }

 function removeAppointment()
{
    

     var id=document.getElementById('stdId').value;
     var pass=document.getElementById('pass').value;
    
    // alert(id);

    
    $.ajax({

                type:'POST',
                url:'<?php echo base_url("Supervisor/RejectAppointment"); ?>',
                data:{'id':id,'password':pass},
                dataType: 'json',
                 success: function (data) {
                 
                  var c=data;
                if(c!="sorry")
                  {
                    alert("Appointment Rejected")
                    setTimeout (function () {
                    window.location.reload();
                
                    },4);              
    
                  }
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }

      });
    
   // refreshTable();
         
       

 }
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


 <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>



  <li style="float: right;"><h4>Supervisor Panel</h4></li>

  

  </ul>  
</div>

        <div class="main" >
         

                <div class='container'>
				<h4>Appointments</h4>
                <div class='row'>
                <div class='col-md-10'> 
                <table class='table table-striped table-responsive mb-0' id='projTable'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Message</th>
                <th>Date</th>
                <th>Time</th>
                <th>Option</th>
                
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
                              <h4 class="modal-title">Appointment</h4>
                              
                            </div>
                            <div class="modal-body">
                                
                                <input style='display:none;' class='form-control' type='text' id='stdId' name='stdId'/>

                                <fieldset>
                                   <label>Your Email Password</label><input type="password" class="form-control" id='pass' name='pass'>

                                </fieldset>
                            
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default"  onclick='updateAppointment()' data-dismiss="modal" value='Accept'>

                               <input type="button" id='secondaryButton' class="btn btn-default"  onclick='removeAppointment()' data-dismiss="modal" value='Reject'>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                   

</body>

</html>