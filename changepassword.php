<?php


   include("connect.php");
   include("functions.php");
   
	
    

	
	if(isset($_POST['savepass']))
	{
		
		$password = $_POST['password'];
		$confirmPassword = $_POST['passwordconfirm'];
		
	
		if(strlen($password) < 8)
		{
			echo "<script>alert('Password length must be greater than 8 characters.')</script>";
	
		}	
	else if($password !== $confirmPassword)
	{
		echo "<script>alert('Password does not matched.')</script>";
		
	}
	else
		
		{
			$password = md5($password);
			$email = $_SESSION['email'];
			if(mysqli_query($connection, "UPDATE users SET password = '$password' WHERE email= '$email'"))
			{
				echo "<script>alert('Password changed Successfully.')</script>";
			}
		}
		
		
	}
   
   if(logged_in())
	   
	{
		   
	   ?>
	   
	   
	   
	   <!DOCTYPE hmtl>
	   
	   <head>
	   
	   <title>Change Password</title>
	   
	   <link rel = "stylesheet"  type = "text/css" href = "css/bootstrap.min.css">

	
	   
	   </head>
	   
	   <body>
	   
	   <a href = "logout.php" style="float:right; padding:5px; margin-right:20px; background-color:silver; color:black; text-decoration:none;">Log Out</a>

	   <script src = "js/bootstrap.min.js" type = "text/javascript"></script>
	   
	   
	   
	   
	   <form method = "post" action = "changepassword.php">
	   
	   <div class="form-group">

       <label for="pwd">New Password:</label>
    
       <input type="password" class="form-control" name="password" required placeholder = "Enter password">

       </div> 
	   
	   <div class="form-group">
       
	   <label for="pwd">Confirm Password:</label>
    
       <input type="password" class="form-control" name="passwordconfirm" required placeholder = "Re-enter password">

       </div>

	 
	   
	   <input type = "submit" name = "savepass" value = "Save Changes" class = "btn btn-success">
	   
	   
	   </form>

	   

	   
	   </body>
	   
	   </html>
	   
	  <?php 
	   
	   }else
		   
		   {
			   header("location:profile.php");
		   }
   
   ?>
    