<?php

header("Access-Control-Allow-Origin: *");
include ('db.php');

$username = $_GET['username'];
$pagecount = $_GET['pagecount'];
$email = $_GET['email'];

//echo "pagecount: $pagecount";
//echo "email: ".$email;

if($pagecount == 3){
$sql = "SELECT username, email FROM users WHERE username = '$username'";
$result = mysqli_query($con,$sql);
  
	if(mysqli_num_rows($result)>0){
	echo "Name already exist";
	}
	else{
	echo "Name does not exist";
	}
}else if($pagecount == 4){
$sql = "SELECT username, email FROM users WHERE email = '$email'";

$result = mysqli_query($con,$sql);
  
	if(mysqli_num_rows($result)>0){
	 echo "Email already exist";
	}
	else{
	echo "Email does not exist";
	}
}

?>