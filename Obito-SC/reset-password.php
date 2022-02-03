<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
 
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.3/litera/bootstrap.min.css">
     <link rel="stylesheet" href=" https://fonts.googleapis.com/css?family=Karla:400,700&amp;display=swap">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.3/litera/bootstrap.min.css">
     <link rel="stylesheet" href=" https://fonts.googleapis.com/css?family=Karla:400,700&amp;display=swap">
   
    <style>
    
   @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
*
{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}


header
{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding: 40px 100px;
  z-index: 1000;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
header .logo
{
  color: #fff;
  text-transform: uppercase;
  cursor: pointer;
}
.toggle
{
  position: relative;
  width: 60px;
  height: 60px;
  background: url(https://i.ibb.co/HrfVRcx/menu.png);
  background-repeat: no-repeat;
  background-size: 30px;
  background-position: center;
  cursor: pointer;
}
.toggle.active
{
  background: url(https://i.ibb.co/rt3HybH/close.png);
  background-repeat: no-repeat;
  background-size: 25px;
  background-position: center;
  cursor: pointer;
}
.showcase
{
  position: absolute;
  right: 0;
  width: 100%;
  min-height: 100vh;
  padding: 100px;
 
  justify-content: space-between;
  align-items: center;
  background: #111;
  transition: 0.5s;
  z-index: 2;
}
.showcase.active
{
  right: 300px;
}

.showcase video
{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.1;
}
.overlay
{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #fff;
  mix-blend-mode: overlay;
}
.text
{
  position: relative;
  z-index: 10;
}

.text h2
{
  font-size: 5em;
  font-weight: 800;
  color: #fff;
  line-height: 1em;
  text-transform: uppercase;
}
.text h3
{
  font-size: 4em;
  font-weight: 700;
  color: #fff;
  line-height: 1em;
 

}
.text p
{
  font-size: 1.1em;
  color: #fff;
  margin: 20px 0;
  font-weight: 400;
  max-width: 700px;
}

.text a:hover
{
  letter-spacing: 6px;
}
.social
{
  position: absolute;
  z-index: 10;
  bottom: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.social li
{
  list-style: none;
}
.social li a
{
  display: inline-block;
  margin-right: 20px;
  filter: invert(1);
  transform: scale(0.5);
  transition: 0.5s;
}
.social li a:hover
{
  transform: scale(0.5) translateY(-15px);
}
.menu
{
  position: absolute;
  top: 0;
  right: 0;
  width: 300px;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.menu ul
{
  position: relative;
}
.menu ul li
{
  list-style: none;
}
.menu ul li a
{
  text-decoration: none;
  font-size: 24px;
  color: #111;
}
.menu ul li a:hover
{
  color: #03a9f4; 
}

@media (max-width: 991px)
{
  .showcase,
  .showcase header
  {
    padding: 40px;
  }
  .text h2
  {
    font-size: 3em;
  }
  .text h3
  {
    font-size: 2em;
  }
}
    body {
  background-color: #fff;
  font-family: 'Karla', sans-serif; }
    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
display: none;}
        
        .wrapper{ width: 360px; padding: 20px; }
        .login {
  min-height: calc(100vh - 65px - 70px);
}
.login .login-form fieldset:not(:first-child) {
  display: none;
}

footer {
  margin: 0;
  padding: 2rem 0 0;
  background-color: #f7f7f7;
}

.navbar {
  padding: 1rem;
}
.navbar .logo span {
  font-weight: 900;
  color: #333;
  text-decoration: none;
}
html, body {margin: 0; height: 100%; overflow: hidden}
.form-control{
    opacity:0.7;
}



    </style>
   
    <style>
    body {
  background-color: #fff;
  font-family: 'Karla', sans-serif; }
    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
display: none;}
        
        .wrapper{ width: 360px; padding: 20px; }
        .login {
  min-height: calc(100vh - 65px - 70px);
}
.login .login-form fieldset:not(:first-child) {
  display: none;
}

footer {
  margin: 0;
  padding: 2rem 0 0;
  background-color: #f7f7f7;
}

.navbar {
  padding: 1rem;
}
.navbar .logo span {
  font-weight: 900;
  color: #333;
  text-decoration: none;
}
    </style>
</head>
<body>

    
    




    
  
    
    <section class="showcase">
        <header> 
             <h2 class="logo "><img src="https://i.imgur.com/3HewRiE.png" width="200px"/></h2> <a href="welcome.php"><span class="mb-2 text-white"> Go Back</span></a>
           
        </header>
     <video class="videoo" src="https://m.mark41stark.workers.dev/0://videoplayback%20(2).mp4" muted loop autoplay></video> 

        <div class="overlay"></div>
        <div class="text">
            
             <header>
        <div class="">
           
        </div>
    </header>
    
    
    <main>
        <section class="login d-flex align-items-center ">
            <div class="container">
                <div class="row justify-content-around">
                  
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-10 d-flex align-items-center px-4 px-sm-3 px-lg-4">
                        <div class="form-toggle position-relative  w-100">
                            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                
                                <fieldset class="valid-check" id="log-in">
                                  
                                       <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
                                    <div class="wrapper">
        
        
        
         <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                
                <input type="password" placeholder="New Password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
               
                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
               
            </div>
        </form>
    </div>    
    </div>    
                                   
    
                                </fieldset>
    
                              
    
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       

    </main>

    

        
      <!--  <p class="text-center text-grey large mb-0"> ❤️ PranavSatav </p> -->
        
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	    /////////login form 
    $('.sign-up-toggle').click(function(){
        $('#sign-up').show().siblings().hide();
    });
    $('.login-toggle').click(function(){
        $('#log-in').show().siblings().hide();
    });
    $('.forget-toggle').click(function(){
        $('#forget-password').show().siblings().hide();
    });
	
	///////////// valid check
$(".submit-validation").click(function() {
  //Fetch form to apply custom Bootstrap validation
  var form = $(".valid-check")
  console.log(form.prop('id')); //test to ensure calling form correctly
  // console.log($('#fileInput')[0].files[0]);
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }
  form.addClass('was-validated')
});
})
</script>



</body>


</html>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
