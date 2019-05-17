
<html>


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

function getSupervisor(id){

  var editor;
  var c=document.getElementById(id).value;
  document.getElementById("selectedCours").value=c;
   
   $('#goal').val("");
   $('#desc').val("");

  
   $('#stdTopic')
                      .find('option')
                      .remove()
                      .end();
   $.ajax({

                type:'POST',
                url:'<?php echo base_url("student/getSupervisors"); ?>',
                data:{'course':c},
                dataType: 'json',
                success:function(data){
                    var c=data;
                    if(c=="no")
                    {
                       $('#stdSup')
                      .find('option')
                      .remove()
                      .end();
  
                      $('#stdSup').append('<option>' +"No result found"+ '</option>');
                     
                    }
                    
                    else{   

                      $('#stdSup')
                        .find('option')
                        .remove()
                        .end();


                      
                            
                      console.log(data);    
                      var jsonObj=data["supervisors"];  // Dump all data of the Object in the console
                      
                      console.log(jsonObj[0]['Name']);
                    
                        console.log(jsonObj[0]['Name']);
                       $('#stdSup').append('<option>' +""+ '</option>');
                      //iterate over the data and append a select option
                      $.each(jsonObj, function(key, val){
                          console.log(val.name);
                     $('#stdSup').append('<option value=' + val.ID + '>'+ val.Name + '</option>');
                     })

                    }
               }
      });
  
}

function getTopics(id){

  var editor;
  var c=document.getElementById(id).value;
  var d=document.getElementById("selectedCours").value;

   $('#goal').val("");
   $('#desc').val("");

 
   $.ajax({

                type:'POST',
                url:'<?php echo base_url("student/getSupervisorsTopics"); ?>',
                data:{'course':d,'supervisor':c},
                dataType: 'json',
                success:function(data){
                    var c=data;
                    if(c=="no")
                    {
                       $('#stdTopic')
                      .find('option')
                      .remove()
                      .end();
  
                      $('#stdTopic').append('<option>' +"No result found"+ '</option>');
                     
                    }
                    
                    else{   

                      $('#stdTopic')
                        .find('option')
                        .remove()
                        .end();


                      
                            
                      console.log(data);    
                      var jsonObj=data["topics"];  // Dump all data of the Object in the console
                      
                      console.log(jsonObj[0]['Name']);
                       $('#stdTopic').append('<option>' +""+ '</option>');

                      //iterate over the data and append a select option
                      $.each(jsonObj, function(key, val){
                          console.log(val.name);
                     $('#stdTopic').append('<option value=' + val.ID + '>'+ val.Name + '</option>');
                     })

                    }
               }
      });
  
}

function topicDetail(id){

  var editor;
  var c=document.getElementById(id).value;
  
  $('#goal').val("");
  $('#desc').val("");

 
   $.ajax({

                type:'POST',
                url:'<?php echo base_url("student/getTopicsDetail"); ?>',
                data:{'topic':c},
                dataType: 'json',
                success:function(data){
                    var c=data;
                    if(c=="no")
                    {
                         $('#goal').val("");
                         $('#desc').val("");
                     
                    }
                    
                    else{   

                         $('#goal').val("");
                         $('#desc').val("");

                      
                            
                      console.log(data);    
                      var jsonObj=data["topicsDetails"];  // Dump all data of the Object in the console
                      
                      console.log("this is"+jsonObj[0]['Goals']);
                     

                      //iterate over the data and append a select option
                      $.each(jsonObj, function(key, valu){
                          console.log(valu.name);
                      $("#goal").css('background-color', '#16A085');
                      $("#goal").css('color', 'white');
                      $("#goal").css('border', 'solid');
                      $("#goal").css('border-color', 'grey');


                      $("#desc").css('background-color', '#16A085');
                      $("#desc").css('color', 'white');

                      $("#desc").css('border', 'solid');
                      $("#desc").css('border-color', 'grey');
                           
                      $('#goal').val(valu.Goals);
                      $('#desc').val(valu.Description);
                     
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
   <li ><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showTopicPage">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showAppliedProjects">Applied Projects<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showSuggestTopic">Suggest Topic<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showMobileTopics">Mobile View<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li style="float: right;"><h4>Student Panel</h4></li>

  
  

  </ul>
  <br>
  
</div>


   
  <!---<div class="main" style="margin-top:-20px;">-->
 
   <div class='row'>
   <div class='col-md-12'>

     <form  action="<?php echo base_url(); ?>student/saveAppointment" method="Post" >

      <div style='border:solid;background-color: #fbfcfc;border-color:lightgrey;border-width:0.5;'>

         <h2 style="padding: 10px">Book Appointment</h5>
          <input type='text' id='selectedCours' name='selectedCours' style="display: none;">

          <div class="row" style="margin-top: -20px;">
          <div class="col-md-12">
                      
                        <div class='row' style="padding: 20px;">
                            
                            
                            <div class='col-md-2'>
                              <label for="departments">Supervisors:</label>

                              <?php 
                               echo "<select class='form-control' id='supID' name='supID' style='width: 180px;height:30px;'>";
                                foreach($supervisors as $ser)
                               {
                              
                                echo"<option value='".$ser['ID']."'>".$ser['Name']."</option>";
                               }
                               echo "</select>";
                              ?>
                            </div>

                          <div class="col-md-2">
                            <label>Date</label>
                            <input type='date' class="form-control"  id='apDate' name='apDate' />
                          </div>



                          <div class="col-md-2">
                            <label>Date</label>
                            <input type='time' class="form-control"  id='apTime' name='apTime' />
                          </div> 

                           <div class="col-md-2">
                            <label>Message</label>
                            <input type='text' class="form-control"  id='apMsg' name='apMsg' />
                          </div>   
                          
                          <div class="col-md-2" style="margin-top: 20px;">    
                            
                                <button type='submit'  class='btn' >Submit</button>
                          </div>  
                        </div>

              

          </div>
          </div>

                         
      </div>          
     </form>  
                                       
   </div>
   </div>
  

</body>

</html>