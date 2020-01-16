<html>
	<head>
		<title>SMENiwas</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href="{{ asset('/css/SME_StyleSheet.css') }}" rel="stylesheet">
		<script src="{{ asset('/js/sliderman.1.3.8.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/jquery.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/common.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/jquery_002.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/jquery-1.7.1.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/jquery-ui.js') }}" type="text/javascript"></script>
		<link href="{{ asset('/js/jquery-ui.css') }}" rel="stylesheet">
<!--
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	-->
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
				rblRegisterval = $('input[name=rblRegister]:checked').val();
				if (rblRegisterval == "SME") {
					window.open("SME_ViewLogin.html", "_self");
					return false;
				} else if (rblRegisterval == "Chartered Accountant") {
					window.open("CA_ViewLogin.html", "_self");
					return false;
				} else if (rblRegisterval == "Insurance Broker") {
					window.open("Insurance_ViewLogin.html", "_self");
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

				rblRegisterval = $('input[name=rblRegister]:checked').val();

				if (rblRegisterval == "SME") {
					window.open("Register_SME.html", "_self");
					return false;

				} else if (rblRegisterval == "Chartered Accountant") {
					window.open("Register_CA.html", "_self");
					return false;

				} else if (rblRegisterval == "Insurance Broker") {
					window.open("Register_IB.html", "_self");
					return false;
				} else {
					alert("Please select User type for New member registration");
					$("#rblSME").focus();
					return false;
				}
			}

		</script>
	</head>
	<body>
	<div id="transition" class="">
		<div class="container">
            <div id="wrapper">
                <!--header:start-->
                <div class="header">
                    <!--headerTop:start-->
                    <div class="centerPosition">
                        <div class="headerTop">
                            <div class="logo">
                                <a href="Index.html">
                                    <img src="{{ asset('img/SMELogo.jpg') }}" alt="#" title="SME EXCHANGE.COM" class="img-responsive" /></a>
                            </div>
                            <div class="menuSection">
                                <div class="getStarted">
                                    <span class="title">Proceed to </span>
                                    <br />
                                    <span>Register &amp; Login </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--headerTop:end-->
                    <!--menu:start-->
                    <div class="clear">
                        <div class="menuWrapper">
                            <div class="centerPosition">
                                <div class="menuSection">
                                    <ul class="menu">
                                        <li class=""><a href="Index.html"><span>Home</span></a></li>
                                        <li class=""><a href="Team.html"><span>Team</span></a></li>
                                        <li class=""><a href="#"><span>Why Us</span></a>
                                            <div class="subMenu" style="display: none;">
                                                <div class="subMenu_content">
                                                    <ul>
                                                        <li><a href="whatWeAre.html">What we are?</a></li>
                                                        <li><a href="whatWeDo.html">What we do?</a></li>
                                                        <li><a href="DifferentServices.html">How we are different from Others Services?</a></li>
                                                        <li><a href="requirements.html">What is your requirements?</a></li>
                                                        <li><a href="howWeCanAddValue.html">How we can add value?</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class=""><a href="#"><span>Products</span></a>
                                            <div class="subMenu" style="display: none;">
                                                <div class="subMenu_content">
                                                    <ul>
                                                        <li><a href="loanAgainstProperty.html">Loan Against Property</a></li>
                                                        <li><a href="workingCapital.html">Working Capital</a></li>
                                                        <li><a href="termLoan.html">Term Loan</a></li>
                                                        <li><a href="equipmentFinance.html">Equipment Finance</a></li>
                                                        <li><a href="unsecuredBusinessLoan.html">Unsecured Business Loan</a></li>
                                                        <li><a href="loanToVendorsEcommerce.html">Loan to Vendors of ecommerce / Large Retail Chain </a></li>
                                                        <li><a href="Bill-InvoiceDiscounting.html">Bill/Invoice Discounting </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class=""><a href="services.html"><span>Services</span></a></li>
                                        <li class=""><a href="#"><span>Application Process</span></a>
                                            <div class="subMenu" style="display: none;">
                                                <div class="subMenu_content">
                                                    <ul>
                                                        <li><a href="loan.html">Loan</a></li>
                                                        <li><a href="insurance.html">Insurance</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class=""><a href="#"><span>Contact Us</span></a>
                                            <div class="subMenu" style="display: none;">
                                                <div class="subMenu_content">
                                                    <ul>
                                                        <li>Telephone (toll free) 1-800-103-7690<br>
                                                            <span>Monday-Saturday : 10am to 6pm</span> </li>
                                                        <li><a href="mailto:contact@smeniwas.com">contact@smeniwas.com</a> </li>
                                                        <li><a class="needHelp" href="http://123.252.223.217/contact-us.aspx">Need more help?</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--menu:end-->
                    </div>
                </div>
            </div>
				<!--header:end-->

			<div class="content">
				<div class="title">Laravel 5</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
			</div>
		</div>

		<!--container:end-->

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
	</div> <!-- transition end -->
	</body>
</html>
