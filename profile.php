<?php

    include("connect.php");
	include("functions.php");
	include("captcha.php");
	
	
	if(logged_in())
	{

		
	?>
	
<!DOCTYPE html>
<html>


    <head>

	<link rel = "stylesheet"  type = "text/css" href = "css/bootstrap.min.css">

	<script src="https://www.google.com/recaptcha/api.js?render=6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6"></script>
    
	<title>Friendbook</title>

     </head>

<body>	

<form method="post" action="profile.php"> 

<div class="g-recaptcha">

<input type = "hidden" data-sitekey="6LfphZYUAAAAAHuw9ZHnzGyWOmICTUUhP_7p-fQ6" id = "g-recaptcha-response" name = "g-recaptcha-response">

</div>

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
<script src = "js/bootstrap.min.js" type = "text/javascript"></script>
  <a href = "changepassword.php" style="float:right; padding:5px; margin-right:20px; background-color:silver; color:black; text-decoration:none">Change Password</a><br><br>
  <a href = "logout.php" style="float:right; padding:5px; margin-right:20px; background-color:silver; color:black; text-decoration:none;">Log Out</a>
</body>

</html>	   
<?php
      	  }
     else
    {
		
	 header("location:login.php");
	 exit();
	 
	
	}

?>