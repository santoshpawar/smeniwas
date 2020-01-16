
@extends('app_header')
@section('head-content')
<?php $user = Auth::user(); ?>

@section('content')
<div class="wrapper">
  @include('home.home_sidebar')
  <div class="main-panel">
    @include('loans.dashboardNavbar')


    <div class="content">
        <div class="clearfix_responsive"></div>
        <div class="container-fluid">

            <div class="row">
              <div class="card">
                <div class="card-header" data-background-color="green">
                  <h3 class="title">Chnage Password</h3>
                  {{-- <p class="category">Apply new loan</p> --}}
              </div>
              <div class="card-content">
                <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading"><label>Analyst Details</label></div>
                        <div class="panel-body">
                            @if (session('status'))
                            <div class="alert alert-success alert-important">
                                {{ session('status') }}
                            </div>
                            <a class="btn btn-success btn-cons sme_button" href="{{ url('/') }}">
                                Ok
                            </a>
                            @else

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="col-md-10 control-label">Do you want us to send the new password generation link by email to {{$email}}?</label>
                                    <input type="hidden" class="form-control" name="email" value="{{ $email }}">
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-success btn-cons sme_button">
                                            Yes, Send Password
                                        </button>
                                        <a class="btn btn-success btn-cons sme_button" href="{{ url('/') }}">
                                            No, Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
        @endsection