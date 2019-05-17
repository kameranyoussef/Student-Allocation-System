<!DOCTYPE html>
<html lang="en" >

<head>

  <?php $this->session->set_userdata('referred_from', current_url()); ?>

  <meta charset="UTF-8">
  
      <link rel="stylesheet"  href = "<?php echo base_url(); ?>css/style.css">


  
</head>

<body>

  <div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="POST" action="<?php echo base_url(); ?>/process">
      <input type="text" id='username' name='username' placeholder="username"/>
      <input type="password" id='password' name='password' placeholder="password"/>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
