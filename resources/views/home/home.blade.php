@extends('app_header') 
@section('head-content')

<link rel="stylesheet" href="{{ URL::asset('css/datagrid.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/datepicker.css') }}">
<style>
    .sidebar .sidebar-wrapper,
    .off-canvas-sidebar .sidebar-wrapper {
        position: relative;
        height: calc(100vh - 75px);
        overflow: auto;
        width: 260px;
        z-index: 4;
    }

    .btn.btn-success {
        background-color: transparent;
        color: grey
    }

    .sidebar .nav {
        margin-top: 20px;
    }

    .nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }

    ol,
    ul {
        margin-top: 0;
        margin-bottom: 10px;
    }

    .sidebar .nav li>a {
        margin: 25px 12px;
        border-radius: 3px;
        color: #1C4E92;
        font-weight: bold;
    }

    .dropdownjs>ul>li {
        list-style: none;
        padding: 10px 20px;
        color: #4F4E4E;
        font-size: 15px;
        font-weight: 500;
    }

    .sidebar .logo,
    .off-canvas-sidebar .logo {
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

    .btn {
        text-align: left;
    }

    a.tooltips {
        position: relative;
        display: inline;
        color: #000000;
        text-decoration: none;
        cursor: default;
    }

    a.tooltips span {
        position: absolute;
        color: #FFFFFF;
        min-width: 500px;
        color: #FFFFFF;
        background: #000000;
        border: 2px solid #6D6D6D;
        /*height: 63px;*/
        /*line-height: 63px;*/
        /*text-align: center;*/
        visibility: hidden;
        border-radius: 12px;
        padding: 10px;
    }

    a.tooltips span:before {
        content: '';
        position: absolute;
        top: 15%;
        left: 100%;
        /*margin-top: -12px;*/
        width: 0;
        height: 0;
        border-left: 12px solid #6D6D6D;
        border-top: 12px solid transparent;
        border-bottom: 12px solid transparent;
    }

    a.tooltips span:after {
        content: '';
        position: absolute;
        top: 15%;
        left: 100%;
        /*margin-top: -8px;*/
        width: 0;
        height: 0;
        border-left: 8px solid #000000;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
    }

    a:hover.tooltips span {
        visibility: visible;
        opacity: 0.8;
        right: 100%;
        top: 50%;
        margin-top: -31.5px;
        margin-right: 15px;
        z-index: 999;
    }
</style>
<script>
    <?php
    $prefix = "";
    if (!App::isLocal()){
        $prefix = "/smeniwas/public";
    }
    ?>
    function discardApplication(status,loanId){
        console.log("Status : "+status+" loan id: "+loanId);
        var answer = confirm('Are you sure you want to discard this application?');
        if (answer) {
            console.log('yes');
            $.ajax({
                    //url: window.location.origin+'{{$prefix}}/discard/loan',
                    url: '{{{URL::to('/discard/loan')}}}',
                    type: 'get',
                    data: {
                        loan_status : status,
                        loan_id : loanId
                    },
                    success: function (data) {
                       console.log("output :"+data);
                   }
               });
        }
        else {
            console.log('cancel');
        }
    }

</script>
@endsection

<?php if(@$praposal){ ?>
    @include('praposal._praposal_dashboard')
   
<?php } ?> 
<?php if(@$analystDashboard){ ?>
    @include('home._loans_home_analyst')
    
<?php } ?>
 <?php if(@$approverDashboard){ ?>
    @include('home._approvarDashboard')

{{--     <?php } ?>
 <?php if(@$approverDashboard){ ?>
    @include('home._approvarDashboard') --}}
    
<?php } 
     
?> 

@if(isset($isCAUserLoan) && $isCAUserLoan == true && isset($loans))
     @include('home._loans_home_sme', [$loans]) 
   
    @elseif (Auth::user()->isAdmin())
  
      @include('home._loans_home_admin') 
    @elseif(Auth::user()->isSME())
 
        @include('home._loans_home_sme')
    @elseif(Auth::user()->isCA())
  
      @include('home._home_ca') 
    @elseif(Auth::user()->isBroker())
   
        @include('home._loans_home_sme') 
    @elseif(Auth::user()->isExecutive())
  
        @include('home._loans_home_sme') 
    @elseif(Auth::user()->isAnalyst())
    
        @include('home._analyst_dashboard') 
    @elseif(Auth::user()->isBankUser())
    
        @include('home._loans_home_bank') 
    @elseif(Auth::user()->isApproverUser())
    
         @include('home._approvarDashboard') 

    @elseif(Auth::user()->isLoanAdmin())

   

            @include('home._loanAdminDashboard') 
  
     @else
    
        @include('home._loans_home_sme') 
    @endif 
