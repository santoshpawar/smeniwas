<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>SMEexchange.com - Online Marketplace for Loans</title>
	<script src="{{ asset('/js/jquery-1.11.2.min.js') }}" type="text/javascript"></script>
	<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
	<link href="{{ asset('/css/select2-bootstrap.css') }}" rel="stylesheet">
	<script src="{{ asset('/js/common.js') }}" type="text/javascript"></script>
	<link href="{{ asset('/css/SME_StyleSheet.css') }}" rel="stylesheet">


<!--
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->

	<!-- Fonts -->
<!--	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	<![endif]-->
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

	@yield('head-content')
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
<body>
<div id="transition" class="">
	<!--wrapper:start-->
	<div id="wrapper">
		<!--header:start-->
		<div class="header">
			<!--headerTop:start-->
			<div class="centerPosition">
				<div class="headerTop row">
					<div class="logo col-xs-12 col-md-6 col-lg-6">
						@if(Auth::guest())
							<a href={{URL::to("/")}}>
						@else
							<a href={{URL::to("/home")}}>
						@endif

							<img src="{{ asset('img/SMELogo.jpg') }}" alt="#" title="SME EXCHANGE.COM" /></a>
					</div>
					<div class="menuSection col-xs-12 col-md-6 col-lg-6">
						@if(Auth::guest())
						 <div class="getStarted col-lg-5 col-lg-offset-7">
							<span class="title">Proceed to </span>
							<br />
							<span>Register &amp; Login </span>
						 </div>
						@else
						 <div class="getStarted">
							<span class="title"><a href={{URL::to("/auth/logout")}}>Logout</a></span>
						 </div>
						@endif
					</div>
				</div>
			</div>
			<!--headerTop:end-->
			<!--menu:start-->
            <div class="row">
                <nav class="navbar" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
							<span class="sr-only">navigation Menus</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div><!-- end navbar-header -->
					@if((null !==(Auth::user())) && (Auth::user()->isSME() || Auth::user()->isAdmin() || Auth::user()->isCA() || Auth::user()->isBroker() || Auth::user()->isAnalyst()))
						@include('menus')
					@endif
                </nav><!-- end navbar -->
            </div><!-- end row -->
            <!--menu:end-->
		</div>
		<!--header:end-->

		@if(Session::has('flash_message'))
			<div class = "alert alert-success{{{Session::has('flash_message_important') ? ' alert-important' : ''}}}">
				@if(Session::has('flash_message_important'))
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				@endif

				{{ Session::get('flash_message') }}
			</div>
		@endif

	@yield('content')

	<!--footer:start-->
	<div class="footer">
		<div class="footerBottomLinks">
			<div class="footerLinksInner">
				<ul>
					<li class="first"><a href="#">Terms of Use</a></li>
					<li><a href="#">Disclaimer</a></li>
					<li><a href="#">Privacy Policy</a></li>

				</ul>
				<div id="social_media_top">
					<div class="fb">
						<a href="#" target="_blank"></a>
					</div>
					<div class="twitter">
						<a href="#" target="_blank"></a>
					</div>
					<div class="linked">
						<a href="#" target="_blank"></a>
					</div>
				</div>
			</div>
		</div>
	  </div>
	<!--footer:end-->
	</div>
	<!--wrapper:end-->
	<!--Layout:End-->
	<div class="overlay" style="display: none;">
	</div>
	<div class="transparent">
	</div>
	<!--register:start-->
	<div class="registerSection">
		<div id="divRtNavigation" class="register">
			<div id="UpdatePanel1">
				<!--Login:end-->
				<div id="divInfo" class="registerInfoContent">
					<div id="ucLogin_dvLogin" class="registerForm">
						<div class="fieldsGroup">
                            <!--<label for="Register_rblUserType" id="Register_lblUserType">
                                Select the type of user:</label>
                            <div class="field">

                                <ul id="Register_rblUserType" class="radioBtn">
                                    <li>
                                        <input type="radio" id="rblSME" name="rblRegister" value="SME" />
                                        <label for="rblSME">SME</label></li>
                                    <li>
                                        <input type="radio" id="rblCA" name="rblRegister" value="Chartered Accountant" />
                                        <label for="rblCA">Chartered Accountant</label></li>
                                    <li>
                                        <input type="radio" id="rblIB" name="rblRegister" value="Insurance Broker" />
                                        <label for="rblIB">Insurance Broker</label></li>
                                </ul>
                            </div>-->
                                <span id="Register_RQrblUserType" class="errorMsg" style="display: none;">Please select
                                    user type</span>
						</div>
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div id="ucLogin_pnlRegisterLogin">
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="">
									<label for="login" style="color: white;">Login With</label>
									<div class="">
										<label for="login" style="color: white">E-mail</label>
										<input id="login" name="login_userid" type="radio" value="email">
										<label for="login" style="color: white">PAN #</label>
										<input id="login" name="login_userid" type="radio" value="username">
									</div>
								</div><br>
								<div class="fieldsGroup">
									<label for="email">
										E-mail / PAN #</label>
									<div class="field">
										<input type="text" class="form-control" name="userdetail">
										<input type="hidden" name="email">
										<input type="hidden" name="username">
									</div>
								</div>
								<div class="fieldsGroup">
									<label for="password">
										Password :</label>
									<div class="field">
										<input name="password" type="password" maxlength="15" id="txtPassword">
									</div>
								</div>
								<div class="buttonOrange">
									<input type="submit" name="btnLogin" value="Login" id="btnLogin">
									<!--<button type="submit" value = "Login" class="btn btn-primary">Login</button>-->
									<!--<input type="submit" name="btnLogin" value="Login" id="btnLogin" onclick="return GoTOApplyLoan();">-->
								</div>
							</form>
						</div>
						<span id="ucLogin_Label1"></span>
						<div class="forgotPass">
							<a id="ucLogin_lnkForgotPass" href="#" onclick="return showdivUcRegister();">
								Forgot Password?</a>
						</div>
						<br />
						<br />

						<div id="divNotAMember" class="notAmember">Not a Member?<br/>
							<select class="form-control" id="rblRegister">
								<option value="" disabled selected>Select Type of user</option>
								<option value="SME">SME</option>
								<option value="Chartered Accountant">Chartered Accountant</option>
								<option value="Insurance Broker">Insurance Broker</option>
							</select>
                            <a id="lnkViewRegister" class="viewRegister" href="#" onclick="return GoToRegsiter();">Register</a>
						</div>
					</div>
				</div>
			</div>
			<div class="arrow">
				&nbsp;</div>
		</div>
	</div>
	<!--register:end-->
	</div>
	<!-- Scripts -->
<!--
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	-->
<!--	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
	@yield('footer')
     <script src="{{ asset('/js/bootstrap.js') }}" type="text/javascript"></script>
	 <script>
		$('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(300);
	 </script>
</body>
</html>
