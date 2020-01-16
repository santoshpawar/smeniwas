 
<nav class="smenavbar navbar navbar-transparent navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-toggle"   data-toggle="collapse" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">

                @if(Auth::user()->isSME())
                <li><a class="navbar-brand" href="/home">My Loan Summery</a></li>

                <li><a class="navbar-brand" href="#">My Query</a></li>
                <li class="dropdown smedrop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/register/wizard/edit-profile">My Profile</a></li>
                        <li><a href="/password/change-password">Change Password</a></li>
                        <li><a href="/auth/logout">Log Out</a></li>

                    </ul>
                </li>
               {{--  <li class="dropdown smedrop">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown">
                       <span>Insurance</span>
                   </a>
                   <ul class="dropdown-menu">
                    <li><a href="#">Apply Insurance</a></li>
                    <li><a href="#">Track Your Application</a></li>
                </ul>
            </li> --}}
            @endif 
            @if(Auth::user()->isAnalyst())
            <li class="dropdown smedrop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="material-icons">person</i>
                    <p class="hidden-lg hidden-md">Profile</p>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/register/analyst">My Profile</a></li>
                    <li><a href="/password/change-password">Change Password</a></li>
                    <li><a href="/auth/logout">Log Out</a></li>

                </ul>
            </li>
            @endif

            @if(Auth::user()->isAdmin() || Auth::user()->isBankUser())
            <li class="dropdown smedrop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="material-icons">person</i>
                    <p class="hidden-lg hidden-md">Profile</p>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/register/analyst">My Profile</a></li>
                    <li><a href="/password/change-password">Change Password</a></li>
                    <li><a href="/auth/logout">Log Out</a></li>

                </ul>
            </li>
            @endif
             
        </ul>


    </div>
</div>
</nav>