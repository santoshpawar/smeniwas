<?php

header("Access-Control-Allow-Origin: *");
/*
if(isset($_FILES['file']['tmp_name'])){
    $name = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
	
    for($i = 0; $i < count($tmp); $i++){
	
        if(move_uploaded_file($tmp[$i], "Images/".$name[$i])){
            echo $name[$i]." upload is complete<br>";
        } else {
            echo "move_uploaded_file function failed for ".$name[$i]."<br>";
        }
    }
}

*/
if(isset($_FILES['file']['tmp_name']))
{
    $name = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
	
    for($i = 0; $i < count($tmp_name_array); $i++)
	{
       /*if(move_uploaded_file($tmp[$i], "Images/".$name[$i])){
            echo $name[$i]." upload is complete<br>";
        } else {
            echo "move_uploaded_file function failed for ".$name[$i]."<br>";
        }
		*/
		
		include('s3_config.php');
		if($s3->putObjectFile($tmp_name_array[$i], $bucket , "mobileupload/" . $name_array[$i], S3::ACL_PUBLIC_READ) )
		{
			$s3file='http://'.$bucket.'.s3.amazonaws.com/mobileupload/'.$name_array[$i];
			echo "Upload Successful.";
		}
		else 
		{
			echo "Upload fail";
		}		
    }
}

?>