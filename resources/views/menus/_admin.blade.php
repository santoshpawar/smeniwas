<div class="headingWrapper">
    <div class="centerPosition">
        <div class="headingSection">
            <ul class="navDashboard">
                {{--<li class=""><a href="Manage.html">Manage</a> </li>--}}
                <li class=""><a href={{URL::to("#")}}>Manage</a>
                    <div class="submenus" style="display: none;">
                        <div class="Sub_content">
                            <ul>
                                <li><a href={{URL::to("/admin/users/")}} title="Manage Users">Users</a></li>
                                <li><a href={{URL::to("/admin/masterdata/")}} title="Manage Master Data">Master Data</a></li>
                                <li><a href={{URL::to("/admin/questions/")}} title="Manage Question Configurations">Question Configurations</a></li>
                                <li><a href={{URL::to("/admin/creditmodel/")}} title="Manage Credit Model">Credit Model</a></li>
                                <li><a href={{URL::to("/admin/financialdata/")}} title="Manage Credit Model">Financial Data</a></li>
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