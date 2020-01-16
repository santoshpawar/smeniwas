/* 
Common client side Validation will be added here Any function added will be mentioned here

Function list:
1.pad
2.AllowDecimalUnits
3.AllowDecimalAmount
4.isInteger
5.isDate
6.UsrCompareDate
7.CheckBlank
8.CheckDate
9.validateKeyPress
10.NumericValidation
11.IsAlphNumeric
12.UsrKeyPressLong
13.UsrKeyPressUnsignedLong
14.UsrKeyPressDouble
15.UsrKeyPressUnsignedDouble
16.CheckEMail
17.IfitemSelected
18.ValidateDateSelection
19.ValidationMessageContainer
20.validatePan
21.IsAlphabet
22.IsRestrictBlklist
*/


var dtCh = "-";
var minYear = 1800;
var maxYear = 2500;
function daysInFebruary(year) {
    return (((year % 4 == 0) && ((!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28);
}

function pad(number, length) {

    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }

    return str;

}

function DaysArray(n) {
    for (var i = 1; i <= n; i++) {
        this[i] = 31;
        if (i == 4 || i == 6 || i == 9 || i == 11)
            this[i] = 30;
        if (i == 2)
            this[i] = 29;
    }
    return this;
}
function AllowDecimalUnits(evt, obj) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    var txt = document.getElementById(obj.id).value;
    var posdot = txt.lastIndexOf('.');
    var max = txt.substring(posdot, txt.length);

    if (posdot > -1 && max.length > 3)
        return false;

    if (charCode == 46) {
        if (posdot > -1)
            return false;
    }
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
function AllowDecimalAmount(evt, obj) {

    var charCode = (evt.which) ? evt.which : event.keyCode
    var txt = document.getElementById(obj.id).value;
    var posdot = txt.lastIndexOf('.');
    var max = txt.substring(posdot, txt.length);

    //    if (posdot > -1 && max.length > 2)
    //        return false;

    if (charCode == 46) {
        if (posdot > -1)
            return false;
    }
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}



function isInteger(s) {
    var i;
    for (i = 0; i < s.length; i++) {
        var c = s.charAt(i);
        if (c < "0" || c > "9")
            return false;
    }
    return true;
}



function UsrCompareDate(dt1, dt2) {
    var pos1 = dt1.indexOf(dtCh);
    var pos2 = dt1.indexOf(dtCh, pos1 + 1);
    var ndt1 = UsrPadZeros(dt1.substring(pos2 + 1), 4) + UsrPadZeros(dt1.substring(pos1 + 1, pos2), 2) + UsrPadZeros(dt1.substring(0, pos1), 2);
    pos1 = dt2.indexOf(dtCh);
    pos2 = dt2.indexOf(dtCh, pos1 + 1);
    var ndt2 = UsrPadZeros(dt2.substring(pos2 + 1), 4) + UsrPadZeros(dt2.substring(pos1 + 1, pos2), 2) + UsrPadZeros(dt2.substring(0, pos1), 2);
    return (parseInt(ndt1) - parseInt(ndt2));
}
function isDate(dtStr) {
    var daysInMonth = DaysArray(12);
    var pos1 = dtStr.indexOf(dtCh);
    var pos2 = dtStr.indexOf(dtCh, pos1 + 1);
    var strDay = dtStr.substring(0, pos1);
    var strMonth = dtStr.substring(pos1 + 1, pos2);
    var strYear = dtStr.substring(pos2 + 1);
    strYr = strYear;
    if (strDay.charAt(0) == "0" && strDay.length > 1)
        strDay = strDay.substring(1);
    if (strMonth.charAt(0) == "0" && strMonth.length > 1)
        strMonth = strMonth.substring(1);
    for (var i = 1; i <= 3; i++) {
        if (strYr.charAt(0) == "0" && strYr.length > 1)
            strYr = strYr.substring(1);
    }

    month = parseInt(strMonth);
    day = parseInt(strDay);
    year = parseInt(strYr);

    if (pos1 == -1 || pos2 == -1) {

        if (dtCh == "-") {
            //alert("The date format should be : dd-mm-yyyy");
        }
        else {
            //alert("The date format should be : dd/mm/yyyy");
        }
        return false;
    }

    if (strDay.length < 1 || day < 1 || day > 31 || (month == 2 && day > daysInFebruary(year)) || day > daysInMonth[month]) {
        //alert("Please enter a valid day");
        return false;
    }
    if (strMonth.length < 1 || month < 1 || month > 12) {
        //alert("Please enter a valid month");
        return false;
    }

    if (strYear.length != 4 || year == 0 || year < minYear || year > maxYear) {
        //alert("Please enter a valid 4 digit year between " + minYear + " and " + maxYear);
        return false;
    }

    //    if (dtStr.indexOf(dtCh, pos2 + 1) != -1 || isInteger(stripCharsInBag(dtStr, dtCh)) == false) {
    //        //alert("Please enter a valid date");
    //        return false;
    //    }
    return true;
}
function CheckBlank(item, bAlert) {
    var strErrorMsg = "Please enter the " + (typeof (item.displayname) == "undefined" ? "field" : item.displayname);
    item.value = item.value.trim();
    if (item.value.length == 0) {
        item.focus();
        if (bAlert)
            alert(strErrorMsg);
        return false;
    }
    return true;
}

function CheckDate(item) {
    if (!isDate(item.value)) {
        item.focus();
        return false;
    }
    return true;
}

function validateKeyPress(e) {
    var key;
    var target;

    if (e.which) {
        key = e.which;
        target = e.target;
    }
    else {
        key = e.keyCode;
        target = e.srcElement;
    }

    if (target.disabled == true) {
        return (false);
    }
    if (target.double == true) {
        key = UsrKeyPressDouble(target.value, key);
        if (key == 0)
            return (false);
    }
    else if (target.unsigneddouble == true) {
        key = UsrKeyPressUnsignedDouble(target.value, key);
        if (key == 0)
            return (false);
    }
    else if (target.long == true) {

        key = UsrKeyPressLong(target.value, key);
        if (key == 0)
            return (false);
    }
    else if (target.unsignedlong == true) {
        key = UsrKeyPressUnsignedLong(target.value, key);
        if (key == 0)
            return (false);
    }
    else if (target.date == true) {
        if (!((key >= 48 && key <= 57) || (String.fromCharCode(key) == dtCh)))
            return (false);
    }

    return (true);
}

function NumericValidation() {
    //alert('hi');
    if (event.keyCode) //For IE
        keycode = event.keyCode;
    else if (event.Which)
        keycode = event.Which;  // For FireFox
    else
        keycode = event.charCode; // Other Browser

    if (keycode != 8) //if the key is the backspace key
    {
        if (keycode < 48 || keycode > 57) //if not a number
            return false; // disable key press
        else
            return true; // enable key press
    }
}
/* Non event based Alphabet  validation*/
function IsAlphabet(str) {
    var key;
    key = str.charCodeAt(0);

    // Other Browser
    //	alert(" key" +event.keyCode);
    //	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;  97 122
    if (key >= 65 && key <= 90) {
        return true;
    }
    else if (key >= 97 && key <= 122) {
        return true;
    }
    else
        return false;



}

function IsAlpha(event, StrSpaceAllow) {
    if (event.keyCode) //For IE
        key = event.keyCode;
    else if (event.Which)
        key = event.Which;  // For FireFox
    else
        key = event.charCode; // Other Browser

    // Other Browser
    //	alert(" key" +event.keyCode);
    //	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;  97 122
    if (key >= 65 && key <= 90) {
        return true;
    }
    else if (key >= 97 && key <= 122) {
        return true;
    }
    else {

        if (StrSpaceAllow == false) {
            if (key == 32) return false;
        }
        else {
            if (key == 32) return true;
        }
    }
    return false;

}


function IsAlphaEmail(event) {
    if (event.keyCode) //For IE
        key = event.keyCode;
    else if (event.Which)
        key = event.Which;  // For FireFox
    else
        key = event.charCode; // Other Browser

    // Other Browser
    //	alert(" key" +event.keyCode);
    //	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;  97 122
    if (key >= 64 && key <= 90) {
        return true;
    }
    else if (key >= 97 && key <= 122) {
        return true;
    }
    else if (key >= 48 && key <= 57) { //if not a number
        return true;
    }
    else {

        if (key == 46) return true;
        if (key == 32) return false;

    }
    return false;

}


function IsRestrictBlklist(event, StrSpaceAllow) {
    if (event.keyCode) //For IE
        key = event.keyCode;
    else if (event.Which)
        key = event.Which;  // For FireFox
    else
        key = event.charCode; // Other Browser
    var ArrBlklist = [32, 34, 35, 37, 36, 39, 43, 40, 41, 42, 45, 60, 62, 64, 96, 47, 92];


    // Other Browser
    //alert(" key" +key);
    //	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;  97 122
    if (jQuery.inArray(key, ArrBlklist) == -1 && key <= 122) {
        return true;
    }


    else {

        if (StrSpaceAllow == false) {
            if (key == 32) return false;
        }
        else {
            if (key == 32) return true;
        }
    }

    return false;
}

// Validate remarks text
function ValidateAddresstextWithLimit(strlen, obj, evt) {

    if (parseInt(obj.value.length) > parseInt(strlen))
    { return false; }
    else {
        return IsAlphNumericAddress(evt, true);
    }


}

//comma slash, hyphen dot hashs
//
function IsAlphNumericAddress(event, StrSpaceAllow) {
    if (event.keyCode) //For IE
        key = event.keyCode;
    else if (event.Which)
        key = event.Which;  // For FireFox
    else
        key = event.charCode; // Other Browser

    // Other Browser

    //	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;  97 122
    if (key >= 48 && key <= 57)
        return true;
    else if (key >= 65 && key <= 90) {
        return true;
    }
    else if (key >= 97 && key <= 122) {
        return true;
    }
    else {

        if (StrSpaceAllow == false) {
            if (key == 32) return false;
        }
        else {
            if (key == 32 || key == 44 || key == 47 || key == 45 || key == 46 || key == 35 || key == 40 || key == 41) return true;
        }
    }

    return false;
}

function IsAlphNumeric(event, StrSpaceAllow) {
    if (event.keyCode) //For IE
        key = event.keyCode;
    else if (event.Which)
        key = event.Which;  // For FireFox
    else
        key = event.charCode; // Other Browser

    // Other Browser
    // 	alert(" key" +key);
    //	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;  97 122
    if (key >= 48 && key <= 57)
        return true;
    else if (key >= 65 && key <= 90) {
        return true;
    }
    else if (key >= 97 && key <= 122) {
        return true;
    }
    else {

        if (StrSpaceAllow == false) {
            if (key == 32) return false;
        }
        else {
            if (key == 32) return true;
        }
    }

    return false;
}

function UsrKeyPressLong(strValue, KeyAscii) {
    if (!(KeyAscii < 32 || KeyAscii == 127)) {
        if (!(KeyAscii >= 48 && KeyAscii <= 57)) {
            if (String.fromCharCode(KeyAscii) == "-") {
                if (strValue.indexOf("-") >= 0)
                    return (0);
            }
            else
                return (0);
        }
    }
    return (KeyAscii);
}

function UsrKeyPressUnsignedLong(strValue, KeyAscii) {
    if (!(KeyAscii < 32 || KeyAscii == 127)) {
        if (!(KeyAscii >= 48 && KeyAscii <= 57))
            return (0);
    }
    return (KeyAscii);
}

function UsrKeyPressDouble(event) {
    if (event.keyCode) //For IE
        KeyAscii = event.keyCode;
    else if (event.Which)
        KeyAscii = event.Which;  // For FireFox
    else
        KeyAscii = event.charCode; // Other Browser
    if (!(KeyAscii < 32 || KeyAscii == 127)) {
        if (!(KeyAscii >= 48 && KeyAscii <= 57)) {
            if (String.fromCharCode(KeyAscii) == ".") {
                if (strValue.indexOf(".") >= 0)
                    return (0);
            }
            else if (String.fromCharCode(KeyAscii) == "-") {
                if (strValue.indexOf("-") >= 0)
                    return (0);
            }
            else
                return (0);
        }
    }
    return (KeyAscii);
}

function UsrKeyPressUnsignedDouble(obj, event) {
    strValue = obj.value
    if (event.keyCode) //For IE
        KeyAscii = event.keyCode;
    else if (event.Which)
        KeyAscii = event.Which;  // For FireFox
    else
        KeyAscii = event.charCode; // Other Browser

    if (strValue.length != 0) if (jQuery.isNumeric(strValue) == false) return false;


    if (!(KeyAscii < 32 || KeyAscii == 127)) {
        if (!(KeyAscii >= 48 && KeyAscii <= 57)) {
            if (String.fromCharCode(KeyAscii) == ".") {
                if (strValue.indexOf(".") >= 0)
                    return false;
            }
            else if (String.fromCharCode(KeyAscii) == "-") {
                if (strValue.indexOf("-") >= 0)
                    return false;
            }
            else
                return false;
        }
    }

    return (KeyAscii);
}

function echeck(str) {
    var at = "@"
    var dot = "."
    var lat = str.indexOf(at)
    var lstr = str.length
    var ldot = str.indexOf(dot)
    if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr)
        return false;
    if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr)
        return false;
    if (str.indexOf(at, (lat + 1)) != -1)
        return false;
    if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot)
        return false;
    if (str.indexOf(dot, (lat + 2)) == -1)
        return false;
    if (str.indexOf(" ") != -1)
        return false;
    return true;
}
function CheckEMail(item, bAlert) {
    var strErrorMsg = "Enter a valid Email ID.";

    if (!(echeck(item.val().trim()))) {
        item.focus();
        if (bAlert)
            alert(strErrorMsg);
        return (false);
    }
    return (true);
}

/* 
IfitemSelected
if item is selected in combo or not
*/
function IfitemSelected(item) {
    var strErrorMsg = "select a valid value from the options. ";
    if (item.selectedIndex == 0) {
        item.focus();
        alert(strErrorMsg);
        return false;
    }
    return true;
}
/*
ValidateDateSelection 
Need to to pass date, month and year separately
*/
function ValidateDateSelection(cboDay, cboMonth, cboYear) {
    if (cboDay.selectedIndex == 0) {
        alert("Select the Day");
        cboDay.focus();
        return (false);
    }
    else if (cboMonth.selectedIndex == 0) {
        alert("Select the Month");
        cboMonth.focus();
        return (false);
    }
    else if (cboYear.selectedIndex == 0) {
        alert("Select the Year");
        cboYear.focus();
        return (false);
    }
    else if (isDate(cboMonth.value + "/" + cboDay.value + "/" + cboYear.value) == false) {
        cboDay.focus();
        return (false);
    }
}
function y2k(number) {
    return (number < 1000) ? number + 1900 : number;
}


function ValidationMessageContainer(ArrFields, HeaderText) {
    //alert('ValidationMessageContainer');    
    var i = 0;
    if (ArrFields.length > 0) {
        str = '<div id="divValidationMessageContainer" class="divValidationMessageContainer"  style="display:none;">';
        str += '<div id="divValidationMessage" class="divValidationMessage" >';
        str += '<div>';
        str += '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="openFormTable">';
        str += '<tr class="header">';
        str += '<td colspan="4">' + HeaderText + '</td>';
        str += '</tr>';
        str += '<tr class="first">';
        str += '<td >';
        for (i = 0; i < ArrFields.length; i++) {
            if (ArrFields.length > 0) {
                if (i == (ArrFields.length - 1)) {
                    str += ArrFields[i] + '<br />';
                }
                else
                    str += ArrFields[i] + '<br />';
            }
            else
                str += ArrFields[i] + '<br />';
        }

        str += '</td>';
        str += '</tr>';
        str += '<tr>';
        str += '<td>&nbsp;</td>';
        str += '</tr>';
        str += '<tr>';
        str += '<td>&nbsp;</td>';
        str += '</tr>';
        str += '<tr>';
        str += '<td style="text-align:center" >';
        str += '<input value="&nbsp;&nbsp;Ok&nbsp;&nbsp;" onclick="tb_remove();" type="button" class="btn" />';
        str += '</td>';
        str += '</tr>';
        str += '</table>';
        str += '</div>';
        str += '</div>';
        str += '</div>';

        if ($(".divValidationMessageContainer")) {
            $(".divValidationMessageContainer").remove();
            //    alert("div removed");
        }

        $("body").append(str);

        tb_show("Validation Message", "#TB_inline?height=500&width=500&inlineId=divValidationMessage&modal=true", null);
        $('#TB_window input').focus();
        return false;
    }
    else
        return true;
}


function ValidationMessageContainerwithlimit(ArrFields, HeaderText, nlimit) {
    //alert('ValidationMessageContainer');

    var i = 0;
    if (ArrFields.length > 0) {
        str = '<div id="divValidationMessageContainer" class="divValidationMessageContainer"  style="display:none;">';
        str += '<div id="divValidationMessage" class="divValidationMessage" >';
        str += '<div>';
        str += '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="openFormTable">';
        str += '<tr class="header">';
        str += '<td colspan="4">' + HeaderText + '</td>';
        str += '</tr>';
        str += '<tr class="first">';
        str += '<td >';
        for (i = 0; i < nlimit; i++) {
            if (ArrFields.length > 0) {
                if (i == (nlimit - 1)) {
                    str += ArrFields[i] + '<br />';
                }
                else
                    str += ArrFields[i] + '<br />';
            }
            else
                str += ArrFields[i] + '<br />';
        }

        str += '</td>';
        str += '</tr>';
        str += '<tr>';
        str += '<td>&nbsp;</td>';
        str += '</tr>';
        str += '<tr>';
        str += '<td>&nbsp;</td>';
        str += '</tr>';
        str += '<tr>';
        str += '<td style="text-align:center" >';
        str += '<input value="&nbsp;&nbsp;Ok&nbsp;&nbsp;" onclick="tb_remove();" type="button" class="btn" />';
        str += '</td>';
        str += '</tr>';
        str += '</table>';
        str += '</div>';
        str += '</div>';
        str += '</div>';

        if ($(".divValidationMessageContainer")) {
            $(".divValidationMessageContainer").remove();
            //    alert("div removed");
        }
        $("body").append(str);

        tb_show("Validation Message", "#TB_inline?height=500&width=500&inlineId=divValidationMessage&modal=true", null);
        $('#TB_window input').focus();
        $(window).scrollLeft("0px");
        return false;
    }
    else
        return true;
}
function toFixed(num, fixed) {
    fixed = fixed || 0;
    fixed = Math.pow(10, fixed);
    return Math.floor(num * fixed) / fixed;
}
function validatePan(strToCheck) {
    var StrPanNo;
    StrPanNo = strToCheck;
    if (StrPanNo.length != 10) return false;

    var Pre;
    Pre = StrPanNo.substring(0, 5);
    var Mid;
    Mid = StrPanNo.substring(5, 9);
    var Last;
    Last = StrPanNo.substring(9, 10);
    var i;
    var ValPre;
    ValPre = true;
    for (i = 0; i <= 4; i++) {
        if (IsAlphabet(Pre.charAt(i)) == false) ValPre = false;
    }
    var ValMid = isInteger(Mid);
    var ValPos;
    ValPos = IsAlphabet(Last.charAt(0));
    if (ValPre && ValMid && ValPos) {
        return true;
    }
    else
    { return false; }

}

function validateTan(strToCheck) {
    var StrPanNo;
    StrPanNo = strToCheck;
    if (StrPanNo.length != 10) return false;

    var Pre;
    Pre = StrPanNo.substring(0, 4);
    var Mid;
    Mid = StrPanNo.substring(4, 9);
    var Last;
    Last = StrPanNo.substring(9, 10);
    var i;
    var ValPre;
    ValPre = true;
    for (i = 0; i <= 3; i++) {
        if (IsAlphabet(Pre.charAt(i)) == false) ValPre = false;
    }
    var ValMid = isInteger(Mid);
    var ValPos;
    ValPos = IsAlphabet(Last.charAt(0));
    if (ValPre && ValMid && ValPos) {
        return true;
    }
    else
    { return false; }

}
function NoKeyPress() {
    event.returnValue = false;
}
//  function FieldsInformation(str) {
//    var ValFields = new Array();
//    var i = 0;
//    HeaderTextMandatory = 'Information:';
//    ValFields[i] = str;
//    return ValidationMessageContainer(ValFields, HeaderTextMandatory);
//  }

//function setValidation() {

//alert("change field css here");
//  $("#divPageContainer input").each(function() {
//       $(this).addClass('required');
// });
//}


//Validate Input on Key Press
function validateKeyPress_Type(input, evt, type) {
    var codenum;
    if (window.event) // IE
    {
        codenum = evt.keyCode;
    }
    else if (evt.which) // Netscape/Firefox/Opera
    {
        codenum = evt.which;
    }
    actualChar = String.fromCharCode(codenum);
    // alert(actualChar);
    var validStr;
    if (type == 'AN') {// Alpha Numeric
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    } else if (type == 'ANS') {// Alpha Numeric with space
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789 ';
    } else if (type == 'AS') {// Alpha with space
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ';
    } else if (type == 'N') {// Alpha with space
        validStr = '0123456789';
    } else if (type == 'ANSSp1') {//Alpha Numeric with Space & Special Character => Type 1 (._-)
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._- ';
    } else if (type == 'ANSp2') {//Alpha Numeric with Special Character => Type 2 (._-)
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-';
    } else if (type == 'ANSp3') {//Alpha Numeric with Special Character => Type 3 (_-)
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-';
    } else if (type == 'ANSp4') {//Alpha Numeric with Special Character => Type 4 (_. )
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_- ';
    } else if (type == 'Dt') {//Alpha Numeric with Special Character => Type 4 (_. )
        validStr = '0123456789/index.html';
    } else if (type == 'Email') {//Alpha Numeric with Special Character => Type 4 (_. )
       
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-.@';
    } else if (type == 'ADDRESS') {// Alpha Numeric with space and special charaters
        validStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789(-,_) ';
    } else if (type == 'STD') {// Alpha with space STD
        validStr = '0123456789+';
    }

    if (validStr.indexOf(actualChar) == -1 && codenum != undefined && codenum != 8)
        return false;
    else
        return true;
}
