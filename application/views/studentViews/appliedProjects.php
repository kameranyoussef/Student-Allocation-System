
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


$(document).ready(function() {

         $('#projTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,        
        "searching":false,
        "paging": false,
         "ajax": {
            "url": "<?= base_url(); ?>index.php/student/getCurrentProject",
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
                "data": "topicName"},
            { 
                "targets": 2,
                "className":'myClass',
                "data": "supervisorName" 
            },
            { 
                "targets": 3,
                "className":'myClass',
                "data": "courseName" },
            { 
                "targets": 4,
                "className":'myClass',
                "data": "State",
                render: function ( data, type, row ) {
                     //alert("consultant time"+row['ConsultancyTime']+"wait time"+row['WaitTime']);

                    if (row['State']== "Pending") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color: #EC871B ;color:white;">'+data+'</p>';
                    } 
                    else if (row['State']== "Accepted") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color:#1EBB1E ;color:white;">'+data+'</p>';
                    } 

                    else if (row['State']== "Rejected") 
                    {
                        return '<p  style="height:30px; text-align:center;padding-top:7px; background-color:#c0392b  ;color:white;">'+data+'</p>';
                    } 
                 }
                },
            { 
                "targets": 5,
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


</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  
 
          
  <li  ><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showTopicPage">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showAppliedProjects">Applied Projects<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showSuggestTopic">Suggest Topic<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>
 
 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showMobileTopics">Mobile View<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li style="float: right;"><h4>Student Panel</h4></li>

  

  </ul>
  <br>
  
</div>

        <div class="main" >

         

                <div class='container'>
				 <h4>Applied Project</h4>
                <div class='row'>
                <div class='col-md-10'> 
                <table class='table table-striped table-responsive mb-0' id='projTable'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Topic</th>
                <th>Supervisor</th>
                <th>Course</th>
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