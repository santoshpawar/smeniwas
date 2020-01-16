
function ddlSelectPolicy_Click() {

    var ddlSelectPolicy = $("#ddlSelectPolicy").find(":selected").val();

    if (ddlSelectPolicy == "0") {
        $("#divSuCompanyDetails").hide();
        return false;
    } else if (ddlSelectPolicy == "1") {
        $("#divSuCompanyDetails").show();
        return false;
    }
    else if (ddlSelectPolicy == "2") {
        $("#divSuCompanyDetails").hide();
        return false;
    }
}

function validation_div1(str) {
    var ValFields = new Array();
    var i;
    i = 0;
   // if (str == "Accept") {
       // ValFields[i] = "";
        //        if ($("#txtSMEPAN").val() == "") {
        //            $("#txtSMEPAN").focus();

        //            ValFields[i] += "* User ID (PAN of Company) is mandatory <br />";
        //            
        //            //return false;
        //        }
        //        if ($("#txtNameSME").val() == "") {
        //            $("#txtNameSME").focus();
        //            ValFields[i] += "* Name of SME  is mandatory <br />";
        //        }
        //        if ($("#ddlEntity").val() == 0) {
        //            $('#ddlEntity').focus();
        //            ValFields[i] += "* Type of Entity is mandatory <br />";
        //        }
        //        if ($("#ddlBussiness").val() == 0) {
        //            $('#ddlBussiness').focus();
        //            ValFields[i] += "* Nature of Business is mandatory <br />";
        //        }
        //        if ($("#ddlTypeIndustry").val() == 0) {
        //            $('#ddlTypeIndustry').focus();
        //            ValFields[i] += "* Type of Industry is mandatory <br />";
        //        }
        //        if ($("#txtDetailsofBussiness").val() == "") {
        //            $('#txtDetailsofBussiness').focus();
        //            ValFields[i] += "* Brief Details of Business is mandatory <br />";
        //        }

        //        if ($("#txtRegsAddress1").val() == "") {
        //            $('#txtRegsAddress1').focus();
        //            ValFields[i] += "* Address1 is mandatory <br />";
        //        }

        //        if ($("#txtRegsAddress2").val() == "") {
        //            $('#txtRegsAddress2').focus();
        //            ValFields[i] += "* Address2 is mandatory <br />";
        //        }

        //        if ($("#txtRegsAddress3").val() == "") {
        //            $('#txtRegsAddress3').focus();
        //            ValFields[i] += "* Address3 is mandatory <br />";
        //        }

        //        if ($("#txtCity").val() == "") {
        //            $('#txtCity').focus();
        //            ValFields[i] += "* City is mandatory <br />";
        //        }
        //        
        //        if ($("#txtState").val() == "") {
        //            $('#txtState').focus();
        //            ValFields[i] += "* State is mandatory <br />";
        //        }

        //        if ($("#txtPincode").val() == "") {
        //            $('#txtPincode').focus();
        //            ValFields[i] += "* Pincode is mandatory <br />";
        //        }
//        var mobval = $("#txtRegMobileNo").val();
//        if ($("#txtRegMobileNo").val() == "") {
//            $('#txtRegMobileNo').focus();
//            ValFields[i] += "* Mobile No is mandatory <br />";
//        } else if (mobval.length < 10) {
//            $('#txtRegMobileNo').focus();
//            ValFields[i] += "* Mobile No should be 10 digit <br />";
//        }
//        if ($("#txtRegLandlineNo").val() == "") {
//            $('#txtRegLandlineNo').focus();
//            ValFields[i] += "* STD code & Landline No is mandatory <br />";
//        }

//    }

//    if (ValFields[i] != "") {
//        DisplayMessage(ValFields);
//    } else {
        showTab('Div2'); return true;
  //  }


}

function validation_div2(str) {
    var ValFields = new Array();
    var i;
    i = 0;
//    if (str == "Accept") {
//        ValFields[i] = "";
        //        if ($("#txtPromoterName").val() == "") {
        //            $('#txtPromoterName').focus();
        //            ValFields[i] += "* Main Promoter/Owner name is mandatory <br />";
        //            //return false;
        //        }


//        if ($("#txtEmailID").val() == "") {
//            $('#txtEmailID').focus();
//            ValFields[i] += "* Email ID is mandatory <br />";
//        } else if (CheckEMail($("#txtEmailID"), false) == false) {
//            ValFields[i] += "* Enter a valid Email ID eg. test@gmail.com";

//        }
        //        if ($("#txtPramoterMobileNo").val() == "") {
        //            $('#txtPramoterMobileNo').focus();
        //            ValFields[i] += "* Contact No is mandatory <br />";
        //        }
//    }

//    if (ValFields[i] != "") {
//        DisplayMessage(ValFields);
//    } else {
        showTab('Div3'); return true;
    //}
}


function validation_div3(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {
    //        ValFields[i] = "";
    //        if ($("#txtDateIncorporation").val() == "") {
    //            $('#txtDateIncorporation').focus();
    //            ValFields[i] += "* Date of Incorporation is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtTAN").val() == "") {
    //            $('#txtTAN').focus();
    //            ValFields[i] += "* TAN is mandatory <br />";
    //        }
    //        if ($("#txtServiceTaxNo").val() == "") {
    //            $('#txtServiceTaxNo').focus();
    //            ValFields[i] += "* Service Tax Number is mandatory <br />";
    //        }
    //        if ($("#txtVATNumber").val() == "") {
    //            $('#txtVATNumber').focus();
    //            ValFields[i] += "* VAT Number is mandatory <br />";
    //        }
    //        if ($("#txtTurnOver1stYr").val() == "") {
    //            $('#txtTurnOver1stYr').focus();
    //            ValFields[i] += "* Turnover in Lakhs is mandatory <br />";
    //        }
    //        if ($("#txtTurnOver2ndYr").val() == "") {
    //            $('#txtTurnOver2ndYr').focus();
    //            ValFields[i] += "* Turnover in Lakhs is mandatory <br />";
    //        }
    //        if ($("#txtTurnOver3rdYr").val() == "") {
    //            $('#txtTurnOver3rdYr').focus();
    //            ValFields[i] += "* Turnover in Lakhs is mandatory <br />";
    //        }
    //        if ($("#txtGrossFixed").val() == "") {
    //            $('#txtGrossFixed').focus();
    //            ValFields[i] += "* Value of Gross Fixed Assets is mandatory <br />";
    //        }
    //        if ($("#txtPlantMachinery").val() == "") {
    //            $('#txtPlantMachinery').focus();
    //            ValFields[i] += "* Value of Plant & Machinery / Equipment is mandatory <br />";
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {
    showTab('Div4'); return true;
    //}
}
