<?php
$user = Auth::user();
?>
{{-- New Menu ============================== --}}
<!-- Collect the nav links, forms, and other content for toggling -->
{{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}


@if(Auth::guest())
    <ul  class="nav navbar-nav">
        {{--<li><a href="#" class="menu-bar">About Us</a></li>--}}
        <li><a href="{{ URL::to("/") }}" class="menu-bar">Home</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About Us <span class="caret"></span></a>
            <ul>
                <li><a href={{URL::to("/aboutus/wwr/")}}>Who are we?</a></li>
                <li><a href={{URL::to("/aboutus/whyus/")}}>Why Us?</a></li>
                <li><a href={{URL::to("/aboutus/keymgmt/")}}>Key Management</a></li>
                <li><a href={{URL::to("/aboutus/teammembers/")}}>Team Members</a></li>
            </ul>
        </li>

        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Products <span class="caret"></span></a>
            <ul>
                <li><a href="{{URL::to("/products/loans/")}}">Loans</a></li>
                <li><a href="#">Insurance</a></li>
                <li><a href="#">Equity</a></li>
            </ul>
        </li>
        <li><a href="#" class="menu-bar">Knowledge Center</a></li>
        <li><a href="{{URL::to("/successStories/")}}" class="menu-bar">Success Stories</a></li>
        <li> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Application Process<span class="caret"></span></a>
            <ul>
                <li><a href={{URL::to("/application_process/howtoapply/")}}>How To Apply</a></li>
                <li><a href={{URL::to("/application_process/info_required/")}}>Information Required</a></li>
                <li><a href={{URL::to("/application_process/doc_required/")}}>Documents Required</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::to("/application_process/track_application/")}}">Track your application</a></li>
            </ul>
        </li>
        <li><a href="{{ URL::to('loans/wizard/') }}" class="menu-bar">Loan Advisor</a></li>
        <li><a href={{URL::to("contactus/")}} class="menu-bar">Contact Us</a></li>
    </ul>
@else
    @if(isset($user))
        @if($user->isSME())
            <?php
                if(isset($loan) && $loan['id'] != '')
                {
            ?>
                <ul class="nav navbar-nav">
                    <li><a href={{URL::to("messaging")}} title="Messaging" class="menu-bar" target="_blank">My Query </a></li>
                    <li></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href={{URL::to("/register/wizard/edit-profile/")}} title="My Profile" target="_blank">My Profile</a></li>
                            <li><a href={{URL::to("password/change-password")}} title="Change Password" target="_blank">Change Password</a></li>
                        </ul>
                    </li>
                    @if(isset($user) && $user->isAdmin())
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href={{URL::to("search_report")}} target="_blank" title="Generate Report">SME</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav">
                    <li><a target="_blank" href="{{URL::to("/home")}}" class="menu-bar">My Loan Summary</a> </li>
                    {{--<li><a href="#" class="menu-bar">Application Process</a></li>--}}
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Application Process<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            {{--<li><a href={{URL::to("/application_process/howtoapply/")}} target="_blank">How To Apply</a></li>--}}
                            {{--<li><a href={{URL::to("/application_process/info_required/")}} target="_blank">Information Required</a></li>--}}
                            {{--<li><a href={{URL::to("/application_process/doc_required/")}} target="_blank">Documents Required</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            <li><a href="{{URL::to("/application_process/track_application/")}}" target="_blank">Track your application</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="{{ URL::to('/loans/index/') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Apply New Loan<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href={{URL::to("/application_process/howtoapply/")}}>Application Process</a>
                                <ul class="dropdown-menu">
                                    <li><a href={{URL::to("/application_process/howtoapply/")}}>How To Apply</a></li>
                                    <li><a href={{URL::to("/application_process/info_required/")}}>Information Required</a></li>
                                    <li><a href={{URL::to("/application_process/doc_required/")}}>Documents Required</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
{{--                    <li><a target="_blank" href="{{ URL::to('loans/wizard/') }}" class="menu-bar">Loan Advisor</a></li>--}}
                    {{--<li><a href="#" class="menu-bar">Contact us</a></li>--}}
                    <li><a target="_blank" href={{URL::to("contactus/")}} class="menu-bar">Contact Us</a></li>
                </ul>
            <?php
                }
                else
                {
            ?>
                <ul class="nav navbar-nav">
                    <li><a href={{URL::to("messaging")}} title="Messaging" class="menu-bar">My Query </a></li>
                    <li></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href={{URL::to("/register/wizard/edit-profile/")}} title="My Profile" >My Profile</a></li>
                            <li><a href={{URL::to("password/change-password")}} title="Change Password">Change Password</a></li>
                        </ul>
                    </li>
                    @if(isset($user) && $user->isAdmin())
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href={{URL::to("search_report")}}  title="Generate Report">SME</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::to("/home")}}" class="menu-bar">My Loan Summary</a> </li>
                    {{--<li><a href="#" class="menu-bar">Application Process</a></li>--}}
                    <li class="dropdown"> <a href="{{ URL::to('/insurances/index/') }}" class="dropdown-toggle" role="button" aria-expanded="false">Apply Insurance<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            {{--<li><a href={{URL::to("/application_process/howtoapply/")}}>How To Apply</a></li>--}}
                            {{--<li><a href={{URL::to("/application_process/info_required/")}}>Information Required</a></li>--}}
                            {{--<li><a href={{URL::to("/application_process/doc_required/")}}>Documents Required</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            <li><a href="{{URL::to("/application_process/track_application/")}}">Track your application</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="{{ URL::to('/loans/index/') }}" class="dropdown-toggle" role="button" aria-expanded="false">Apply New Loan<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href={{URL::to("/application_process/howtoapply/")}}>Application Process</a>
                                <ul class="dropdown-menu">
                                    <li><a href={{URL::to("/application_process/howtoapply/")}}>How To Apply</a></li>
                                    <li><a href={{URL::to("/application_process/info_required/")}}>Information Required</a></li>
                                    <li><a href={{URL::to("/application_process/doc_required/")}}>Documents Required</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ URL::to('loans/wizard/') }}" class="menu-bar">Loan Advisor</a></li>
                    {{--<li><a href="#" class="menu-bar">Contact us</a></li>--}}
                    <li><a href={{URL::to("contactus/")}} class="menu-bar">Contact Us</a></li>
                </ul>
            <?php
                }
            ?>
        @endif

        @if($user->isAdmin())
            <ul class="nav navbar-nav">
                <li><a href={{URL::to("messaging")}} title="Messaging" class="menu-bar">My Query </a></li>
                <li></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href={{URL::to("/register/admin")}} title="My Profile" >My Profile</a></li>
                        <li><a href={{URL::to("password/change-password")}} title="Change Password">Change Password</a></li>
                    </ul>
                </li>
                @if(isset($user) && $user->isAdmin())
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href={{URL::to("search_report")}}  title="Generate Report">SME</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href={{URL::to("/home")}} class="menu-bar">Back to Dashboard</a> </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Manage<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href={{URL::to("/admin/users/")}} title="Manage Users">Users</a></li>
                        <li><a href={{URL::to("/admin/masterdata/")}} title="Manage Master Data">Master Data</a></li>
                        <li><a href={{URL::to("/admin/questions/")}} title="Manage Question Configurations">Question Configurations</a></li>
                        <li><a href={{URL::to("/admin/creditmodel/")}} title="Manage Analyst Model">Analyst Model</a></li>
                        <li><a href={{URL::to("/admin/liquiditymodel/")}} title="Manage Liquidityt Model Model">Liquidity Model</a></li>
                        <li><a href={{URL::to("/admin/financialdata/")}} title="Manage Financial Data">Financial Data</a></li>
                        <li><a href={{URL::to("/admin/bankmasterdata/")}} title="Manage Bank Master Data">Bank Master Data</a></li>
                        <li><a href={{URL::to("/admin/parameterdata/")}} title="Manage Parameter Configurations">Parameter Configurations</a></li>
                        <li><a href={{URL::to("/admin/industrytype/")}} title="Manage Parameter Configurations">Industry Type Configurations</a></li>
                        <li><a href={{URL::to("/admin/bankallocation/")}} title="Manage Parameter Configurations">Bank Allocation Configurations</a></li>
                        <li><a href={{URL::to("/admin/manualallocation/")}} title="Manage Manual Bank Allocations">Manual Bank Allocations</a></li>
                    </ul>
                </li>
            </ul>
        @endif

        @if($user->isCA())
            <ul class="nav navbar-nav">
                <li><a href={{URL::to("messaging")}} title="Messaging" class="menu-bar">My Query </a></li>
                <li></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href={{URL::to("/register/wizard/edit-advisor/")}} title="My Profile" >My Profile</a></li>
                        <li><a href={{URL::to("password/change-password")}} title="Change Password">Change Password</a></li>
                    </ul>
                </li>
                <li><a href="{{ URL::to('/register/ca/sme-client/') }}" class="menu-bar">New SME Client</a></li>
                @if(isset($user) && $user->isAdmin())
                    <li class="dropdown"><a href="#" class="dropdown-toggle class="menu-bar"" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href={{URL::to("search_report")}}  title="Generate Report">SME</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href={{URL::to("/home")}} class="menu-bar">Back to Dashboard</a> </li>
            </ul>
        @endif

        @if($user->isBroker())
            <ul class="nav navbar-nav">
                <li><a href={{URL::to("messaging")}} title="Messaging" class="menu-bar">My Query </a></li>
                <li></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href={{URL::to("/register/broker")}} title="My Profile" >My Profile</a></li>
                        <li><a href={{URL::to("password/change-password")}} title="Change Password">Change Password</a></li>
                    </ul>
                </li>
                @if(isset($user) && $user->isAdmin())
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href={{URL::to("search_report")}}  title="Generate Report">SME</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href={{URL::to("/home")}} class="menu-bar">Back to Dashboard</a> </li>
            </ul>
        @endif

        @if($user->isAnalyst())
            <ul class="nav navbar-nav">
                <li><a href={{URL::to("messaging")}} title="Messaging">My Query </a></li>
                <li></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href={{URL::to("/register/analyst")}} title="My Profile" >My Profile</a></li>
                        <li><a href={{URL::to("password/change-password")}} title="Change Password">Change Password</a></li>
                    </ul>
                </li>
                @if(isset($user) && $user->isAdmin())
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href={{URL::to("search_report")}}  title="Generate Report">SME</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href={{URL::to("/home")}} class="menu-bar">Back to Dashboard</a> </li>
            </ul>
        @endif

        @if($user->isBankUser())
            <ul class="nav navbar-nav">
                <li><a href={{URL::to("messaging")}} title="Messaging">Query </a></li>
                <li></li>
                <li><a href={{URL::to("/home")}} class="menu-bar">Back to Dashboard</a> </li>
            </ul>
        @endif

        @if($user->isExecutive())
            <ul class="nav navbar-nav">
                <li></li>
                <li><a href={{URL::to("/home")}} class="menu-bar">Back to Dashboard</a> </li>
            </ul>
        @endif

    @endif
@endif



{{--<ul class="nav navbar-nav">
    <li><a href="index.html">Home</a></li>
    <li class="dropdown"><a href="about_us.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About Us <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="about_us.html">Who are we?</a></li>
            <li><a href="why_us.html">Why Us?</a></li>
            <li><a href="our_team.html">Our Team</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Products <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#">Loans</a></li>
            <li><a href="#">Insurance</a></li>
            <li><a href="#">Equity</a></li>
        </ul>
    </li>
    <li><a href="#">Knowledge Center</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Application Process <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="application_process.html">How to apply</a></li>
            <li><a href="application_information.html">Information Required</a></li>
            <li><a href="application_documents.html">Documents Required</a></li>
            <li class="divider"></li>
            <li><a href="#">Track your application</a></li>
        </ul>
    </li>
    <li><a href="contact.html">Contact Us</a></li>
</ul>--}}
{{--</div>--}}<!-- /.navbar-collapse -->