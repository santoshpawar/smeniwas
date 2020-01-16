<style>
    .sidebar .sidebar-wrapper, .off-canvas-sidebar .sidebar-wrapper {
        position: relative;
        height: calc(100vh - 75px);
        overflow: auto;
        width: 260px;
        z-index: 4;
    }
    .btn.btn-success{
        background-color: transparent;
        color: grey
    }
    .sidebar .nav{
        margin-top: 20px;
    }
    .nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    ol, ul {
        margin-top: 0;
        margin-bottom: 10px;
    }
    .sidebar .nav li > a{
        margin: 25px 12px;
        border-radius: 3px;
        color: #1C4E92;
        font-weight: bold;
    }
    .dropdownjs > ul > li {
        list-style: none;
        padding: 10px 20px;
        color: #4F4E4E;
        font-size: 15px;
        font-weight: 500;
    }
    .sidebar .logo, .off-canvas-sidebar .logo {
        position: relative;
        padding: 15px 15px;
        z-index: 4;
    }
    .nav>li>a {
        position: relative;
        display: block;
        padding: 10px 15px;
    }
    .material-icons {
        vertical-align: middle;
        font-size: 17px;
        top: -1px;
        position: relative;
    }
    .btn{
        text-align: left;
    }
</style>
<!-- Tab panes -->
@if($sub_view_type == "loans._choose_loan")
@else
<section class="content_style2">
</section>
@endif
<section>

    @if($sub_view_type == "loans._choose_loan")
        @if($sub_view_type == "loans._choose_loan")
        @include('loans.msme')
        @else
        @endif
    @else
        @include('loans.fromDashboard')
    @endif
    <div class="content">
     @include('errors')
     @include($sub_view_type)
 </div>
</div>
</div>
@section('footer')
<script>
    $('#tab').find('a').each(function() {
        if($(this).hasClass('active')){
            $(this).removeClass('disabled');
        }
    });
        //        $('#loan_product').select2({
        //        allowClear: true,
        //        placeholder: "Select Loan Product Type"
        //        });
    </script>
    @append