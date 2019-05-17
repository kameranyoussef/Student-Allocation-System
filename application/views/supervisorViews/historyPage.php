
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
        "ordering": false,
        "searching":false,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Supervisor/HistoryRecord",
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

                    if (row['State']== "Accepted") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #27ae60 ;color:white;">'+data+'</p>';
                    } 
                    else if(row['State']=="Rejected")
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #c0392b ;color:white;">'+data+'</p>';

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
           
        ],
     
        
        
    } );

   
} );



function filter()
{

  
  var title=document.getElementById('topicTitle').value;
  var student=document.getElementById('stdID').value;
  var state=document.getElementById('stateID').value;

 

    if(title=="")
    {
        
        title="%";
    }
  
    if(student=="")
    {
      student="%";

    }

    if(state=="")
    {
      state="%";
   
    }


    $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "searching":false, 
        "destroy": true,
        "responsive": true,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/Supervisor/filterHistoryRecord",
            "type": "POST",
            "data": {"title":title,"student":student,"state":state},
        
    
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

                    if (row['State']== "Accepted") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #d4ac0d ;color:white;">'+data+'</p>';
                    } 
                    else if(row['State']=="Rejected")
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #c0392b ;color:white;">'+data+'</p>';

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
           
        ],    
        
    } );

   
}

</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  
  <li ><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showRequestPage">Requests<span style="margin-left:5px;" class="glyphicon glyphicon-user"></span></a></li>
          
  <li  ><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showTopicPage">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showHistory">History<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showSuggestedTopics">Suggested Topics<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>Supervisor/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li style="float: right;"><h4>Supervisor Panel</h4></li>

  

  </ul>  
</div>

        <div class="main" >


        <div class='container'>
		 <div class="row">
            <div class='col-md-10'>
                <div class="row">
                <h4>Search By</h4>
                <div class="col-md-3">
                <input class="form-control" type="text" name="topicTitle" id="topicTitle" placeholder="Search by Topic" onkeyup="filter();">
                </div>

              

                <div class="col-md-3">
                <input class="form-control" type="text" name="stdID" id="stdID" placeholder="Search by Student" onkeyup='filter();'>
                </div>

                <div class="col-md-3">
                <input class="form-control" type="text" name="stateID" id="stateID" placeholder="Search by State" 
                 onkeyup='filter();'>
                </div>
                </div>
            </div>  
          </div>

          <h4>History</h4>
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
               

                </tr>
                </thead>

                <tbody>

                </tbody>
                </table>
        </div>
        </div>      
         
      </div>
    </div>
                   

</body>

</html>