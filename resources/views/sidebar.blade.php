@extends('sidebar')
@section('content')
<div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->
			<div class="logo">
				<img style="background-color: white;height: 77px;width:219px" src="../assets/img/smeLogo.png">
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="active">
	                    <a href="dashboard.php">
	                        <i class="material-icons">dashboard</i>
	                        <p>Dashboard</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="background.php" >
	                        <i class="material-icons ">person</i>
	                        <p>Background</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="promoter.php">
	                        <i class="material-icons">content_paste</i>
	                        <p>Promoter Details</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="">
	                        <i class="material-icons">library_books</i>
	                        <p>Business Financials</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="">
	                        <i class="material-icons">bubble_chart</i>
	                        <p>Security Details</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="">
	                        <i class="material-icons">location_on</i>
	                        <p>Upload Documents</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="">
	                        <i class="material-icons text-gray">notifications</i>
	                        <p>Notifications</p>
	                    </a>
	                </li>
					<li class="active-pro">
	                    <a href="">
	                        <i class="material-icons">unarchive</i>
	                        <p>Upgrade to PRO</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>
@endsection	    
@include('sidebar')