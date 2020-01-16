<?php
// Bucket Name
$bucket="smeniwas.app.platform";
$bucket_case="casemgmt";

if (!class_exists('S3'))require_once('S3.php');
			
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJJLHYXV7CJOZEFRQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>