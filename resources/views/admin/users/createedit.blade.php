 @extends('app_header')
 @section('head-content')
 @include('admin.sidebarMenu')
 <div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
        <div class="clearfix_responsive"></div>
        <div class="container-fluid">
           <div class="row">
              @include('errors')
               <div class="card">
                   <div class="card-header" data-background-color="green">
                    <h4 class="title">Security Details <span class="pull-right">Admin </span></h4>
                    {{--  <p class="category">Apply new loan</p>   --}}
                </div>
                @if ($subViewType == "admin.users._user")
                {!! Form::model($user,['method' =>'POST','action' => $formaction] ) !!}
                @elseif ($subViewType == "admin.users._permissions")
                {!! Form::model($user,['method' =>'POST','action' => $formaction] ) !!}
                @endif
                <div class="btn-group leftside_tab" style="padding-bottom:10px;">
                    <a href={{URL::to("/admin/users")}} class="btn btn-large btn-success btn-space" style="font-size: 14px !important;">Admin</a>
                    <a href="#" class="btn btn-large btn-success btn-space {{{$subViewType == "admin.users._user" ? 'active' : ''}}}" style="font-size: 14px !important;" data-id="manageUser">Manage Users</a>
                    <a href="#" class="btn btn-large btn-success btn-space " style="font-size: 14px !important;" data-id="userProfile">User Profile</a>
                    @if(isset($mobileAppEmail))
                    @if(count($mobileAppEmail)>0)
                    <!--        count()-->
                    <a href="#" class="btn btn-large btn-success btn-space " style="font-size: 14px !important;" data-id="mobileData">Mobile Data</a>
                    @endif
                    @endif
                </div>
                <!-- Tab panes -->
                <div class="tab-content tab-design responsive col-xs-12 col-md-12 col-lg-12" style="padding:20px;margin-bottom: 20px;">
                    @include($subViewType)
                </div><!-- end tab-content -->
            {!! Form::close() !!}
            @endsection