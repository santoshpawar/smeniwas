<div class="collapse navbar-collapse" id="main-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Apply Loan<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ action('Loans\LoansController@getIndex') }}" title="Loan Against Property">Loan Against Property</a></li>
                <li><a href={{URL::to("Apply_WorkingCapitalLoan.html")}} title="Working Capital Loan">Working Capital Loan</a></li>
                <li><a href={{URL::to("Apply_TermLoan.html")}} title="Term Loan">Term Loan</a></li>
                <li><a href={{URL::to("Apply_EquipmentFinance.html")}} title="Equipment Finance">Equipment Finance</a></li>
                <li><a href={{URL::to("Apply_UnsecuredBusinessLoan.html")}} title="Unsecured Business Loan">Unsecured Business Loan</a></li>
                <li><a href={{URL::to("Apply_VendorsofEcommerce.html")}} title="Loan to Vendors of ecommerce / Large Retail Chain ">Loan to Vendors of ecommerce / Large Retail Chain</a></li>
                <li><a href={{URL::to("Apply_BillInvoiceDiscounting.html")}} title="Unsecured Business Loan">Bill/Invoice Discounting</a></li>
            </ul>
        </li>
        <li><a href={{URL::to("Apply_GeneralInsurance.html")}}>Apply General Insurance</a></li>
        <li><a href={{URL::to("Email.html")}}>Email</a> </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href={{URL::to("/register/sme")}} title="My Profile">My Profile</a></li>
                <li><a href={{URL::to("Change_Password.html")}} title="Change Password">Change Password</a></li>
            </ul>
        </li>
        <li><a href="#">How to Apply</a>
    </ul>
</div>