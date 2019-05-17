
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



$(window).on('load',function(){
        $('#myModal').modal('show');
    });


 function OkayClick()
 {
    window.location.href = "<?php echo base_url(); ?>welcome/showSupervisorPage";

 }

</script>

</head>

   
<body>


  <?php $this->view('header'); ?>  


       <!-- Modal -->
                      <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Error Message</h4>
                             
                            </div>
                            <div class="modal-body">
                                
                              <strong>Error while performing the opperation!! Course Already Added..</strong>
                    
                            
                            </div>
                            <div class="modal-footer">
                              <input type="button" class="btn btn-default"  onclick='OkayClick()' data-dismiss="modal" value='Okay'>

                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                      

</body>

</html>