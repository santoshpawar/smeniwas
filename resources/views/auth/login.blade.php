@extends('app_header')
<style type="text/css">
  .header-fixed-top{
        position: fixed;
    right: 0;
    left: 0;
    z-index: 1030;
    background: #fff;
        border-bottom: 5px solid #f3f3f3;
  }
  .phone_number {
    font-size: 20px;
    margin-left: 10px;
    line-height: 40px;
    vertical-align: middle;
    font-weight: bold;
    color: #2f5c99 !important;
    text-decoration: none;
    font-family: 'Tw Cen MT';
}
.card.reg {
    margin-top: 50px;
}
</style>
<header class="header-fixed-top">
  <div class="top-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <a href="http://smeniwas.com/">
            <img src="{{ asset('img/SMELogo.jpg') }}" alt="#" title="SME EXCHANGE.COM">
     
          </a>
        </div>
        <div class="col-md-9">
          <a href="/register/wizard/index" class="btn btn-warning btn-cons  pull-right" style="margin-left:10px;font-weight: bold;">Register New User</a>
      
          <a href="/auth/login" class="btn btn-success btn-cons pull-right" style="margin-left:10px;font-weight: bold;">Login</a>
          <a href="mailto:contact@smeniwas.com" class="phone_number pull-right">contact@smeniwas.com</a>
          <a href="tel:+91-22-20852054" class="phone_number pull-right">Call us: +91-22-20852054</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row"></div>
 
</header>
@section('content')


    <div class="row">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
    <div class="container-fluid" style="margin-top: 1%;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        {{--@if (count($errors) > 0)--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--<strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
                                {{--<ul>--}}
                                    {{--@foreach ($errors->all() as $error)--}}
                                        {{--<li>{{ $error }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Login With</label>
                                <div class="col-md-6">
                                    <input id="login" name="login_userid" type="radio" value="email" checked="checked">
                                    <label for="login">E-mail</label>
                                    <input id="login" name="login_userid" type="radio" value="username">
                                    <label for="login">User ID / PAN</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">E-mail / PAN </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="userdetail">
                                    <input type="hidden" name="email">
                                    <input type="hidden" name="username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label style="font-size:14px;">
                                            <input type="checkbox" name="remember" hidden=""> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-success btn-cons sme_button">Login</button>
                                    <a class="btn btn-success btn-cons sme_button" href="{{ url('/password/email') }}">Forgot Your Password?</a>
                                    <a href="{{URL::to("/register/wizard/index")}}" class="btn btn-success btn-cons sme_button" target="_blank">Register New User</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>

@endsection
