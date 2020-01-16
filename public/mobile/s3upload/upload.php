<?php

header("Access-Control-Allow-Origin: *");

include('image_check.php');

include('../db.php');

//$sql = "SELECT id FROM mobile_app_data WHERE created_at = (SELECT max(created_at) FROM mobile_app_data)";

//$qryresult = mysqli_query($con,$sql);
 
//while ($row = mysqli_fetch_array($qryresult, MYSQL_ASSOC)) 
//{ 
//	$id = $row['id'];
//}


$isFinish = "N";   
$uniqueIndex=1; 
$id=$_POST["mobile_app_data_id"];
$case_uid=$_POST["case_uid"];	
$caseId=$_POST["caseId"];
echo "<br>".$caseId;
            

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $tmp = $_FILES['file']['tmp_name'];    
    //$ext = getExtension($name);

	for($k = 0; $k < count($tmp); $k++)
	{
		$actual_image_name = $name;
		$test = $actual_image_name[$k];

		$ext = getExtension($test);
		if(strlen($name[$k]) > 0)
		{
			//if(in_array($ext,$valid_formats))
			//{ 
				include('s3_config.php');
				$actual_image_name = $name;
				$fileName="";
				$array = explode('.', $actual_image_name[$k]);
				$fileName=$array[0].$uniqueIndex.'.'.$array[1];

				if($s3->putObjectFile($tmp[$k], $bucket , "mobileupload/".$id."/". $fileName, S3::ACL_PUBLIC_READ) )
				{
					$s3file='http://'.$bucket.'.s3.amazonaws.com/mobileupload/'.$id.'/'.$fileName;
					$fileName="";
					if($k == 0){
					
					  //upload file for case management: start
						
						$array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					  	$caseFileName='case_'.$caseId.'-'.$array[0].'.'.$array[1];
						
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);
						
						$update_qry1 = "UPDATE cases SET upload_file = '$caseFileName' WHERE id = $caseId";  
					   	$update_qry_res1 = mysqli_query($con1,$update_qry1);		
					  //upload file for case management: end
					 
					   $update_qry = "UPDATE mobile_app_data SET comp_fin_upd = '/$id/$fileName' WHERE id = $id";					  
					   $update_qry_res = mysqli_query($con,$update_qry);

						if($update_qry_res){
						  echo "<br/> 1st Update";
						}else{
						  echo "<br/> 1st Not Updated". mysqli_error($con);
						}
					}
					
					if($k == 1){						
						$array = explode('.', $name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					  $update_qry = "UPDATE mobile_app_data SET comp_pan_upd = '/$id/$fileName' WHERE id = $id";
					  $update_qry_res = mysqli_query($con,$update_qry);
					  
					    $array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];					  	
						$caseFileName='case_'.$caseId.'-comp_pan_upd-'.$array[0].'.'.$array[1];
						
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);
						
						$update_qry1 = "UPDATE cases SET comp_pan_upd = '$caseFileName' WHERE id = $caseId";		  
					   	$update_qry_res1 = mysqli_query($con1,$update_qry1);	
					}
						
					if($k == 2){						
						$array = explode('.', $name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					  $update_qry = "UPDATE mobile_app_data SET comp_addr_upd = '/$id/$fileName' WHERE id = $id";
					  $update_qry_res = mysqli_query($con,$update_qry);
					  
					    $array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];					  	
						$caseFileName='case_'.$caseId.'-comp_addr_upd-'.$array[0].'.'.$array[1];
						
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);
												
						$update_qry1 = "UPDATE cases SET comp_addr_upd = '$caseFileName' WHERE id = $caseId";	  
						$update_qry_res1 = mysqli_query($con1,$update_qry1);
					}
						
					if($k == 3){						
						$array = explode('.', $name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					  $update_qry = "UPDATE mobile_app_data SET prom_addr_upd = '/$id/$fileName' WHERE id = $id";
					  $update_qry_res = mysqli_query($con,$update_qry);
					  
					    $array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];					  	
						$caseFileName='case_'.$caseId.'-prom_addr_upd-'.$array[0].'.'.$array[1];
						
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);
						
						$update_qry1 = "UPDATE cases SET prom_addr_upd = '$caseFileName' WHERE id = $caseId";		  
						$update_qry_res1 = mysqli_query($con1,$update_qry1);
					}
					
					if($k == 4){							
						$array = explode('.', $name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					    $update_qry = "UPDATE mobile_app_data SET prom_pan_upd = '/$id/$fileName' WHERE id = $id";
					    $update_qry_res = mysqli_query($con,$update_qry);
					  
					    $array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];					  	
						$caseFileName='case_'.$caseId.'-prom_pan_upd-'.$array[0].'.'.$array[1];
						
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);
													  
					    $update_qry1 = "UPDATE cases SET prom_pan_upd = '$caseFileName' WHERE id = $caseId";		  
						$update_qry_res1 = mysqli_query($con1,$update_qry1);
					}
					
					if($k == 5){						
						$array = explode('.', $name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					  $update_qry = "UPDATE mobile_app_data SET prom_bank_upd = '/$id/$fileName' WHERE id = $id";
					  $update_qry_res = mysqli_query($con,$update_qry);
					  
					    $array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];					  	
						$caseFileName='case_'.$caseId.'-prom_bank_upd-'.$array[0].'.'.$array[1];
						 
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);
											
						$update_qry1 = "UPDATE cases SET prom_bank_upd = '$caseFileName' WHERE id = $caseId";	  
						$update_qry_res1 = mysqli_query($con1,$update_qry1);
					}
						
					if($k == 6){						
						$array = explode('.', $name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];
					  $update_qry = "UPDATE mobile_app_data SET prom_cibil_upd = '/$id/$fileName' WHERE id = $id";
					  $update_qry_res = mysqli_query($con,$update_qry);
					  
					    $array = explode('.', $actual_image_name[$k]);
						$fileName=$array[0].$uniqueIndex.'.'.$array[1];					  	
						$caseFileName='case_'.$caseId.'-prom_cibil_upd-'.$array[0].'.'.$array[1];
						 
						$srcUri="mobileupload/".$id."/".$fileName;
						$uri=$case_uid."/".$caseFileName;
						$s3->copyObject($bucket, $srcUri, $bucket_case, $uri,S3::ACL_PUBLIC_READ);	
						
						$update_qry1 = "UPDATE cases SET prom_cibil_upd = '$caseFileName' WHERE id = $caseId";		  
						$update_qry_res1 = mysqli_query($con1,$update_qry1);
					}
							
					echo "<br/>Upload Successful.";
					$isFinish = "Y";
				}
				else
				{
					echo "<br/>Upload Fail.";
				}
			/*}
			else
			{
			  echo "Invalid file, please upload image file.";
			}*/
		}
		else
		{
			echo "<br/>Please select image file.";
		}
	     $uniqueIndex++;		
	}
	if($isFinish == "Y")
	{		
	    header("Location: http://smeniwas.com/mobile/thanks.html");		
	}
	
}
?>