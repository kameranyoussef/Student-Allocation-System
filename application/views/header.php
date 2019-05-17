<!DOCTYPE html>



<header class="header-user-dropdown">

	<div class="header-limiter">
		<h1><a style="color:#fff;font-size:22px;" href="#">Student<span>Allocation - </span></a><a style='font-size:16px;'><?php
	              echo $this->session->userdata('usertype');?>Page</a></h1>
	
    <div class="logout" style='float:right;'>
       
        <div style='display:inline;  margin-left:10px;'>
             <a style='font-size:15px;'>
			 <?php
			 echo $this->session->userdata('userid');?></a>
        </div>   
		
        <a class="myButton" href="<?php echo base_url();?>/Welcome/logoutUser">LOGOUT</a>			
	</div>	

	</div>

</header>


