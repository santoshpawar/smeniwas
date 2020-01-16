<?php
header("Access-Control-Allow-Origin: *");
$baseUrl="http://smeniwas.com/mobile/";
$outputArray= array(); 	   		
$outputArray["baseUrl"]=$baseUrl;					
echo json_encode($outputArray);
?>