<?php

header("Access-Control-Allow-Origin: *");
include('db.php');

// This file opens a connection to database
$db = mysql_connect($host, $user, $pass) or 
	die('Error connecting to mysql' . mysql_error());
mysql_select_db($database);
 mysql_query ("set character_set_client='utf8'"); 
 mysql_query ("set character_set_results='utf8'"); 

$sql = mysql_query("SELECT * FROM master_data where status = 1");

 if(mysql_num_rows($sql)){
    $data = array();
	while($row = mysql_fetch_array($sql)){
	    $data[]=array(
		 'id' => $row['id'],
		 'type' => $row['type'],
		 'name' => $row['name'],
		 'value' => $row['value']
		 );
	}

	header('Content-type:application/json');
	$output = json_encode($data);	
	echo $output;
 }
?>