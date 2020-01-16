			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul>
							<li>
								<a href="#">
									Home
								</a>
							</li>
							<li>
								<a href="#">
									Company
								</a>
							</li>
							<li>
								<a href="#">
									Portfolio
								</a>
							</li>
							<li>
								<a href="#">
									Blog
								</a>
							</li>
						</ul>
					</nav>
					<p class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
					</p>
				</div>
			</footer>
		</div>
	</div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<script src="../assets/js/newLoan.js"></script>
<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script src="../assets/js/jquery.dropdown.js"></script> 
<script type="text/javascript">

	$(document).ready(function(){
			// Javascript method's body can be found in assets/js/demos.js
			demo.initDashboardPageCharts();
		});

	$.material.init();
	$(document).ready(function() {
		$("#s1").dropdown({"optionClass": "withripple"});
		$("#s2").dropdown({"optionClass": "withripple"});
		$("#s3").dropdown({"optionClass": "withripple"});
		$("#s5").dropdown({"optionClass": "withripple"});
	});

 
	$( ".loan_product" ).change(function() {
		if($(this).val() == 'LAS' ) {
			$("#loanshareShow").collapse("show");
		}else{
			$("#loanshareShow").collapse("hide");
		}
	});
</script>
</html>
