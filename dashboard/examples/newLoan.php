<?php include 'header.php'; ?>
<body>
	<div class="wrapper">
		<?php include 'sidebar.php'; ?>
		<div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Profile</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">dashboard</i>
									<p class="hidden-lg hidden-md">Dashboard</p>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">notifications</i>
									<span class="notification">5</span>
									<p class="hidden-lg hidden-md">Notifications</p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Mike John responded to your email</a></li>
									<li><a href="#">You have 5 new tasks</a></li>
									<li><a href="#">You're now friend with Andrew</a></li>
									<li><a href="#">Another Notification</a></li>
									<li><a href="#">Another One</a></li>
								</ul>
							</li>
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">person</i>
									<p class="hidden-lg hidden-md">Profile</p>
								</a>
							</li>
						</ul>

						<form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form>
					</div>
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header" data-background-color="purple">
									<h3 class="title">CREATE NEW LOAN APPLICATION</h3>
								</div>
								<div class="card-content">
									<form>
										<div class="row">
											<div class="col-md-6" style="height: 100px">
												<div class="sample">
													<div class="form-group">
														<label for="s2">End Use</label>
														<select id="s2" class="form-control">
														    <option value="Donut">Select End Use</option>
															<option value="Apple fritter">Finance Inventory</option>
															<option value="Croissant">Finance Deptors</option>
															<option value="Donut">Payment of Equipemnt</option>
														</select>
													</div>
													<br>
												</div>
												<br>
											</div>
											<div class="col-md-6" style="height: 100px">
												<div class="sample">
													<div class="form-group">
														<label for="s5">Loan Product</label>
														<select id="s5" class="form-control loan_product" name="loanProduct">
															<option value="Apple fritter">Select Loan Product Type</option>
															<option value="Croissant">Equipemnt Finance</option>
															<option value="Donut">Loan Against Property</option>
															<option value="Donut">Vendor Linance</option>
															<option value="Donut">Unsecured Business Loan</option>
															<option value="LAS">Loan Against Share</option>
														</select>
													</div>
													<br>
												</div>
												<br>
											</div>
										</div>
										<div class="row" style="margin-top: 30px">
										    <div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">Amount (Rs Lacs)</label>
													<input type="text" class="form-control" >
												</div>
	                                        </div>
											<div class="col-md-6" style="margin-top:-25px">
												<div class="sample">
													<div class="form-group">
														<label for="s3">Tenor in Years
														</label>
														<select id="s3" class="form-control">
															<option value="Apple fritter">select Option</option>
															<option value="Apple fritter"> < 3 yrs</option>
															<option value="Croissant"> 3-7 yrs</option>
															<option value="Donut">7-12 yrs</option>
															<option value="Financier"> > 12 yrs</option>
														</select>
													</div>
													<br>
												</div>
												<br>
											</div>

										</div>
										
										<div class="row">
										<div class="control-group  collapse" id="loanshareShow">
										    <div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">BSE/NSE Code</label>
													<input type="text" class="form-control" >
												</div>
	                                        </div>
											<div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">Name of Company whos share are being pledged</label>
													<input type="text" class="form-control" >
												</div>
	                                        </div>
	                                        </div>
										</div>

										<a href="background.php" class="btn btn-primary pull-right">Start Application</a>
										<div class="clearfix"></div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<?php include 'footer.php'; ?>