function validation_div1(str) {
    var ValFields = new Array();
    var i;
    i = 0;
//    if (str == "Accept") {
//        ValFields[i] = "";
//        if ($("#txtSMEPAN").val() == "") {
//            $('#txtSMEPAN').focus();
//            ValFields[i] += "* User ID (PAN of Company) is mandatory <br />";
//            //return false;
//        }
//        if ($("#txtNameSME").val() == "") {
//            $('#txtNameSME').focus();
//            ValFields[i] += "* Name of SME  is mandatory <br />";
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

//        if ($("#txtState").val() == "") {
//            $('#txtState').focus();
//            ValFields[i] += "* State is mandatory <br />";
//        }

//        if ($("#txtPincode").val() == "") {
//            $('#txtPincode').focus();
//            ValFields[i] += "* Pincode is mandatory <br />";
//        }
//    }

//    if (ValFields[i] != "") {
//        DisplayMessage(ValFields);
//    } else {
        showTab('Div2'); return true;
    //}


}

function validation_div2(str) {
    var ValFields = new Array();
    var i;
    i = 0;
//    if (str == "Accept") {
//        ValFields[i] = "";
//        if ($("#txtContactPersonName").val() == "") {
//            $('#txtContactPersonName').focus();
//            ValFields[i] += "* Contact Person name is mandatory <br />";
//            //return false;
//        }
//        if ($("#txtEmailID").val() == "") {
//            $('#txtEmailID').focus();
//            ValFields[i] += "* Email ID is mandatory <br />";
//        }
//        if ($("#txtMobileNo").val() == "") {
//            $('#txtMobileNo').focus();
//            ValFields[i] += "* Mobile No is mandatory <br />";
//        }
//        if ($("#txLandlineNo").val() == "") {
//            $('#txLandlineNo').focus();
//            ValFields[i] += "* STD code & Landline No is mandatory <br />";
//        }

//    }

//    if (ValFields[i] != "") {
//        DisplayMessage(ValFields);
//    } else {
        return false;
    //}

}