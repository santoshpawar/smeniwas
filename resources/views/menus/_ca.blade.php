<div class="headingWrapper">
    <div class="centerPosition">
        <div class="headingSection">
            <ul class="navDashboard">
                <li class=""><a href={{URL::to("CA_Email.html")}}>Email</a> </li>
                <li class=""><a href={{URL::to("#")}}>Profile</a>
                    <div class="submenus" style="display: none;">
                        <div class="Sub_content">
                            <ul>
                                <li><a href={{URL::to("/register/ca")}} title="My Profile">My Profile</a></li>
                                <li><a href={{URL::to("CA_ChangePass.html")}} title="Change Password">Change Password</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="backDashboard">
                <li><a href={{URL::to("/home")}}>Back to Dashboard</a> </li>
                {{--<li><a href={{URL::to("/logout")}}>Sign out</a> </li>--}}
            </ul>
        </div>
    </div>
</div>