@extends('app_header')
@section('content')
    <div class="row">
        <p>&nbsp;</p>
        <p>&nbsp;</p>

    </div>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body{
                font-family: 'Love Ya Like A Sister', cursive;
            }
            .logo p{
                color:#272727;
                font-size:40px;
                margin-top:1px;
            }
            .sub a{
                color:#fff;
                background:#272727;
                text-decoration:none;
                padding:10px 20px;
                font-size:13px;
                font-family: arial, serif;
                font-weight:bold;
                -webkit-border-radius:.5em;
                -moz-border-radius:.5em;
                -border-radius:.5em;
            }
        </style>
    </head>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="container-fluid main-container" style="margin-bottom:15px;">
                    <div class="col-md-12 col-lg-12">
                        <div class="tab-content tab-design">
                            <div class="tab-pane active" id="CompanyBackground" style="margin-left:20px;">
                                <div class="row" align="center">
                                    <div class="wrap">
                                        <div class="logo">
                                            <p>OOPS! - Could not Find it</p>
                                            <img src="../../../../../../images/404-1.png" class="img-responsive"/>
                                            <div class="sub">
                                                {{--<a href={{URL::to("/")}} class="btn btn-primary" name="proceedNext" value="yes" style="margin-right: 10px;">OK  <span class="glyphiconglyphicon-check"></span></a>--}}
                                                <p><a href={{URL::to("/")}}>Back </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection