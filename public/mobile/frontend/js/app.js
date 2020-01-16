app = angular.module('SMENiwasFosApp', ['ionic', 'ui.bootstrap', 'ngMessages','ngFileUpload']);

app.run(function($ionicPlatform, $ionicPopup) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
 
  $ionicPlatform.registerBackButtonAction(function(e) {

  e.preventDefault();

  function showConfirm() {
    var confirmPopup = $ionicPopup.confirm({
      title: '<strong>Exit Smeniwas?</strong>',
      template: 'Are you sure you want to exit?',
      okText: 'Yes',
      okType: 'button-default',
      cancelText: 'No',
      cancelType: 'button-positive'        
    });

    confirmPopup.then(function(res) {
      if (res) {
        ionic.Platform.exitApp();
      } else {
        // Don't close
      }
    });
  }
 }, 101);  
    
})

app.factory('authentication', function() {
  return {
    isAuthenticated: true,
    user: null
  }
});

app.controller('MainCtrl', ['$scope','$http', '$state', '$modal','$ionicHistory','backcallFactory','Upload', '$timeout', function($scope, $http, $state, $modal, $ionicHistory, backcallFactory, Upload, $timeout) {
    
    //$scope.CollateralProperty = 'No';
   // $scope.OfficePremise = 'Rented';
    //$scope.ManufacturePremise = 'Leased';
    $scope.checkName = false;
    
    backcallFactory.backcallfun();
    
    //$http.get("http://ec2-52-10-18-196.us-west-2.compute.amazonaws.com/smeniwas2/public/mobile/get_masterdata.php").success(function(resp){
    $http.get("http://smeniwas.com/mobile/get_masterdata.php").success(function(resp){
        
        $scope.listdata = resp;
        console.log("$scope.listdata: " +$scope.listdata);
    })
     .error(function(err) 
    { 
        console.log('response, ERR: ' + err);
    }); 

    $scope.OfficeOwned = function () { 
     document.getElementById('OfficePremiseOwned').style.display = 'block';
     document.getElementById('OfficePremiseRented').style.display = 'none'; 
   }
    $scope.OfficeRented= function () { 
     document.getElementById('OfficePremiseRented').style.display = 'block';
     document.getElementById('OfficePremiseOwned').style.display = 'none';
   }
    $scope.manufactureOwned = function () { 
     document.getElementById('manufacturePremiseOwned').style.display = 'block';
     
   }
    $scope.manufactureLeased= function () { 
     document.getElementById('manufacturePremiseOwned').style.display = 'none';
   }
    
    $scope.OpenFirstDiv = function (group) { 
   
	var ele = document.getElementById('page6_OwnedVehicle');
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
   
}
    $scope.OpenSecondDiv = function () { 
	var ele = document.getElementById('page6_OwnedProperty');
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
}
$scope.SelectCollateral = function () {
    document.getElementById('ColType').style.display = "block";
 }
$scope.deSelectCollateral = function () { 
  document.getElementById('ColType').style.display = "none";	
}

 $scope.GetValue = function () {
    var selectedCity = $scope.formData.ColCity;
    if(selectedCity == 'Other'){
      document.getElementById("ColCity").style.display = 'block';
    }else {
      document.getElementById("ColCity").style.display = 'none';
    }
}
 
  $scope.GetCityValue = function () {
    var selectedCity = $scope.formData.City;
    if(selectedCity == 'Other'){
      document.getElementById("MainCity").style.display = 'block';
    }else {
      document.getElementById("MainCity").style.display = 'none';
    }
}
  
  $scope.fileNameChanged = function() {
   alert("select file");
}

//login modal: start    
  $scope.openDialog = function (size) {
    var modalInstance = $modal.open({
      animation: $scope.animationsEnabled,    
      templateUrl: 'Login.html',
      controller: 'LoginCtrl',
      size: size,
    });
  };
//login modal: end 


  $scope.formData= {}
	
  $scope.saveData = function(){
     
       var url = "http://smeniwas.com/mobile/saveData.php"; 
       // var url = "http://ec2-52-10-18-196.us-west-2.compute.amazonaws.com/smeniwas2/public/mobile/saveData.php"; 
        
       $http.post(url, {'FirmName': $scope.formData.FirmName, 
                        'EntityType': $scope.formData.EntityType,
                        'BusinessType': $scope.formData.BusinessType,
                        'KeyProduct': $scope.formData.KeyProduct,
                        
                        'AuditedTurnover':$scope.formData.AuditedTurnover,
                        'FirmPan':$scope.formData.FirmPan,
                        'FirmRegNo':$scope.formData.FirmRegNo,
                        'OwnerName':$scope.formData.OwnerName,
                        
                        'Email':$scope.formData.Email,
                        'Address':$scope.formData.Address,
                        'City':$scope.formData.City,
                        'State':$scope.formData.State,
                        
                        'Pincode':$scope.formData.Pincode,
                        'Contact':$scope.formData.Contact,
                        'CibilScore':$scope.formData.CibilScore,
                        'LenderName':$scope.formData.LenderName,
                        'OutstandingAmt':$scope.formData.OutstandingAmt,
                        'MonthlyEmi':$scope.formData.MonthlyEmi,
                        'Liability':$scope.formData.Liability,
                        
                        'Degree':$scope.formData.Degree,
                        'PromoType':$scope.formData.PromoType,
                        'Independent':$scope.formData.Independent,
                        'OwnedVehicle':$scope.formData.OwnedVehicle,
                        'MarketValue':$scope.formData.MarketValue,
                        'OwnedProperty':$scope.formData.OwnedProperty,
                        
                        'OfficePremise':$scope.formData.OfficePremise,
                        'CustomerNature':$scope.formData.CustomerNature,
                        'OfficePremiseOwned':$scope.formData.OfficePremiseOwned,
                        'OfficePremiseRented':$scope.formData.OfficePremiseRented,
                        'ManufacturePremise':$scope.formData.ManufacturePremise,
                        'BankName':$scope.formData.BankName,
                        'Amount':$scope.formData.Amount,
                        
                        'cust1':$scope.formData.cust1,
                        'sale1':$scope.formData.sale1,
                        'year1':$scope.formData.year1,
                        'cust2':$scope.formData.cust2,
                        'sale2':$scope.formData.sale2,
                        'year2':$scope.formData.year2,
                        'cust3':$scope.formData.cust3,
                        'sale3':$scope.formData.sale3,
                        'year3':$scope.formData.year3,
                        'CashSales':$scope.formData.CashSales,
                        'LoanPurpose':$scope.formData.LoanPurpose,
                        'ReqAmt':$scope.formData.ReqAmt,
                        
                        'YesNo' :$scope.formData.YesNo,
                        'PropType':$scope.formData.PropType,
                        'ColAddress':$scope.formData.ColAddress,
                        'ColCity':$scope.formData.ColCity,
                        'ColPincode':$scope.formData.ColPincode,
                        'LatestVal':$scope.formData.LatestVal,
                        'CollateralType':$scope.formData.CollateralType,
                        
                        'counter': encodeURIComponent($scope.counter)
                       }).success(function(data){
           
                         console.log("data: " +data);
                         if(data == "Data Update in users_profile successfully"){
                              $state.go("page11");
                         }else { 
                             alert("Registration Fail");
                         }
                        /*$scope.Submit = function(){
                        if($scope.counter==7 && data == "Data Updated successfully" )
                        {
                            console.log("Thank you for registering with us:" +$scope.counter);
                            $state.go("page10");
                        }
                        else{
                            
                            alert("Your fail to register, Register again!! " +$scope.counter);
                        }
                    };*/
        })
 
        .error(function(response){
        
           alert("Try again");
        
        });
    }
    
function MyCtrl($scope, $ionicHistory) {
  $scope.myGoBack = function() {
    $ionicHistory.goBack();
      console.log("call back function");
  };
    
     $scope.isGroupShown = function(group) {
    return $scope.shownGroup === group;
  };
}
   
$scope.ValidateFields_page2 = function(){ 
  
    if($scope.formData.FirmName == null || $scope.formData.FirmName == "")
    {
        document.getElementById("page2_firmname").style.borderColor = "red";
    }else {
        document.getElementById("page2_firmname").style.borderColor = "#ddd";
    }
    if($scope.formData.EntityType == null || $scope.formData.EntityType == "")
    {
        document.getElementById("page2_EntityType").style.borderColor = "red";
    }else {
        document.getElementById("page2_EntityType").style.borderColor = "#ddd";
    }
    if($scope.formData.BusinessType == null || $scope.formData.BusinessType == "")
    {
        document.getElementById("page2_BusinessType").style.borderColor = "red";
    }else { 
        document.getElementById("page2_BusinessType").style.borderColor = "#ddd";
    }
    if($scope.formData.KeyProduct == null || $scope.formData.KeyProduct == "")
    {
        document.getElementById("page2_KeyProduct").style.borderColor = "red";
    } else { 
        document.getElementById("page2_KeyProduct").style.borderColor = "#ddd";
    }
    if($scope.formData.FirmName && $scope.formData.EntityType && $scope.formData.BusinessType && $scope.formData.KeyProduct)
    { 
      $state.go("page3");
    }   
  };
    
$scope.ValidateFields_page3 = function(){ 
   
    if($scope.formData.AuditedTurnover == null || $scope.formData.AuditedTurnover == "")
    {
        document.getElementById("page3_AuditedTurnover").style.borderColor = "red";
    }else {
        document.getElementById("page3_AuditedTurnover").style.borderColor = "#ddd";
    }
    if($scope.formData.FirmPan == null || $scope.formData.FirmPan == "")
    {
        document.getElementById("page3_FirmPan").style.borderColor = "red";
    }else {
        document.getElementById("page3_FirmPan").style.borderColor = "#ddd";
    }
    if($scope.formData.FirmRegNo == null || $scope.formData.FirmRegNo == "")
    {
        document.getElementById("page3_FirmRegNo").style.borderColor = "red";
    }else {
        document.getElementById("page3_FirmRegNo").style.borderColor = "#ddd";
    }
    if($scope.formData.OwnerName == null || $scope.formData.OwnerName == "")
    {
        document.getElementById("page3_OwnerName").style.borderColor = "red";
    }else {
        
        document.getElementById("page3_OwnerName").style.borderColor = "#ddd";
        $scope.ownerName= document.getElementById("ownerName").value;
        console.log($scope.ownerName);
        $http.post("http://smeniwas.com/mobile/GetUserInfo.php?username=" +  encodeURIComponent($scope.ownerName) + "&pagecount=3").success(function(userdata) {
    
            console.log("response" + userdata);
            if(userdata == 'Name already exist'){
                alert("Name already exist, Please provide another name");
                $scope.checkName = true;
                
            }
        });
    } 
    if($scope.formData.AuditedTurnover && $scope.formData.FirmPan && $scope.formData.FirmRegNo && $scope.formData.OwnerName)
    {
        //console.log("$scope.checkName: "+$scope.checkName);
        $state.go("page4");
    }   
  };
    
$scope.ValidateFields_page4 = function(){ 
   
    if($scope.formData.Email == null || $scope.formData.Email == "")
    {
        document.getElementById("page4_Email").style.borderColor = "red";
    }else {
        document.getElementById("page4_Email").style.borderColor = "#ddd";
        $scope.userEmail= document.getElementById("email").value;
        console.log("$scope.userEmail: " +$scope.userEmail);
        $http.post("http://smeniwas.com/mobile/GetUserInfo.php?email=" +  encodeURIComponent($scope.userEmail) + "&pagecount=4").success(function(userdata) {
    
            //console.log("response" + userdata);
            if(userdata == 'Email already exist'){
                alert("Email already exist, Please provide another Email Id");
            }
        });
    } 
    if($scope.formData.Address == null || $scope.formData.Address == "")
    {
        document.getElementById("page4_Address").style.borderColor = "red";
    }else {
        document.getElementById("page4_Address").style.borderColor = "#ddd";
    } 
    if($scope.formData.City == null || $scope.formData.City == "")
    {
        document.getElementById("page4_City").style.borderColor = "red";
    }else {
        document.getElementById("page4_City").style.borderColor = "#ddd";
    } 
    if($scope.formData.State == null || $scope.formData.State == "")
    {
        document.getElementById("page4_State").style.borderColor = "red";
    } else {
        document.getElementById("page4_State").style.borderColor = "#ddd";
    } 
    if($scope.formData.Email && $scope.formData.Address && $scope.formData.City && $scope.formData.State)
    {
      $state.go("page5");
    }   
  };
    
$scope.ValidateFields_page5 = function(){ 
   
    if($scope.formData.Pincode == null || $scope.formData.Pincode == ""){
        document.getElementById("page5_Pincode").style.borderColor = "red";
    } else{
        document.getElementById("page5_Pincode").style.borderColor = "#ddd";
    }
    if($scope.formData.Contact == null || $scope.formData.Contact == "")
    {
        document.getElementById("page5_Contact").style.borderColor = "red";
    }else{
        document.getElementById("page5_Contact").style.borderColor = "#ddd";
    }
    if($scope.formData.CibilScore == null || $scope.formData.CibilScore == "")                                                                                                                     {
        document.getElementById("page5_CibilScore").style.borderColor = "red";
    }else{
        document.getElementById("page5_CibilScore").style.borderColor = "#ddd";
    }
    if($scope.formData.LenderName == null || $scope.formData.LenderName == "")
    {
        document.getElementById("page5_LenderName").style.borderColor = "red";
    } else{
        document.getElementById("page5_LenderName").style.borderColor = "#ddd";
    }
    if($scope.formData.MonthlyEmi == null || $scope.formData.MonthlyEmi == "")
    {
        document.getElementById("page5_MonthlyEmi").style.borderColor = "red";
    } else{
        document.getElementById("page5_MonthlyEmi").style.borderColor = "#ddd";
    }
    if($scope.formData.OutstandingAmt == null || $scope.formData.OutstandingAmt == "")
    {
        document.getElementById("page5_OutstandingAmt").style.borderColor = "red";
    } else{
        document.getElementById("page5_OutstandingAmt").style.borderColor = "#ddd";
    }
    if($scope.formData.Liability == null || $scope.formData.Liability == "")
    {
        document.getElementById("page5_Liability").style.borderColor = "red";
    } else{
        document.getElementById("page5_Liability").style.borderColor = "#ddd";
    }
    if($scope.formData.Pincode && $scope.formData.Contact && $scope.formData.CibilScore && $scope.formData.LenderName && $scope.formData.MonthlyEmi && $scope.formData.OutstandingAmt && $scope.formData.Liability)
    {
      $state.go("page6");
    }   
  };

$scope.ValidateFields_page6 = function(){ 
   
    if($scope.formData.Degree == null || $scope.formData.Degree == "")
    {
        document.getElementById("page6_Degree").style.borderColor = "red";
    }else {
        document.getElementById("page6_Degree").style.borderColor = "#ddd";
    }
    if($scope.formData.OwnedVehicle == null || $scope.formData.OwnedVehicle == "")
    {
        document.getElementById("list1").style.borderColor = "red";
    }else {
        document.getElementById("list1").style.borderColor = "#ddd";
    }
    if($scope.formData.MarketValue == null || $scope.formData.MarketValue == "")
    {
        document.getElementById("page6_MarketValue").style.borderColor = "red";
    } else {
        document.getElementById("page6_MarketValue").style.borderColor = "#ddd";
    }
    if($scope.formData.OwnedProperty == null || $scope.formData.OwnedProperty == "")
    {
        document.getElementById("list2").style.borderColor = "red";
    } else {
        document.getElementById("list2").style.borderColor = "#ddd";
    }
    if($scope.formData.PromoType == null || $scope.formData.PromoType == "")
    {
        document.getElementById("checkRadioButton1").style.borderColor = "red";
    } else {
        document.getElementById("checkRadioButton1").style.borderColor = "#ddd";
    }
    if($scope.formData.Independent == null || $scope.formData.Independent == "")
    {
        document.getElementById("checkRadioButton2").style.borderColor = "red";
    } else {
        document.getElementById("checkRadioButton2").style.borderColor = "#ddd";
    }
    if($scope.formData.Degree && $scope.formData.OwnedVehicle && $scope.formData.MarketValue && $scope.formData.OwnedProperty && $scope.formData.PromoType && $scope.formData.Independent)
    {
      $state.go("page7");
    }   
  };
    
$scope.ValidateFields_page7 = function(){ 
   
    if($scope.formData.CustomerNature == null || $scope.formData.CustomerNature == "")
    {
        document.getElementById("page7_CustomerNature").style.borderColor = "red";
    }else {
        document.getElementById("page7_CustomerNature").style.borderColor = "#ddd";
    }
     if($scope.formData.BankName == null || $scope.formData.BankName == "")
    {
        document.getElementById("page7_BankName").style.borderColor = "red";
    }else {
        document.getElementById("page7_BankName").style.borderColor = "#ddd";
    }
    if($scope.formData.Amount == null || $scope.formData.Amount == "")
    {
        document.getElementById("page7_Amount").style.borderColor = "red";
    }else {
        document.getElementById("page7_Amount").style.borderColor = "#ddd";
    }
    if($scope.formData.OfficePremise == null || $scope.formData.OfficePremise == "")
    {
        document.getElementById("checkOP").style.borderColor = "red";
    } else {
        document.getElementById("checkOP").style.borderColor = "#ddd";
        if($scope.formData.OfficePremise == 'Rented'){
             if($scope.formData.OfficePremiseRented == null || $scope.formData.OfficePremiseRented == "")
             {
                document.getElementById("OfficePremiseRented").style.borderColor = "red";
             }else {
                document.getElementById("OfficePremiseRented").style.borderColor = "#ddd";
             }
        }else if($scope.formData.OfficePremise == 'Owned'){
            if($scope.formData.OfficePremiseOwned == null || $scope.formData.OfficePremiseOwned == "")
             {
                document.getElementById("OfficePremiseOwned").style.borderColor = "red";
             }else {
                document.getElementById("OfficePremiseOwned").style.borderColor = "#ddd";
             }
        }      
    }
    if($scope.formData.CustomerNature && $scope.formData.BankName && $scope.formData.Amount && $scope.formData.OfficePremiseOwned || $scope.formData.OfficePremiseRented)
    {
      $state.go("page8");
    }   
  };
    
    
$scope.ValidateFields_page8 = function(){ 
   
    if($scope.formData.cust1 == null || $scope.formData.cust1 == "")
    {
        document.getElementById("page8_cust1").style.borderColor = "red";
    }else {
        document.getElementById("page8_cust1").style.borderColor = "#ddd";
    }
    if($scope.formData.sale1 == null || $scope.formData.sale1 == "")
    {
        document.getElementById("page8_sale1").style.borderColor = "red";
    }else {
        document.getElementById("page8_sale1").style.borderColor = "#ddd";
    }
    if($scope.formData.year1 == null || $scope.formData.year1 == "")  
    {                                                                                                             
        document.getElementById("page8_year1").style.borderColor = "red";
    }else {
        document.getElementById("page8_year1").style.borderColor = "#ddd";
    }
    if($scope.formData.cust2 == null || $scope.formData.cust2 == "")
    {
        document.getElementById("page8_cust2").style.borderColor = "red";
    } else {
        document.getElementById("page8_cust2").style.borderColor = "#ddd";
    }
    if($scope.formData.sale2 == null || $scope.formData.sale2 == "")
    {
        document.getElementById("page8_sale2").style.borderColor = "red";
    } else {
        document.getElementById("page8_sale2").style.borderColor = "#ddd";
    }
    if($scope.formData.year2 == null || $scope.formData.year2 == "")
    {
        document.getElementById("page8_year2").style.borderColor = "red";
    } else {
        document.getElementById("page8_year2").style.borderColor = "#ddd";
    }
    if($scope.formData.cust3 == null || $scope.formData.cust3 == "")
    {
        document.getElementById("page8_cust3").style.borderColor = "red";
    } else {
        document.getElementById("page8_cust3").style.borderColor = "#ddd";
    }
    if($scope.formData.sale3 == null || $scope.formData.sale3 == "")
    {
        document.getElementById("page8_sale3").style.borderColor = "red";
    } else {
        document.getElementById("page8_sale3").style.borderColor = "#ddd";
    }
    if($scope.formData.year3 == null || $scope.formData.year3 == "")
    {
        document.getElementById("page8_year3").style.borderColor = "red";
    } else {
        document.getElementById("page8_year3").style.borderColor = "#ddd";
    }
    if($scope.formData.CashSales == null || $scope.formData.CashSales == "")
    {
        document.getElementById("page8_CashSales").style.borderColor = "red";
    } else {
        document.getElementById("page8_CashSales").style.borderColor = "#ddd";
    }
    if($scope.formData.LoanPurpose == null || $scope.formData.LoanPurpose == "")
    {
        document.getElementById("page8_LoanPurpose").style.borderColor = "red";
    } else {
        document.getElementById("page8_LoanPurpose").style.borderColor = "#ddd";
    }
    if($scope.formData.ReqAmt == null || $scope.formData.ReqAmt == "")
    {
        document.getElementById("page8_ReqAmt").style.borderColor = "red";
    } else {
        document.getElementById("page8_ReqAmt").style.borderColor = "#ddd";
    }
     
    if($scope.formData.cust1 && $scope.formData.sale1 && $scope.formData.year1 && $scope.formData.cust2 && $scope.formData.sale2 && $scope.formData.year2 && $scope.formData.cust3 && $scope.formData.sale3 && $scope.formData.year3 && $scope.formData.CashSales && $scope.formData.LoanPurpose && $scope.formData.ReqAmt)
    {
      $state.go("page9");
    }   
};

    $scope.ValidateFields_page9 = function(){
    if($scope.formData.YesNo == null || $scope.formData.YesNo == "")
    {
        document.getElementById("checkYesNo").style.borderColor = "red";
    }else {
        document.getElementById("checkYesNo").style.borderColor = "#ddd";
         if($scope.formData.YesNo == 'Yes'){
            if($scope.formData.PropType == null || $scope.formData.PropType == "")
            {
                document.getElementById("page9_PropType").style.borderColor = "red";
            }else {
                document.getElementById("page9_PropType").style.borderColor = "#ddd";
            }
            if($scope.formData.ColAddress == null || $scope.formData.ColAddress == "")
            {
                document.getElementById("page9_ColAddress").style.borderColor = "red";
            }else {
                document.getElementById("page9_ColAddress").style.borderColor = "#ddd";
            }
            if($scope.formData.ColCity == null || $scope.formData.ColCity == "")  
            {                                                                                                             
                document.getElementById("page9_ColCity").style.borderColor = "red";
            }else {
                document.getElementById("page9_ColCity").style.borderColor = "#ddd";
            } 
            if($scope.formData.ColPincode == null || $scope.formData.ColPincode == "")
            {
                document.getElementById("page9_ColPincode").style.borderColor = "red";
            } else {
                document.getElementById("page9_ColPincode").style.borderColor = "#ddd";
            }
            if($scope.formData.LatestVal == null || $scope.formData.LatestVal == "")
            {
                document.getElementById("page9_LatestVal").style.borderColor = "red";
            } else {
                document.getElementById("page9_LatestVal").style.borderColor = "#ddd";
            }
            if($scope.formData.CollateralType == null || $scope.formData.CollateralType == "")
            {
                document.getElementById("checkRadioButton3").style.borderColor = "red";
            } else {
                document.getElementById("checkRadioButton3").style.borderColor = "#ddd";
            }
            if($scope.formData.PropType && $scope.formData.ColAddress && $scope.formData.ColCity && $scope.formData.ColPincode && $scope.formData.LatestVal &&
               $scope.formData.CollateralType)
            {

              //$state.go("page10");
              $scope.saveData();
              console.log("Function called");
            }
        }else if($scope.formData.YesNo == 'No')
        {
              //$state.go("page10");
              $scope.saveData();
              console.log("Function called");
        }    
    }
};
    
//File Uploading: Start

    $scope.uploadPic = function(file) {
        
             var file = [];
        for (var i = file.length - 1; i >= 0; i--) 
            file.push(file[i].name);
        
    file.upload = Upload.upload({
       
      url: 'http://smeniwas.com/mobile/s3upload/upload.php',
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      file: file,
    });

    file.upload.then(function (response) {
      $timeout(function () {
        file.result = response.data;
        $scope.statusMsg = response.data;
        alert(response.data);
      });
    }, function (response) {
      if (response.status > 0)
        $scope.errorMsg = response.status + ': ' + response.data;
    });

    file.upload.progress(function (evt) {
      // Math.min is to fix IE which reports 200% sometimes
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
  }
//File Uploading:End

}])// Main Controller

app.config(function($stateProvider, $urlRouterProvider, $httpProvider) {
    
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    
  $stateProvider
    
    .state('page1', {
      url: '/page1',
      templateUrl: 'page1.html'
    })
    
    .state('page2', {
      url: '/page2',
      templateUrl: 'page2.html'
    })
    
    .state('page3', {
      url: '/page3',
      templateUrl: 'page3.html'
    })
    
    .state('page4', {
      url: '/page4',
      templateUrl: 'page4.html'
    })
    
    .state('page5', {
      url: '/page5',
      templateUrl: 'page5.html'
    })
    
    .state('page6', {
      url: '/page6',
      templateUrl: 'page6.html'
    })
    
    .state('page7', {
      url: '/page7',
      templateUrl: 'page7.html'
    })
    .state('page8', {
      url: '/page8',
      templateUrl: 'page8.html'
    })
  .state('page9', {
      url: '/page9',
      templateUrl: 'page9.html'
    })
  .state('page10', {
      url: '/page10',
      templateUrl: 'page10.html'
    })
  .state('page11', {
      url: '/page11',
      templateUrl: 'page11.html'
    })
    ;

  // if none of the above states are matched, use this as the fallback
  
  $urlRouterProvider.otherwise('/page1');
});

app.factory('backcallFactory', ['$state','$ionicPlatform','$ionicHistory','$timeout',function($state,$ionicPlatform,$ionicHistory,$timeout){
 
var obj={}
    obj.backcallfun=function(){
  
       $ionicPlatform.registerBackButtonAction(function () {
          if ($state.current.name == "page1") {
            var action= confirm("Do you want to Exit?");
             if(action){
                navigator.app.exitApp();
              }//no else here just if
      
      }else{
            $ionicHistory.nextViewOptions({
                 disableBack: true
                });
        $state.go('page1');
        //go to home page
     }
        }, 100);//registerBackButton
}//backcallfun
return obj;
}]);

// login controller
app.controller('LoginCtrl', function($scope, $http, $modalInstance, $modal, authentication, $state) {

      $scope.alerts = [
    //{ type: 'fail', msg: 'Invalid Username/Password' },
    //{ type: 'success', msg: 'Login Successfully' }
  ];
    
    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
      };
  $scope.login = function (email, password) {
         $scope.uemail = email;
         $scope.upass = password;
      console.log("$scope.uemail = " + $scope.uemail);
       console.log("$scope.upass = " + $scope.upass);
      
     //var _url = "http://localhost/SMENiwasFOS/checkUser.php"; 
      
     $http.post("http://smeniwas.com/mobile/checkUser.php?uemail=" +  encodeURIComponent($scope.uemail) + "&upass=" +  encodeURIComponent($scope.upass)).success(function(data) {
         //console.log("userdata: " + data);
         if(data == 'Valid'){
              $scope.alerts.push({msg: 'Login successfully'});
              $modalInstance.close();
              $state.go("page2");
         }else {
            //console.log("Invalid username/password combination");
            $scope.alerts.push({msg: 'Invalid Username/Password'});
        }
       });
      
    /*if ( email === 'poojasbhat@gmail.com' && password === 'password') {
  		authentication.isAuthenticated = true;
  		$scope.alerts.push({msg: 'Login Successfully'});
        $modalInstance.close();
        $state.go("page2");
    
    } else {
  		console.log("Invalid username/password combination");
  		$scope.alerts.push({msg: 'Invalid Username/Password'});
    };*/
  };
    
$scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
  
});
