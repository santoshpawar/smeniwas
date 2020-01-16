<?php include 'header.php'; ?>

<body>
	<div class="wrapper">
	    	<?php include 'sidebarBackground.php'; ?>
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
	                    <div class="col-md-6">
	                        <div class="card" style="height: 580px">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">KYC Details</h4>
									<p class="category">Complete your profile</p>
	                            </div>
	                            <div class="card-content">
	                                <form>
	                                	<div class="row">
	                                		<div class="col-md-12" style="height: 100px">
	                                		   <div class="sample">
	                                				<div class="form-group">
	                                					<label for="s1">Select Business Type</label>
	                                					<select id="s1" class="form-control">
	                                						<option value="Apple fritter">Select Business Type</option>
	                                						<option value="Croissant">Manufacturing</option>
	                                						<option value="Donut">Services B2B</option>
	                                						<option value="Financier">Services B2C</option>
	                                						<option value="Jello">Trading</option>
	                                					</select>
	                                				</div>
	                                				<br>
	                                			</div>
	                                			<br>
	                                		</div>
	                                	</div>

	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating">
													<label class="control-label">Vat</label>
													<input type="text" class="form-control" >
												</div>
	                                        </div>
	               
	                                    </div>

	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating">
													<label class="control-label">CIN</label>
													<input type="text" class="form-control" >
												</div>
	                                        </div>
	                                    </div>

	                                    <div class="row">
	                                     <div class="col-md-12">
												<div class="form-group label-floating">
													<label class="control-label">Sevice Tax</label>
													<input type="text" class="form-control" >
												</div>
	                                        </div>
	                                    </div>
	                                    <div class="clearfix"></div>
	                                </form>
	                            </div>
	                        </div>
	                    </div>  
	                     <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">Business Background</h4>
									<p class="category">Complete your profile</p>
	                            </div>
	                            <div class="card-content">
	                                <form>
	                                    <div class="row">
	                                		<div class="col-md-12" style="height: 100px">
	                                		   <div class="sample">
	                                				<div class="form-group">
	                                					<label for="s2">Select Industry Segment</label>
	                                					<select id="s2" class="form-control">
	                                						<option value="Apple fritter">Select Option</option>
	                                						<option value="Croissant">Abrasive and Grinding</option>
	                                						<option value="Donut">2 & 3 Wheelers</option>
	                                					</select>
	                                				</div>
	                                				<br>
	                                			</div>
	                                			<br>
	                                		</div>
	                                	</div>
                                        <div class="row">
	                                		<div class="col-md-12" style="height: 100px">
	                                		   <div class="sample">
	                                				<div class="form-group">
	                                					<label for="s3">How many years old is the business/company?
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
	                                	<h5><small>Is the company Venture Capital funded?</small></h5>
	                                	<div>
	                                	<div class="radio" >
	                                		<label>
	                                			<input type="radio" name="sample1" value="option1" checked="">
	                                			Large Company
	                                		</label>
	                                		<label>
	                                			<input type="radio" name="sample1" value="option1">
	                                			Small & Medium Business
	                                		</label>
	                                		<label>
	                                			<input type="radio" name="sample1" value="option1">
	                                			Retail Customers
	                                		</label>
	                                	</div>
                                        </div>
	                                	<h5><small>Are Your Sales to a?</small></h5>
	                                	<div>
	                                	<div class="radio" >
	                                		<label>
	                                			<input type="radio" name="sample1" value="option1" checked="">
	                                			Yes
	                                		</label>
	                                		<label>
	                                			<input type="radio" name="sample1" value="option1">
	                                			No
	                                		</label>
	                                	</div>
                                        </div>
	                                   
	                                    <div class="row">
	                                        <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Key Products/Services Offered (Give brief description)</label>
								    					<textarea class="form-control" rows="1"></textarea>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="clearfix"></div>
	                                </form>
	                            </div>
	                        </div>
	                    </div>
						 
	                </div>
	                <div class="row">
	                	<div class="col-md-12" style="margin-top: -40px">
	                        <div class="card" style="height: 80px;text-align: center;">
	                       <a href="newLoan.php"><button type="button" class="btn btn-success" style="height: 55px; width: 300px;">
                          <span style="font-size: 20px;">Save and Next</span></button></a>
	                        </div>
	                    </div>
	                </div>
	            </div>

	        </div>
 <?php include 'footer.php'; ?>