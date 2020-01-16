<?php

header("Access-Control-Allow-Origin: *");
$case_user_id = $_GET['case_uid'];
include ('db.php');

$request = file_get_contents("php://input");
$data = json_decode($request);
$FirmName = mysqli_real_escape_string($con, $data->FirmName);
$EntityType = mysqli_real_escape_string($con, $data->EntityType);
$BusinessType = mysqli_real_escape_string($con, $data->BusinessType);
$KeyProduct = mysqli_real_escape_string($con, $data->KeyProduct);

$AuditedTurnover = mysqli_real_escape_string($con, $data->AuditedTurnover);
$FirmPan = mysqli_real_escape_string($con, $data->FirmPan);
$FirmRegNo = mysqli_real_escape_string($con, $data->FirmRegNo);
$OwnerName = mysqli_real_escape_string($con, $data->OwnerName);

$Email = mysqli_real_escape_string($con, $data->Email);
$Address = mysqli_real_escape_string($con, $data->Address);
$City = mysqli_real_escape_string($con, $data->City);
$State = mysqli_real_escape_string($con, $data->State);

$Pincode = mysqli_real_escape_string($con, $data->Pincode);
$Contact = mysqli_real_escape_string($con, $data->Contact);
$CibilScore = mysqli_real_escape_string($con, $data->CibilScore);
$LenderName = mysqli_real_escape_string($con, $data->LenderName);
$OutstandingAmt = mysqli_real_escape_string($con, $data->OutstandingAmt);
$MonthlyEmi = mysqli_real_escape_string($con, $data->MonthlyEmi);
$Liability = mysqli_real_escape_string($con, $data->Liability);

$Degree = mysqli_real_escape_string($con, $data->Degree);
$PromoType = mysqli_real_escape_string($con, $data->PromoType);
$Independent = mysqli_real_escape_string($con, $data->Independent);
$OwnedVehicle = mysqli_real_escape_string($con, $data->OwnedVehicle);
$MarketValue = mysqli_real_escape_string($con, $data->MarketValue);
$OwnedProperty = mysqli_real_escape_string($con, $data->OwnedProperty);

$CustomerNature = mysqli_real_escape_string($con, $data->CustomerNature);
$OfficePremiseOwned = mysqli_real_escape_string($con, $data->OfficePremiseOwned);
$OfficePremiseRented = mysqli_real_escape_string($con, $data->OfficePremiseRented);
$ManufacturePremise = mysqli_real_escape_string($con, $data->ManufacturePremise);
$BankName = mysqli_real_escape_string($con, $data->BankName);
$Amount = mysqli_real_escape_string($con, $data->Amount);

$cust1 = mysqli_real_escape_string($con, $data->cust1);
$sale1 = mysqli_real_escape_string($con, $data->sale1);
$year1 = mysqli_real_escape_string($con, $data->year1);
$cust2 = mysqli_real_escape_string($con, $data->cust2);
$sale2 = mysqli_real_escape_string($con, $data->sale2);
$year2 = mysqli_real_escape_string($con, $data->year2);
$cust3 = mysqli_real_escape_string($con, $data->cust3);
$sale3 = mysqli_real_escape_string($con, $data->sale3);
$year3 = mysqli_real_escape_string($con, $data->year3);
$CashSales = mysqli_real_escape_string($con, $data->CashSales);
$LoanPurpose = mysqli_real_escape_string($con, $data->LoanPurpose);
$ReqAmt = mysqli_real_escape_string($con, $data->ReqAmt);

$PropType = mysqli_real_escape_string($con, $data->PropType);
$ColAddress = mysqli_real_escape_string($con, $data->ColAddress);
$ColCity = mysqli_real_escape_string($con, $data->ColCity);
$ColPincode = mysqli_real_escape_string($con, $data->ColPincode);
$LatestVal = mysqli_real_escape_string($con, $data->LatestVal);
$CollateralType = mysqli_real_escape_string($con, $data->CollateralType);

$counter = mysqli_real_escape_string($con, $data->counter);

$date_time = date("Y-m-d H:i:s");

//Insert into mobile_app_data table:

$qry = "INSERT INTO mobile_app_data (Firm_Name,EntityType,BusinessType,KeyProduct,AuditedTurnover,FirmPan,FirmRegNo,OwnerName,Email,Address,City,State,Pincode,Contact,CibilScore,LenderName,OutstandingAmt,MonthlyEmi,Liability,Degree,PromoType,Independent,OwnedVehicle,MarketValue,OwnedProperty,CustomerNature,OfficePremiseOwned,OfficePremiseRented,ManufacturePremise,BankName,Amount,cust1,sale1,year1,cust2,sale2,year2,cust3,sale3,year3,CashSales,LoanPurpose,ReqAmt,PropType,ColAddress,ColCity,ColPincode,LatestVal,CollateralType,created_at) VALUES('$FirmName','$EntityType','$BusinessType','$KeyProduct','$AuditedTurnover','$FirmPan','$FirmRegNo','$OwnerName','$Email','$Address','$City','$State','$Pincode','$Contact','$CibilScore','$LenderName','$OutstandingAmt','$MonthlyEmi','$Liability','$Degree','$PromoType','$Independent','$OwnedVehicle','$MarketValue','$OwnedProperty','$CustomerNature','$OfficePremiseOwned','$OfficePremiseRented','$ManufacturePremise','$BankName','$Amount','$cust1','$sale1','$year1','$cust2','$sale2','$year2','$cust3','$sale3','$year3','$CashSales','$LoanPurpose','$ReqAmt','$PropType','$ColAddress','$ColCity','$ColPincode','$LatestVal','$CollateralType','$date_time')";

$qry_res = mysqli_query($con,$qry);
$id = mysqli_insert_id($con);
/*if($qry_res){
 echo "Data inserted app_data successfully";
}
else{
echo "Error description: " . mysqli_error($con);
}*/

//Insert into cases table:

$qry1 = "INSERT INTO cases (user_id,origination,contact_no_1,address2,city2,state2,pincode_2,name_of_company,type_of_entity,nature_of_business,turnover,name_of_promoter,cibil_score,total_loans_outstanding_owner,vehicles_owned,market_value_of_vehicle,properties_owned, is_collateral_property,address_LAP,city_LAP,pincode_LAP,purpose,amount, status, form_status, created_at)
 VALUES ('$case_user_id','Direct','$contact','$Address','$City','$State','$Pincode','$FirmName','$EntityType','$BusinessType','$AuditedTurnover','$OwnerName','$CibilScore','$OutstandingAmt','$OwnedVehicle','$MarketValue','$OwnedProperty', '$CollateralType','$ColAddress','$ColCity','$ColPincode','$LoanPurpose','$ReqAmt','Case File', null, '$date_time')";

$qry_res1 = mysqli_query($con1,$qry1);
$caseId = mysqli_insert_id($con1);
/*if($qry_res1){
 //echo "Data inserted in cases successfully";
}
else
{
    echo "Error description: " . mysqli_error($con1);
}*/


//Insert into users_profile table:

$qry2 = "INSERT INTO user_profiles (user_id,referredby_userid,name_of_firm,owner_purpose_of_loan,owner_entity_type,owner_name,address,owner_city,owner_state,pincode,contact1,contact2,latest_turnover,required_amount,created_at) VALUES (1,1,'$FirmName','$LoanPurpose','$EntityType','$OwnerName','$Address','$City','$State','$Pincode','$Contact','$Contact','$AuditedTurnover','$ReqAmt','$date_time')";
$qry_res2 = mysqli_query($con,$qry2);

/*if($qry_res2){
 echo "Data inserted in users_profile successfully";
}
else{
echo "Error description: " . mysqli_error($con);
}*/
$current_id = mysqli_insert_id($con);
//echo "Current Id: ".$current_id;

//Insert into users table:
$qry3 = "INSERT INTO users (username,email,created_at) VALUES ('$FirmPan','$Email','$date_time')";
$qry_res3 = mysqli_query($con,$qry3);

/*if($qry_res3){
 echo "Data inserted in user successfully";
}
else{
echo "Error description: " . mysqli_error($con);
}*/
$user_id = mysqli_insert_id($con);

//Update users_profile table:

$update_qry = "UPDATE user_profiles SET user_id = '$user_id', referredby_userid='$user_id' WHERE id = $current_id";

$update_qry_res = mysqli_query($con,$update_qry);

$rolesSql = "select id from roles where slug = 'SME'";
$rolesResult = mysqli_query($con,$rolesSql);
$rolesResultRow = mysqli_fetch_array($rolesResult);
$smeRoleId = $rolesResultRow["id"];
$roleQuery = "insert into role_users (user_id, role_id) values('$user_id', $smeRoleId);";
$qry_role = mysqli_query($con,$roleQuery);

if($update_qry_res){
    $outputArray= array();

    /* $sql = "SELECT id FROM mobile_app_data WHERE created_at = (SELECT max(created_at) FROM mobile_app_data)";
    $qryresult = mysqli_query($con,$sql);

        while ($row = mysqli_fetch_array($qryresult, MYSQL_ASSOC))
        {
       $id = $row['id'];
        }	 */

    /* $sql = "SELECT id FROM cases WHERE created_at = (SELECT max(created_at) FROM cases)";
    $qryresult = mysqli_query($con1,$sql);

        while ($row = mysqli_fetch_array($qryresult, MYSQL_ASSOC))
        {
       $caseId = $row['id'];
        } */

    $outputArray["mobile_app_data_id"]=$id;
    $outputArray["caseId"]=$caseId;
    echo json_encode($outputArray);

    //echo $id;

    //procedure for password reset
    $appKey = 'HnhVvfqDoG4xhEpbn9mr3r83XR7qA9J6';
    $length = 40;
    $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = substr( str_shuffle($string), 0, $length );
    $token = hash_hmac('sha256', $randomString, $appKey);

    if(isset($user_id))
    {
        $sql = "select * from users where id = $user_id";

        $query = mysqli_query($con,$sql);

        $row = mysqli_fetch_array($query);

        $passwordResetQuery = mysqli_query($con,"select * from password_resets where email = '".$row['email']."' ");
        $count = mysqli_num_rows($passwordResetQuery);

        if($count >= 1){

            $result = mysqli_query($con,"update password_resets set token = '".$token."' where email = '".$row['email']."' ");
        }
        else{

            $result = mysqli_query($con,"insert into password_resets (email, token , created_at) values ('".$row['email']."', '".$token."','".$date_time."') ");
        }

        /**** Sending Email *****/

        $fullEMAILURL = "http://smeniwas.com/system/mail/".$Email."/MSMENiwas/Password_Reset/".$token."/1";

        /* $fullEMAILURL ="http://ec2-52-10-18-196.us-west-2.compute.amazonaws.com/smeniwas2/public/system/mail/".$Email."/MSMENiwas/Password_Reset/".$token."/1"; */

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$fullEMAILURL);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        /*if ($output=== FALSE) {
              echo 'Curl error: ' . curl_error($ch);
              die('111');
        }else{echo "executed";}*/
        curl_close($ch);

        /**** Sending SMS *****/

        $fullSMSURL = 'http://sms.variformsolutions.co.in/apiv2/?api=http&workingkey=Ae0e48654dece89323d46d659752a77b0&sender=SNIWAS&to='.$Contact.'&message=You%20have%20received%20a%20new%20query.%20Please%20login%20to%20your%20account%20to%20respond%20to%20the%20query';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$fullSMSURL);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);

    }
    //end password reset
}
else{
    echo "error";
    //echo "Error description: " . mysqli_error($con);
}
?>