
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


         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": true,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Users/StudentRecord",
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
                "data": "FatherName" 
            },
            { 
                "targets": 4,
                "className":'myClass',
                "data": "Email" },
            { 
                "targets": 5,
                "className":'myClass',
                "data": "Phone" },
            { 
                "targets": 6,
                "className":'myClass',
                "data": "Address" },
            {  
                "targets": 7,
                "className":'myClass',
                "data": "DepartName",
           
           },
           
            { 
                "targets": 8,
                "className":'myClass',
                "data": "edit",
                 render: function ( data, type, row ) {
                    
                    return '<input type="button" value="Edit" id='+ row["userid"] +' name='+ row["userid"] +' onclick="callModal(id)" data-toggle="modal" data-target="#myModal"/>';
                }
              
           },
           
        ],
     
        
        
    } );

   
} );

function removeStudent()
{
   var id=document.getElementById('stdId').value;
    // alert(id);


    $.ajax({

                type:'POST',
                url:'<?php echo base_url("Users/RemoveStudent"); ?>',
                data:{'id':id},
                dataType: 'json',
                 success: function (data) {
                  alert(data);
                  var c=data;
                if(c!="sorry")
                  {
                    
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


function updateStudent()
{
    

     var id=document.getElementById('stdId').value;
     var name=document.getElementById('stdName').value;
     var email=document.getElementById('stdEmail').value;
     var mobile=document.getElementById('stdMobile').value;
     var password=document.getElementById('stdPass').value;
     
    

    $.ajax({

                type:'POST',
                url:'<?php echo base_url("Users/UpdateStudent"); ?>',
                data:{'id':id,'name':name,'email':email,'mobile':mobile,'password':password},
                dataType: 'json',
                 success: function (data) {
                  alert(data);
                  var c=data;
                if(c!="sorry")
                  {
                    
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
function callModal(id)
{
    document.getElementById('stdId').value=id;
    
     $.ajax({

                type:'POST',
                url:'<?php echo base_url("Users/StudentDetail"); ?>',
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


</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  
  <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showUserPage">Students<span style="margin-left:5px;" class="glyphicon glyphicon-user"></span></a></li>
          
  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showSupervisorPage">Supervisors<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showHistory">History<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li ><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>


  <li style="float: right;"><h4>Admin Panel</h4></li>

  

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
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Department</th>
                <th>Option</th>

                </tr>
                </thead>

                <tbody>

                </tbody>
                </table>
        </div>
        </div>      
          <div class="row">
          <div class="col-md-10">    
            <?php  echo form_open("welcome/newUserPage");
              echo"<div class='row'>";
              echo"<div class='col-md-1' style='float:right; '>";
              echo"<button type='submit'  class='btn' >Add Student</button>";

              echo"</div>";
              echo"</div>";
              echo form_close();
              echo "</div>";  

          ?>
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