<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  
      <link rel="stylesheet"  href = "<?php echo base_url(); ?>css/style.css">

<?php $this->session->set_userdata('referred_from', current_url()); ?>

  
</head>

<body>

  <div class="login-page">
    <h4 style="color: white;text-overflow: inherit; font-size: 24px;">Student Allocation</h4>
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="POST" action="<?php echo base_url(); ?>welcome/process">
      <input type="text" id='username' name='username' placeholder="username"/>
      <input type="password" id='password' name='password' placeholder="password"/>

      <select class="form-control" id='userType' name='userType'>
        <option>Admin</option>
        <option>Student</option>
        <option>Supervisor</option>

      </select>  
      <H4 style='color:red;'><?php echo $message; ?></H4>
      <button>login</button>
     </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
