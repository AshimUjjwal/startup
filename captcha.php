<?php

if($_POST)
{

function getCaptcha($SecretKey)

{

$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret='.6LfphZYUAAAAABvMaigwz5waayblcZygiRdw3T8l.'&response=($SecretKey)");

$Return = json_decode($Response);

return $Return;


}

$Return = getCaptcha($_POST['g-recaptcha-response']);

//var_dump($Return);

if($Return->success == true && $Return->score > 0.5)
{
    $error= "You are successfully registered.";
}


}

?>