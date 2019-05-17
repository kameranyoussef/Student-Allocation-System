
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

</script>

</head>

   
<body>
  <?php $this->view('header'); ?>  

  <div class="container" style="margin-top: 20px;">
  <ul class="nav nav-tabs">
  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showUserPage">Students<span style="margin-left:5px;" class="glyphicon glyphicon-user"></span></a></li>
          
  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showSupervisorPage">Supervisors<span style="margin-left:5px;" class="glyphicon glyphicon-list-alt"></span></a></li>

  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showHistory">History<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>
  <li><a style='margin-left: 2px' href="<?php echo base_url() ?>welcome/showDashboard">Dashboard<span style="margin-left:5px;" class="glyphicon glyphicon-modal-window"></span></a></li>

  <li style="float: right;"><h4>Admin Panel</h4></li>

  
  

  </ul>
  <br>
  
</div>


   
 
   <div class='row'>
   <div class='col-md-12'>

     <form action="<?php echo base_url(); ?>Users/saveNewSupervisor" method="Post" >

      <div style='border:solid;background-color: #fbfcfc;border-color:lightgrey;border-width:0.5;'>

         <h2 style="padding: 10px">Supervisor Details</h5>

          <div class="row" style="margin-top: -20px;">
          <div class="col-md-12">
                      
                        <div class='row' style="padding: 20px;">
                          
                            <div class='col-md-3'>
                              <label for="departments">Department:</label>

                              <?php 
                               echo "<select class='form-control' id='stdDepart' name='stdDepart' style='width: 250px;height:30px;'>";
                                foreach($departments as $ser)
                               {
                              
                                echo"<option value='".$ser['ID']."'>".$ser['Name']."</option>";
                               }
                               echo "</select>";
                              ?>
                            </div>
                          
                           <div class="col-md-3" style="margin-left: 10px;">
                              <label for="name">Name</label>
                              <div class="form-group" >
                                   
                                     <input required type="text" style="width: 250px;height:30px;" class="form-control" id="stdName" placeholder="Enter name" name="stdName">
                              </div>  
                           </div>
                    
                           <div class="col-md-3" style="margin-left:10px;">

                               <label for="name">Project Limit</label>
                              <div class="form-group" >
                                   
                                     <input required type="number" style="width: 250px;height:30px;" class="form-control" id="plimit" placeholder="Project Limit" name="plimit">
                              </div>  

                            </div>
                     
                        </div>

                        <div class='row' style="padding: 20px;margin-top: -15px;">

                            <div class='col-md-3'>
                              <div class="form-group">

                                     <label for="phone">Phone</label>
                                      <input required type="tel" style="width: 250px;height:30px;" class="form-control" id="stdPhone" placeholder="Enter phone" name="stdPhone">
                              </div>  
                            </div>

                             <div class='col-md-3'>

                              <div class="form-group" style="margin-left: 10px;">

                                      <label for="skype">Password</label>
                                      <input required type="password"  style="width: 250px;height:30px;" class="form-control" id="password" placeholder="Enter password" name="password">

                              </div>  
                            </div> 

                             <div class='col-md-3'>
                              <div class="form-group" style="margin-left: 15px;">
                                      <label for="email">Email</label>
                                      <input required type="email" style="width: 250px;height:30px;" class="form-control" id="email" placeholder="Enter email" name="email">
                             
                              </div>  
                              </div>         
                        </div>  

                        <div class="row" style="padding: 20px;margin-top: -20px;">
                          <div class="col-md-3">  
                            <label>Permenant Address</label>
                          <textarea required style="width: 250px;height: 100px;" id='stdAddress' name='stdAddress' placeholder="Permenant Address">
                          </textarea>
                          </div>

                           <div class="col-md-3" style="margin-top: 80px;">    
                            
                                <button type='submit'  class='btn' >SAVE</button>;
                          
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