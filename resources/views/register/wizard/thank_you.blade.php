<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@extends('app_header')

@section('content')

    <div class="row">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="container-fluid main-container" style="margin-bottom:15px;">
                    <div class="col-md-12 col-lg-12">
                        <div class="tab-content tab-design">
                            <div class="tab-pane active" id="CompanyBackground" style="margin-left:20px;">
                                <div class="row" align="center">
                                    <h4>Thank you for registering with us.<br>
                                        Your login credentials will be mailed on your registered email id.</h4>
                                    <a href={{URL::to("http://smeniwas.com/")}} class="btn btn-primary" name="proceedNext" value="yes" style="margin-right: 10px;">OK  <span class="glyphiconglyphicon-check"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection