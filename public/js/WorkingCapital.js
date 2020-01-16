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

function ShowDiv3() {
    alert("Please check after 48 hours.");
    showTab('Div3');
    return false;
}

function ShowDiv8() {
    alert("Please check after 48 hours.");
    showTab('Div8');
    return false;
}
function ClosePage() {
    alert("Please check after 48 hours.");
    window.open("SME_ViewLogin.html", "_self");
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