
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


function getSupervisors(id){

  var editor;
  var c=document.getElementById(id).value;
  
 
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


</script>

</head>

   
<body>
  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  
  <ul class="nav nav-tabs">
   <li ><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showTopicPage">Topics<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showAppliedProjects">Applied Projects<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li class="active"><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showSuggestTopic">Suggest Topic<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>


  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showAppointments">Appointments<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>
 
 <li><a style='margin-left: 2px' href="<?php echo base_url() ?>student/showMobileTopics">Mobile View<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li style="float: right;"><h4>Student Panel</h4></li>

  
  

  </ul>
  <br>
  
</div>


   
 
  
   <div class='row'>
   <div class='col-md-12'>

     <form   action="<?php echo base_url(); ?>student/saveSuggestedTopic" method="Post" >

      <div style='border:solid;background-color: #fbfcfc;border-color:lightgrey;border-width:0.5;'>

         <h2 style="padding: 10px"> Suggest Topic</h5>

          <div class="row" style="margin-top: -20px;">
          <div class="col-md-12">
                      
                        <div class='row' style="padding: 20px;">
                           
                            <div class="col-md-3" style="margin-left: 10px;">
                              <label for="name">Name</label>
                              <div class="form-group" >
                                   
                                     <input type="text" style="width: 250px;height:30px;" class="form-control" id="topicName" placeholder="Enter name" name="topicName">
                              </div>
                            </div>  

                              <div class="col-md-3" style="margin-left: 10px;">
                              <label for="name">Description</label>
                              <div class="form-group" >
                                   
                                      <textarea style="width: 300px;height: 150px;" id='topicDesc' name='topicDesc'>
                                     </textarea>
                              </div>  
                           </div>

                           
                            <div class="col-md-3" style="margin-left: 10px;">
                              <label for="name">Goals</label>
                              <div class="form-group" >
                                   
                                      <textarea style="width: 300px;height: 150px;" id='topicGoal' name='topicGoal'>
                                     </textarea>
                              </div>  
                           </div> 
                           
                        </div>

                        <div class='row' style="padding: 20px;margin-top: -15px;">

                            <div class='col-md-2' style="margin-left: 15px;">
                              <div class="form-group">

                                     <label for="phone">Complexity</label>
                                      <input type="text" style="width: 200px;height:30px;" class="form-control" id="topicComplex" placeholder="e-g Hard,Easy.." name="topicComplex">
                              </div>  
                            </div>

                            <div class="col-md-2" style="margin-left: 25px;">
                              <label for="name">Objective</label>
                              <div class="form-group" >
                                   
                                     <input type="text" style="width: 200px;height:30px;" class="form-control" id="topicObj" placeholder="Enter Objective" name="topicObj">
                              </div>
                           </div>  


                             <div class='col-md-2' style="margin-left: 15px;">
                              <label for="departments">Courses:</label>

                              <?php 
                               echo "<select  class='form-control' id='courseID' name='courseID' onchange='getSupervisors(id)' style='width: 200px;height:30px;'>";
                                foreach($courses as $ser)
                               {
                              
                                echo"<option value='".$ser['ID']."'>".$ser['Name']."</option>";
                               }
                               echo "</select>";
                              ?>
                            </div>

                            <div class='col-md-3'>
                              <label for="departments">Supervisor:</label>

                               <select  class='form-control' id='stdSup' name='stdSup' style='width: 250px;height:30px;' onchange="getTopics(id)">;
                               </select>
                               
                            </div>

                       
                           <div class="col-md-2" style="margin-top: 100px;">    
                            
                                <button type='submit'  class='btn' >Submit</button>;
                          
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