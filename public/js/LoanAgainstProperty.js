function ddlOwner_Click() {

    var ddlOwner = $("#ddlOwner").find(":selected").val();
    if (ddlOwner == "") {
        $("#divThirdParty").hide();
        return false;
    } else if (ddlOwner == "0") {
        $("#divThirdParty").hide();
        return false;
    } else if (ddlOwner == "1") {

        $("#divThirdParty").show();
        return false;
    }
}
function ddlTypeLoan_Click() {

    var ddlTypeLoan = $("#ddlTypeLoan").find(":selected").val();
    //alert(ddlTypeLoan);
    if (ddlTypeLoan == "") {
        $("#divWC").hide();
        $("#divTermLoan").hide();
        return false;
    } else if (ddlTypeLoan == "0") {
        $("#divWC").show();
        $("#divTermLoan").hide();
        return false;
    } else if (ddlTypeLoan == "1") {

        $("#divTermLoan").show();
        $("#divWC").hide();
        return false;
    }
}
function ddlTypeLoan2_Click() {

    var ddlTypeLoan2 = $("#ddlTypeLoan2").find(":selected").val();
    //alert(ddlTypeLoan);
    if (ddlTypeLoan2 == "") {
        $("#divWC2").hide();
        $("#divTermLoan2").hide();
        return false;
    } else if (ddlTypeLoan2 == "0") {
        $("#divWC2").show();
        $("#divTermLoan2").hide();
        return false;
    } else if (ddlTypeLoan2 == "1") {

        $("#divTermLoan2").show();
        $("#divWC2").hide();
        return false;
    }
}

function ddlTypeLoan3_Click() {

    var ddlTypeLoan3 = $("#ddlTypeLoan3").find(":selected").val();
    //alert(ddlTypeLoan);
    if (ddlTypeLoan3 == "") {
        $("#divWC3").hide();
        $("#divTermLoan3").hide();
        return false;
    } else if (ddlTypeLoan3 == "0") {
        $("#divWC3").show();
        $("#divTermLoan3").hide();
        return false;
    } else if (ddlTypeLoan3 == "1") {

        $("#divTermLoan3").show();
        $("#divWC3").hide();
        return false;
    }
}

function ddlTypeLoan4_Click() {

    var ddlTypeLoan4 = $("#ddlTypeLoan4").find(":selected").val();
    //alert(ddlTypeLoan);
    if (ddlTypeLoan4 == "") {
        $("#divWC4").hide();
        $("#divTermLoan4").hide();
        return false;
    } else if (ddlTypeLoan4 == "0") {
        $("#divWC4").show();
        $("#divTermLoan4").hide();
        return false;
    } else if (ddlTypeLoan4 == "1") {

        $("#divTermLoan4").show();
        $("#divWC4").hide();
        return false;
    }
}
function ddlTypeLoan5_Click() {

    var ddlTypeLoan5 = $("#ddlTypeLoan5").find(":selected").val();
    //alert(ddlTypeLoan);
    if (ddlTypeLoan5 == "") {
        $("#divWC5").hide();
        $("#divTermLoan5").hide();
        return false;
    } else if (ddlTypeLoan5 == "0") {
        $("#divWC5").show();
        $("#divTermLoan5").hide();
        return false;
    } else if (ddlTypeLoan5 == "1") {

        $("#divTermLoan5").show();
        $("#divWC5").hide();
        return false;
    }
}

function ddlLender1_Click() {
    var ddlLender1 = $("#ddlLender1").find(":selected").val();
    if (ddlLender1 == "0") {
        $("#lblLenderName1").html("");
        return false;
    } else if (ddlLender1 == "1") {
        $("#lblLenderName1").html("Bank");
        return false;
    } else if (ddlLender1 == "2") {
        $("#lblLenderName1").html("NBFC");
        return false;
    } else if (ddlLender1 == "3") {
        $("#lblLenderName1").html("Others");
        return false;
    }
}

function ddlLender2_Click() {
    var ddlLender2 = $("#ddlLender2").find(":selected").val();
    if (ddlLender2 == "0") {
        $("#lblLenderName2").html("");
        return false;
    } else if (ddlLender2 == "1") {
        $("#lblLenderName2").html("Bank");
        return false;
    } else if (ddlLender2 == "2") {
        $("#lblLenderName2").html("NBFC");
        return false;
    } else if (ddlLender2 == "3") {
        $("#lblLenderName2").html("Others");
        return false;
    }
}

function ddlLender3_Click() {
    var ddlLender3 = $("#ddlLender3").find(":selected").val();
    if (ddlLender3 == "0") {
        $("#lblLenderName3").html("");
        return false;
    } else if (ddlLender3 == "1") {
        $("#lblLenderName3").html("Bank");
        return false;
    } else if (ddlLender3 == "2") {
        $("#lblLenderName3").html("NBFC");
        return false;
    } else if (ddlLender3 == "3") {
        $("#lblLenderName3").html("Others");
        return false;
    }
}
function ddlLender4_Click() {
    var ddlLender4 = $("#ddlLender4").find(":selected").val();
    if (ddlLender4 == "0") {
        $("#lblLenderName5").html("");
        return false;
    } else if (ddlLender4 == "1") {
        $("#lblLenderName4").html("Bank");
        return false;
    } else if (ddlLender4 == "2") {
        $("#lblLenderName4").html("NBFC");
        return false;
    } else if (ddlLender4 == "3") {
        $("#lblLenderName4").html("Others");
        return false;
    }
}

function ddlLender5_Click() {
    var ddlLender5 = $("#ddlLender5").find(":selected").val();
    if (ddlLender5 == "0") {
        $("#lblLenderName5").html("");
        return false;
    } else if (ddlLender5 == "1") {
        $("#lblLenderName5").html("Bank");
        return false;
    } else if (ddlLender5 == "2") {
        $("#lblLenderName5").html("NBFC");
        return false;
    } else if (ddlLender5 == "3") {
        $("#lblLenderName5").html("Others");
        return false;
    }
}



function ShowPropertyDetails() {
    var ddlProperty = $("#ddlProperty").find(":selected").val();
    if (ddlProperty == "0") {
        $("#divType").hide();
    } else if (ddlProperty == "1") {
        $("#divType").show();
        $("#ddlCommercialType").show();
        $("#ddlResidentialType").hide();
        $("#ddlLandNonAgriType").hide();
    } else if (ddlProperty == "2") {
        $("#divType").show();
        $("#ddlResidentialType").show();
        $("#ddlCommercialType").hide();
        $("#ddlCommercialType").hide();
        $("#ddlLandNonAgriType").hide();
    } else if (ddlProperty == "3") {
        $("#divType").hide();
        $("#ddlCommercialType").hide();
        $("#ddlResidentialType").hide();
        $("#ddlLandNonAgriType").hide();
    } else if (ddlProperty == "4") {
        $("#divType").show();
        $("#ddlLandNonAgriType").show();
        $("#ddlCommercialType").hide();
        $("#ddlResidentialType").hide();
    } else if (ddlProperty == "5") {
        $("#divType").hide();
        $("#ddlCommercialType").hide();
        $("#ddlResidentialType").hide();
        $("#ddlLandNonAgriType").hide();
    }
}

//Adding & removing Existing Lender Details
function ShowdivLender2() {
    $("#divLender2").show();
    return false;
}
function RemovedivLender2() {
    $("#divLender2").hide();
    return false;
}

function ShowdivLender3() {
    $("#divLender3").show();
    return false;
}
function RemovedivLender3() {
    $("#divLender3").hide();
    return false;
}

function ShowdivLender4() {
    $("#divLender4").show();
    return false;
}
function RemovedivLender4() {
    $("#divLender4").hide();
    return false;
}

function ShowdivLender5() {
    $("#divLender5").show();
    return false;
}
function RemovedivLender5() {
    $("#divLender5").hide();
    return false;
}

//Adding & removing Promoters / Directors Details
function ShowdivPDetails2() {

    $("#divPDetails2").show();
    return false;
}
function RemovedivPDetails2() {
    $("#divPDetails2").hide();
    return false;
}
function ShowdivPDetails3() {
    $("#divPDetails3").show();
    return false;
}
function RemovedivPDetails3() {
    $("#divPDetails3").hide();
    return false;
}
function ShowdivPDetails4() {
    $("#divPDetails4").show();
    return false;
}
function RemovedivPDetails4() {
    $("#divPDetails4").hide();
    return false;
}

//Adding & removing Promoters/ Directors Networth Certificate
function ShowdivPCertificate2() {

    $("#divPCertificate2").show();
    return false;
}
function RemovedivPCertificate2() {
    $("#divPCertificate2").hide();
    return false;
}
function ShowdivPCertificate3() {
    $("#divPCertificate3").show();
    return false;
}
function RemovedivPCertificate3() {
    $("#divPCertificate3").hide();
    return false;
}
function ShowdivPCertificate4() {
    $("#divPCertificate4").show();
    return false;
}
function RemovedivPCertificate4() {
    $("#divPCertificate4").hide();
    return false;
}

//Adding & removing Promoters KYC Documents
function ShowdivPKYCDoc2() {

    $("#divPKYCDoc2").show();
    return false;
}
function RemovedivPKYCDoc2() {
    $("#divPKYCDoc2").hide();
    return false;
}
function ShowdivPKYCDoc3() {
    $("#divPKYCDoc3").show();
    return false;
}
function RemovedivPKYCDoc3() {
    $("#divPKYCDoc3").hide();
    return false;
}
function ShowdivPKYCDoc4() {
    $("#divPKYCDoc4").show();
    return false;
}
function RemovedivPKYCDoc4() {
    $("#divPKYCDoc4").hide();
    return false;
}

function ddlYesNo_Click() {

    var ddlYesNo = $("#ddlYesNo").find(":selected").val();

    if (ddlYesNo == "0") {
        $("#divBalanYR1213").hide();
        $("#divPLYR1213").hide();

        return false;
    } else if (ddlYesNo == "1") {
        $("#divBalanYR1213").show();
        $("#divBalanYR1213").find("input").attr("disabled", "disabled");
        DisplayMessage("Please move to next FY.");

        $("#divPLYR1213").show();
        $("#divPLYR1213").find("input").attr("disabled", "disabled");
        return false;
    } else if (ddlYesNo == "2") {
        $("#divBalanYR1213").show();
        $("#divBalanYR1213").find("input").removeAttr("disabled");

        $("#divPLYR1213").show();
        $("#divPLYR1213").find("input").removeAttr("disabled");
        return false;
    }
}

function ddlYesNoYr1112_Click() {

    var ddlYesNoYr1112 = $("#ddlYesNoYr1112").find(":selected").val();

    if (ddlYesNoYr1112 == "0") {
        $("#divBalanYR1112").hide();
        $("#divPLYR1112").hide();
        return false;
    } else if (ddlYesNoYr1112 == "1") {
        $("#divBalanYR1112").show();
        $("#divBalanYR1112").find("input").attr("disabled", "disabled");
        DisplayMessage("Please move to next FY.");

        $("#divPLYR1112").show();
        $("#divPLYR1112").find("input").attr("disabled", "disabled");
        return false;
    } else if (ddlYesNoYr1112 == "2") {
        $("#divBalanYR1112").show();
        $("#divBalanYR1112").find("input").removeAttr("disabled");

        $("#divPLYR1112").show();
        $("#divPLYR1112").find("input").removeAttr("disabled");
        return false;
    }
}

function ddlYesNoYr1011_Click() {

    var ddlYesNoYr1011 = $("#ddlYesNoYr1011").find(":selected").val();

    if (ddlYesNoYr1011 == "0") {
        $("#divBalanYR1011").hide();
        $("#divPLYR1011").hide();
        return false;
    } else if (ddlYesNoYr1011 == "1") {
        $("#divBalanYR1011").show();
        $("#divBalanYR1011").find("input").attr("disabled", "disabled");
        DisplayMessage("Please move to next FY.");

        $("#divPLYR1011").show();
        $("#divPLYR1011").find("input").attr("disabled", "disabled");
        return false;
    } else if (ddlYesNoYr1011 == "2") {
        $("#divBalanYR1011").show();
        $("#divBalanYR1011").find("input").removeAttr("disabled");

        $("#divPLYR1011").show();
        $("#divPLYR1011").find("input").removeAttr("disabled");

        return false;
    }
}

function validation_div9(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {

    //        ValFields[i] = "";
    //        if ($("#txtLoanAmount").val() == "") {
    //            $("#txtLoanAmount").focus();
    //            ValFields[i] += "* Loan Amount is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#ddlTenur").val() == 0) {
    //            $('#ddlTenur').focus();
    //            ValFields[i] += "* Tenure in Year  is mandatory <br />";
    //        }

    //        if ($("#txtMnthLoanEMI").val() == "") {
    //            $('#txtMnthLoanEMI').focus();
    //            ValFields[i] += "* Monthly EMI for existing Loan is mandatory <br />";
    //        }

    //        if ($("#txtMaxiEMI").val() == "") {
    //            $('#txtMaxiEMI').focus();
    //            ValFields[i] += "* Maximum addtional EMI Serviceable is mandatory <br />";
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {
    showTab('Div1'); return true;
    //}


}

function validation_div1(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {

    //        ValFields[i] = "";
    //        if ($("#txtLoanAmount").val() == "") {
    //            $("#txtLoanAmount").focus();
    //            ValFields[i] += "* Loan Amount is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#ddlTenur").val() == 0) {
    //            $('#ddlTenur').focus();
    //            ValFields[i] += "* Tenure in Year  is mandatory <br />";
    //        }

    //        if ($("#txtMnthLoanEMI").val() == "") {
    //            $('#txtMnthLoanEMI').focus();
    //            ValFields[i] += "* Monthly EMI for existing Loan is mandatory <br />";
    //        }

    //        if ($("#txtMaxiEMI").val() == "") {
    //            $('#txtMaxiEMI').focus();
    //            ValFields[i] += "* Maximum addtional EMI Serviceable is mandatory <br />";
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
    //        if ($("#ddlProperty").val() == "") {
    //            $('#ddlProperty').focus();
    //            ValFields[i] += "* Details of Property is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtApproxValuation").val() == "") {
    //            $('#txtApproxValuation').focus();
    //            ValFields[i] += "* Approx Valuation is mandatory <br />";
    //        }

    //        if ($("#txtAddress1").val() == "") {
    //            $('#txtAddress1').focus();
    //            ValFields[i] += "* Address 1 is mandatory <br />";
    //        }

    //        if ($("#txtAddress2").val() == "") {
    //            $('#txtAddress2').focus();
    //            ValFields[i] += "* Address 2 is mandatory <br />";
    //        }
    //        if ($("#txtAddress3").val() == "") {
    //            $('#txtAddress3').focus();
    //            ValFields[i] += "* Address 3 is mandatory <br />";
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
    //        if ($("#ddlOwner").val() == "") {
    //            $('#ddlOwner').focus();
    //            ValFields[i] += "* Details of owner is mandatory <br />";
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
    //        if ($("#ddlLender1").val() == 0) {
    //            $('#ddlLender1').focus();
    //            ValFields[i] += "* Lender Details is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtBankName").val() == "") {
    //            $('#txtBankName').focus();
    //            ValFields[i] += "* Lender Name is mandatory <br />";
    //        }
    //        if ($("#txtAmountOutstanding").val() == "") {
    //            $('#txtAmountOutstanding').focus();
    //            ValFields[i] += "* Amount Outstanding is mandatory <br />";
    //        }
    //        if ($("#txtROI").val() == "") {
    //            $('#txtROI').focus();
    //            ValFields[i] += "* ROI is mandatory <br />";
    //        }
    //        if ($("#ddlTypeLoan").val() == "") {
    //            $('#ddlTypeLoan').focus();
    //            ValFields[i] += "* Type of Loan is mandatory <br />";
    //        }

    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {
    alert("Please check after 48 hours.");
    showTab('Div4');
    return true;
    // }
}

function validation_div4(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {
    //        ValFields[i] = "";
    //        if ($("#txtNetworth01").val() == 0) {
    //            $('#txtNetworth01').focus();
    //            ValFields[i] += "* FY 2012-13 Networth is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtTotalDebt01").val() == "") {
    //            $('#txtTotalDebt01').focus();
    //            ValFields[i] += "* FY 2012-13 Total Debt is mandatory <br />";
    //        }
    //        if ($("#txtTermDebt01").val() == "") {
    //            $('#txtTermDebt01').focus();
    //            ValFields[i] += "* FY 2012-13 Term Debt is mandatory <br />";
    //        }
    //        if ($("#txtDebtors01").val() == "") {
    //            $('#txtDebtors01').focus();
    //            ValFields[i] += "* FY 2012-13 Debtors is mandatory <br />";
    //        }
    //        if ($("#txtInventory01").val() == "") {
    //            $('#txtInventory01').focus();
    //            ValFields[i] += "* FY 2012-13 Inventory is mandatory <br />";
    //        }
    //        if ($("#txtCreditors01").val() == "") {
    //            $('#txtCreditors01').focus();
    //            ValFields[i] += "* FY 2012-13 Creditors is mandatory <br />";
    //        }
    //        if ($("#txtNetFixedAssets01").val() == "") {
    //            $('#txtNetFixedAssets01').focus();
    //            ValFields[i] += "* FY 2012-13 Net Fixed Assets is mandatory <br />";
    //        }

    //        if ($("#txtNetworth02").val() == 0) {
    //            $('#txtNetworth02').focus();
    //            ValFields[i] += "* FY 2011-12 Networth is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtTotalDebt02").val() == "") {
    //            $('#txtTotalDebt02').focus();
    //            ValFields[i] += "* FY 2011-12 Total Debt is mandatory <br />";
    //        }
    //        if ($("#txtTermDebt02").val() == "") {
    //            $('#txtTermDebt02').focus();
    //            ValFields[i] += "* FY 2011-12 Term Debt is mandatory <br />";
    //        }
    //        if ($("#txtDebtors02").val() == "") {
    //            $('#txtDebtors02').focus();
    //            ValFields[i] += "* FY 2011-12 Debtors is mandatory <br />";
    //        }
    //        if ($("#txtInventory02").val() == "") {
    //            $('#txtInventory02').focus();
    //            ValFields[i] += "* FY 2011-12 Inventory is mandatory <br />";
    //        }
    //        if ($("#txtCreditors01").val() == "") {
    //            $('#txtCreditors01').focus();
    //            ValFields[i] += "* FY 2011-12 Creditors is mandatory <br />";
    //        }
    //        if ($("#txtNetFixedAssets02").val() == "") {
    //            $('#txtNetFixedAssets02').focus();
    //            ValFields[i] += "* FY 2011-12 Net Fixed Assets is mandatory <br />";
    //        }

    //        if ($("#txtNetworth03").val() == 0) {
    //            $('#txtNetworth03').focus();
    //            ValFields[i] += "* FY 2010-11 Networth is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtTotalDebt03").val() == "") {
    //            $('#txtTotalDebt03').focus();
    //            ValFields[i] += "* FY 2010-11 Total Debt is mandatory <br />";
    //        }
    //        if ($("#txtTermDebt03").val() == "") {
    //            $('#txtTermDebt03').focus();
    //            ValFields[i] += "* FY 2010-11 Term Debt is mandatory <br />";
    //        }
    //        if ($("#txtDebtors03").val() == "") {
    //            $('#txtDebtors03').focus();
    //            ValFields[i] += "* FY 2010-11 Debtors is mandatory <br />";
    //        }
    //        if ($("#txtInventory03").val() == "") {
    //            $('#txtInventory03').focus();
    //            ValFields[i] += "* FY 2010-11 Inventory is mandatory <br />";
    //        }
    //        if ($("#txtCreditors03").val() == "") {
    //            $('#txtCreditors03').focus();
    //            ValFields[i] += "* FY 2010-11 Creditors is mandatory <br />";
    //        }
    //        if ($("#txtNetFixedAssets03").val() == "") {
    //            $('#txtNetFixedAssets03').focus();
    //            ValFields[i] += "* FY 2010-11 Net Fixed Assets is mandatory <br />";
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {

    showTab('Div5');
    return true;
    //}
}

function validation_div5(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {
    //        ValFields[i] = "";
    //        if ($("#txtRevenue01").val() == 0) {
    //            $('#txtRevenue01').focus();
    //            ValFields[i] += "* FY 2012-13 Revenue is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtEBITDAOperating01").val() == "") {
    //            $('#txtEBITDAOperating01').focus();
    //            ValFields[i] += "* FY 2012-13 EBITDA/Operating Profit is mandatory <br />";
    //        }
    //        if ($("#txtProfit01").val() == "") {
    //            $('#txtProfit01').focus();
    //            ValFields[i] += "* FY 2012-13 Interest Expense is mandatory <br />";
    //        }
    //        if ($("#txtPAT01").val() == "") {
    //            $('#txtPAT01').focus();
    //            ValFields[i] += "* FY 2012-13 PAT is mandatory <br />";
    //        }

    //        if ($("#txtRevenue02").val() == 0) {
    //            $('#txtRevenue02').focus();
    //            ValFields[i] += "* FY 2011-12 Revenue is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtEBITDAOperating02").val() == "") {
    //            $('#txtEBITDAOperating02').focus();
    //            ValFields[i] += "* FY 2011-12 EBITDA/Operating Profit is mandatory <br />";
    //        }
    //        if ($("#txtProfit02").val() == "") {
    //            $('#txtProfit02').focus();
    //            ValFields[i] += "* FY 2011-12 Interest Expense is mandatory <br />";
    //        }
    //        if ($("#txtPAT02").val() == "") {
    //            $('#txtPAT02').focus();
    //            ValFields[i] += "* FY 2011-12 PAT is mandatory <br />";
    //        }

    //        if ($("#txtRevenue03").val() == 0) {
    //            $('#txtRevenue03').focus();
    //            ValFields[i] += "* FY 2010-11 Revenue is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtEBITDAOperating03").val() == "") {
    //            $('#txtEBITDAOperating03').focus();
    //            ValFields[i] += "* FY 2010-11 EBITDA/Operating Profit is mandatory <br />";
    //        }
    //        if ($("#txtProfit03").val() == "") {
    //            $('#txtProfit03').focus();
    //            ValFields[i] += "* FY 2010-11 Interest Expense is mandatory <br />";
    //        }
    //        if ($("#txtPAT03").val() == "") {
    //            $('#txtPAT03').focus();
    //            ValFields[i] += "* FY 2010-11 PAT is mandatory <br />";
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {

    showTab('Div6');
    return true;
    //}
}

function validation_div6(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {
    //        ValFields[i] = "";
    //        if ($("#fuLatestIT").val() == "") {
    //            $('#fuLatestIT').focus();
    //            ValFields[i] += "* Upload Latest IT return is mandatory <br />";
    //            //return false;
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {
    alert("Please check after 48 hours.");
    showTab('Div7');
    return true;
    //}
}

function validation_div7(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {
    //        ValFields[i] = "";
    //        if ($("#txtName").val() == "") {
    //            $('#txtName').focus();
    //            ValFields[i] += "* Promoters / Directors Name is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtPANNo").val() == "") {
    //            $('#txtPANNo').focus();
    //            ValFields[i] += "* PAN of Promoter / Director is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtDIN").val() == "") {
    //            $('#txtDIN').focus();
    //            ValFields[i] += "* Director Identification Number (DIN) is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#txtNoCompanies").val() == "") {
    //            $('#txtNoCompanies').focus();
    //            ValFields[i] += "* No of Companies directorship is mandatory <br />";
    //            //return false;
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {

    showTab('Div8');
    return true;
    //}
}
function validation_div8(str) {
    var ValFields = new Array();
    var i;
    i = 0;
    //    if (str == "Accept") {
    //        ValFields[i] = "";
    //        if ($("#fuLatestAudited").val() == "") {
    //            $('#fuLatestAudited').focus();
    //            ValFields[i] += "* Upload Latest Audited Annual Report is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#fuAccStatement").val() == "") {
    //            $('#fuAccStatement').focus();
    //            ValFields[i] += "* Upload 6 months bank account statement of company is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#fuPanofCopy").val() == "") {
    //            $('#fuPanofCopy').focus();
    //            ValFields[i] += "* Upload PAN of Company is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#fuKYCDoc").val() == "") {
    //            $('#fuKYCDoc').focus();
    //            ValFields[i] += "*  Upload PAN of Promoter/ Director is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#ddlAddress").val() == 0) {
    //            $('#ddlAddress').focus();
    //            ValFields[i] += "* Select Proof of Address is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#fuAddressProof").val() == "") {
    //            $('#fuAddressProof').focus();
    //            ValFields[i] += "* Upload Proof of Address is mandatory <br />";
    //            //return false;
    //        }
    //        if ($("#fuCertificate1").val() == "") {
    //            $('#fuCertificate1').focus();
    //            ValFields[i] += "* Upload Promoters Networth Certificate is mandatory <br />";
    //            //return false;
    //        }
    //    }

    //    if (ValFields[i] != "") {
    //        DisplayMessage(ValFields);
    //    } else {
    alert("Please check after 48 hours.");
    window.open("SME_ViewLogin.html", "_self");

    return true;
    //}
}