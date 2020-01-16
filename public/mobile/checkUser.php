<?php

header("Access-Control-Allow-Origin: *");
include ('db.php');

$userEmail = $_GET['uemail'];
$userPass = $_GET['upass'];

$uid = NULL;



$response_array = array();

$sql = "SELECT id, password FROM users WHERE email = '$userEmail'";

$qryresult = mysqli_query($con1,$sql);
 
while ($row = mysqli_fetch_array($qryresult, MYSQL_ASSOC)) 
{ 
	$pwd = $row['password'];
	$uid = $row['id'];
}

//$hashed = '$2y$10$FAq8VnL8qVpY6I1nmdNwW.TbIswBHUz1q8BD8au0stnv2l2iXok8S';
$result = password_verify($userPass, $pwd);

if($result == 1) { 
	$response_array['message'] = 'Login successful';
	$response_array['user_id'] = $uid;
  
}else{
  $response_array['message'] = 'Login fail';
}

//Check user role

$sql1 = "SELECT * FROM role_users WHERE user_id= $uid AND role_id IN(3,4)";

$qryresult1 =  mysqli_query($con1,$sql1);

if($qryresult1){
	if(mysqli_num_rows($qryresult1)==1){
	$response_array['validRole'] = 'Valid';
	echo json_encode($response_array);
	}
	else{
	 $response_array['validRole'] = 'Fail';
	 echo json_encode($response_array);
	}
}

?>