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
	   $fullname= mysqli_real_escape_string($connection,$_POST['fname']);
       
	   $email= mysqli_real_escape_string($connection,$_POST['email']);
	   
	   $password= mysqli_real_escape_string($connection,$_POST['password']);
	   
	   $passwordConfirm=mysqli_real_escape_string($connection,$_POST['passwordconfirm']);
	   
	   $gender= isset($_POST['gender']);
	   
	   $date= date("d D,F Y");
	   
	   $keep = isset($_POST['conditions']);

	   //you can use <mark>"keep or conditions"</mark> whatever you like for agree with term and conditions feature..
	   
	    if(strlen($fullname) <3)
	    { 
        echo "<script>alert('First Name is too short.')</script>";
		
        }
	    
	    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	    {
	    echo "<script>alert('Please Enter valid E-mail address.')</script>";
		
        }
		else if(email_exists($email,$connection))
		{
			echo "<script>alert('Already registered with this email address.')</script>";
			
		}
	    else if(strlen($password) <8)
	    {
	    echo "<script>alert('Password must be greater than 8 characters.')</script>";
		
	    }
	    else if($password !== $passwordConfirm)
	    {
        echo "<script>alert('Password does not match.')</script>";
		
	    }

		
		else if(!$keep)
		{
			echo "<script>alert('You must agree with our terms and conditions.')</script>";
			
		}
		else
		{
	       $password = md5($password);
		     $insertQuery = "INSERT INTO users(fullname,email,password,gender,date) 
			 VALUES('$fullname','$email','$password','$gender','$date')";
		     if(mysqli_query($connection, $insertQuery))
		        
			      {
				    echo "<script>alert('You are successfully registered.')</script>";
					
			      }
		}
	
	}

?>

   
 <!DOCTYPE html>  

 <html lang="en-us">

 <head>

 <script src="https://www.google.com/recaptcha/api.js?render=6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6"></script>
  
 <link rel = "stylesheet"  type = "text/css" href = "css/bootstrap.min.css">

 <title>SignUp</title>
 
 </head>
 
 <body>
 <script src = "js/bootstrap.min.js" type = "text/javascript"></script>
 

 

 <div class="form-group">
    
 <a href= "login.php">Sign in</a>

</div>
 
<form method="post" action="signup.php" enctype="multipart/form-data" autocomplete= "on">
 
 <div class="form-group">

 <label for="first">Full Name:</label>
    
    <input type="text" class="form-control" name="fname" required placeholder = "Enter Full Name">

</div>          


<div class="form-group">
<label for="email">Email:</label>
    
    <input type="text" class="form-control" name="email" required placeholder = "Enter email">

</div>

<div class="form-group">

<label for="pwd">Password:</label>
    
    <input type="password" class="form-control" name="password" required placeholder = "Enter password">

</div>

<div class="form-group">
<label for="pwd">Confirm Password:</label>
    
    <input type="password" class="form-control" name="passwordconfirm" required placeholder = "Re-enter password">

</div>

<div class="form-group">

<label for="sex">Gender:</label>

<input type= "radio" name= "gender" value= "Male" required> Male 
 
<input type= "radio" name= "gender" value= "Female" required> Female
    
</div>


<div class="g-recaptcha">
<input type = "hidden" data-sitekey="6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6" id = "g-recaptcha-response" name = "g-recaptcha-response">
</div>

<div class="form-group form-check">
    <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name = "conditions">By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy.
    </label>
</div>

<input type = "submit" name = "submit" value = "Sign Up" class = "btn btn-success">
 
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