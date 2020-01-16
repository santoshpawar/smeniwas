<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
    <title>SME Niwas</title>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--CSS-->
    <link rel="stylesheet" href="/css_new/bootstrap.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css_new/bootstrap-theme.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css_new/font-awesome.css" type="text/css" media="all" />

    <!--JS-->
    <script type='text/javascript' src='/js_new/jquery.js'></script>
    <script type='text/javascript' src="/js_new/bootstrap.js"></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 5000
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#divForgotPassword").css("display", "none");

        });

        function showdivUcRegister() {
            $("#divForgotPassword").css("display", "block");
            $("#ucLogin_dvLogin").css("display", "none");


        }
        function hideRegister() {
            $("#divForgotPassword").css("display", "none");
            $("#ucLogin_dvLogin").css("display", "block");
        }

        function GoTOApplyLoan() {
            // alert($('input[name=rblRegister]:checked').val());
            var rblRegisterval = $('input[name=rblRegister]:checked').val();//
            if (rblRegisterval == "SME") {
                window.open("{{URL::to("/register/sme")}}", "_self");
                return false;
            } else if (rblRegisterval == "Chartered Accountant") {
                window.open("{{URL::to("/register/ca")}}", "_self");
                return false;
            } else if (rblRegisterval == "Insurance Broker") {
                window.open("{{URL::to("/register/broker")}}", "_self");
                return false;
            } else if (rblRegisterval == "Bank/NBFC") {
                window.open("Financer_ViewLogin.html", "_self");
                return false;
            } else {
                alert("Please select User type for Login");
                $("#rblSME").focus();
                return false;
            }
        }

        function SuccessfulMsg() {
            alert("Please check your registered email acoount for the password.");
            //$("#lblSuccessMsg").html("Please check your registered email acoount for the password.");
            return false;
        }

        function GoToRegsiter() {

            //rblRegisterval = $('input[name=rblRegister]:checked').val();
            rblRegisterval =  $('#rblRegister').val();

            if (rblRegisterval == "SME") {
                window.open("{{URL::to("/register/sme")}}", "_self");
                return false;

            } else if (rblRegisterval == "Chartered Accountant") {
                window.open("{{URL::to("/register/ca")}}", "_self");
                return false;

            } else if (rblRegisterval == "Insurance Broker") {
                window.open("{{URL::to("/register/broker")}}", "_self");
                return false;
            } else {
                alert("Please select User type for New member registration");
                $("#rblSME").focus();
                return false;
            }
        }
    </script>

</head>

<!--header:start-->
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="spacer10"></div>

                <div class="col-md-3"><a href={{URL::to("http://localhost:8000")}}><img src={{ asset('/images_new/logo.png') }} alt="#" title="SME EXCHANGE.COM" ></a></div>
                <div class="col-md-9">
                    <div class="spacer10"></div>
                    <div class="col-md-12">
                        <a href="" class="btn btn-info btn-cons  pull-right" style="margin-left:10px;">Get Started</a>
                        <a href={{URL::to("/auth/login")}} class="btn btn-success btn-cons pull-right sme_button" style="margin-left:10px;">Login</a>
                        <a href="mailto:demo@smeniwas.com" class="phone_number pull-right" >demo@smeniwas.com</a>
                        <a href="tel:212 (742) 1414" class="phone_number pull-right">Call us: 212 (742) 1414</a>
                    </div>
                    <!--menu:start-->
                    <div class="col-md-12">
                        <div class="spacer10"></div>
                        <nav class="navbar navbar-default navbar_default_remove">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="#">About Us</a></li>
                                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Products <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Loans</a></li>
                                                <li><a href="#">Insurance</a></li>
                                                <li><a href="#">Equity</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Knowledge Center</a></li>
                                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Application Process<span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">How To Apply</a></li>
                                                <li><a href="#">Information Required</a></li>
                                                <li><a href="#">Documents Required</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Track your application</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.container-fluid -->
                        </nav>
                    </div>
                    <!--menu:end-->
                </div>
            </div>
        </div>
    </nav>
</header>
<!--header:end-->

<div class="overlay" style="display: none;">
</div>
<div class="transparent">
</div>
<!--register:start-->
<form name="aspnetForm" method="post" action="http://123.252.223.217/SmeExchange/Forms/requirements.aspx" id="aspnetForm">
    <div class="registerSection">
        <div id="divRtNavigation" class="register" style="height: 1391px;">
            <div id="UpdatePanel1">
                <!--Ligin:end-->
                <div id="divInfo" class="registerInfoContent">
                    <div id="ucLogin_dvLogin" class="registerForm">
                        <div class="fieldsGroup">
                            <label for="Register_rblUserType" id="Register_lblUserType">
                                Select the type of user:</label>
                            <div class="field">
                                <ul id="Register_rblUserType" class="radioBtn">
                                    <li>
                                        <input type="radio" id="rblSME" name="rblRegister" value="SME" checked/>
                                        <label for="rblSME">
                                            SME</label></li>
                                    <li>
                                        <input type="radio" id="rblCA" name="rblRegister" value="Chartered Accountant" />
                                        <label for="rblCA">
                                            Chartered Accountant</label></li>
                                    <li>
                                        <input type="radio" id="rblIB" name="rblRegister" value="Insurance Broker" />
                                        <label for="rblIB">
                                            Insurance Broker/Company</label></li>

                                </ul>
                            </div>
                                <span id="Register_RQrblUserType" class="errorMsg" style="display: none;">Please select
                                    user type</span>
                        </div>
                        <div id="ucLogin_pnlRegisterLogin">
                            <div class="fieldsGroup">
                                <label for="ucLogin_txtUserId" id="ucLogin_lblUserId">
                                    User Name :</label>
                                <div class="field">
                                    <input name="txtUserId" type="text" maxlength="100" id="txtUserId">
                                </div>
                            </div>
                            <div class="fieldsGroup">
                                <label for="ucLogin_txtPassword" id="ucLogin_lblPassword">
                                    Password :</label>
                                <div class="field">
                                    <input name="txtPassword" type="password" maxlength="15" id="txtPassword">
                                </div>
                            </div>
                            <div class="buttonOrange">
                                <input type="submit" name="btnLogin" value="Login" id="btnLogin" onclick="javascript:return GoTOApplyLoan();">
                            </div>
                        </div>
                        <span id="ucLogin_Label1"></span>
                        <div class="forgotPass">
                            <a id="ucLogin_lnkForgotPass" href="#" onclick="javascript:return showdivUcRegister();">
                                Forgot Password?</a>
                        </div>
                        <br />
                        <br />
                        <div id="divNotAMember" class="notAmember">
                            Not a Member? <a id="lnkViewRegister" class="viewRegister" href="#" onclick="javascript:return GoToRegsiter();">
                                Register</a>
                        </div>
                    </div>
                    <div id="divForgotPassword" class="registerForm" style="padding-top: 100px;">
                        <div class=" fieldsGroup">
                            <div class="back">
                                <a id="lnkBackReg" href="#" onclick="javascript:return hideRegister();">Back</a>
                            </div>
                            <label for="txtEmail" id="lblEmail">
                                Email ID
                            </label>
                            <div class="field">
                                <input name="txtEmail" type="text" maxlength="100" id="txtEmail" />
                            </div>
                        </div>
                        <div class="buttonOrange">
                            <span id="lblSuccessMsgRset" class="SuccessMsg"></span>
                            <br />
                            <br />
                            <input type="submit" name="btnSubmit" value="Submit" id="btnSubmit" onclick="javascript:return SuccessfulMsg();">
                        </div>
                    </div>
                </div>
            </div>
            <div class="arrow">
                &nbsp;</div>
        </div>
    </div>
    <!--register:end-->
</form>
</body>
</html>