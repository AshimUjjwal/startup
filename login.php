<?php

  include("connect.php");
	include("functions.php");
	include("captcha.php");
	
	if(logged_in())
		
		{
			header("location:profile.php");
			exit();
		}
	
	if(isset($_POST['submit']))
    {
	   $email=mysqli_real_escape_string($connection,$_POST['email']);
	   $password=mysqli_real_escape_string($connection,$_POST['password']);
	   $checkBox= isset($_POST['keep']);
	   
	   if(email_exists($email,$connection))
	   
	   {
		
		
		 $result= mysqli_query($connection, "SELECT password FROM users WHERE email= '$email'");
		 $retrievepassword= mysqli_fetch_array($result);
		
		
		 if(md5($password) !==  $retrievepassword['password'])
		 {
			echo "<script>alert('The password that you've entered is incorrect.')</script>";
			
		
		 }
		 else
		  
		    {
			  $_SESSION['email']= $email;
			  
			  if($checkBox == "on")
			  {
				  setcookie("email",$email,time()+3600);
			  }
			  
			  header("location:profile.php");
			  
		    }
		}
	    
		else
		{
			echo "<script>alert('The email address that you've entered doesn't match any account.')</script>";
			
		}
	}

?>

   
 <!DOCTYPE html>  
 <html lang="en-us">
 <head>
 <title>Login</title>
 
 <link rel = "stylesheet"  type = "text/css" href = "css/bootstrap.min.css">
 
 <script src="https://www.google.com/recaptcha/api.js?render=6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6"></script>
 
 </head>
 <body>
 <script src = "js/bootstrap.min.js" type = "text/javascript"></script>

 <h1> Login here</h1>
 <a href= "signup.php">Create Account</a>
 
 
 
 <form method="post" action="login.php">          
 
 <div class="form-group">
 
 <label for="email">Email:</label>
    
 <input type="text" class="form-control" name="email" required placeholder = "Enter email">

 </div>

<div class="form-group">

<label for="pwd">Password:</label>
    
    <input type="password" class="form-control" name="password" required placeholder = "Enter password">

</div>
<div class="g-recaptcha">
<input type = "hidden" data-sitekey="6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6" id = "g-recaptcha-response" name = "g-recaptcha-response">
</div>
 
<div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name = "conditions"> Remember Me
    </label>
  </div>


<input type = "submit" name = "submit" value = "Sign In" class = "btn btn-success">
 </form>
 <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6', {action: 'homepage'})
	  .then(function(token) 
	  {
		//console.log(token);
		document.getElementById('g-recaptcha-response').value = token;
      });
  });
  </script>
 </body>
 </html>