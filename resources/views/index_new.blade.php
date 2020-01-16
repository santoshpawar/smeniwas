@extends('app_header')

@section('content')
    <!--body: Start-->
    <!--[if lt IE 9]>
    <script type="text/javascript">
        window.location="{{URL::to('browser')}}";
    </script>
    <![endif]-->


    {{--<section class="content_style">
        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
            <!-- Overlay
            <div class="overlay"></div>-->

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-1"></div>
                   --}}{{-- <div class="hero">
                        <hgroup>
                            <h2 style="font-size:24px; margin-top:14%;">India's first web and mobile app based platform focused on providing financial solutions to Micro ,  Small & Medium Enterprises (MSMEs) </h2>
                        </hgroup>
                    </div>--}}{{--
                </div>
            </div>
        </div>
    </section>--}}

    <section class="content_style">
        <div class="carousel fade-carousel slide" data-ride="carousel" id="bs-carousel">
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-1"></div>
                    {{--<div class="hero">
                        <hgroup>
                            <h2 style="font-size:24px; margin-top:14%;">India's first web and mobile app based platform focused on providing financial solutions to Micro ,  Small & Medium Enterprises (MSMEs) </h2>
                        </hgroup>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>

    <section class="sec_bg first_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                    <div class="col-xs-12 col-sm-12 col-md-12 center-align-why why"><span>Why SME Niwas ?</span></div>

                    <ul class="timeline">
                        <li class="firsticon">
                            <div class="timeline-image" id="service4img"> <img class="img-circle img-responsive "  src="images/new_icon1.png" alt=""> <i class="icon-focus"></i> </div>
                            <div class="timeline-panel first_panelHeading" style="right: 32%; float: right;">
                                <div class="timeline-heading">
                                    <h4 class="subheading" id="timeline_head" style="text-align:right !important;padding-right:135px"><a class="app_link" id="service4" style="cursor:pointer;">MSME FOCUS</a></h4>
                                </div>
                                <div class="timeline-body" style="padding-left:80px !important;" >
                                    <p class="text-muted service4" > <i class="fa fa-share"></i> Loan Feasibility Mapping. <br /> <i class="fa fa-share"></i> Credit scoring model. <br /> <i class="fa fa-share"></i> Structured loan proposal </p>
                                </div>
                            </div>
                            <div class="line"></div>
                        </li>
                        <li class="timeline-inverted secondicon">
                            <div class="timeline-image" id="service5img" style="  margin-left: -43px; margin-top: 12px;"> <img  class="img-circle img-responsive" src="images/new_icon3.png" alt=""> </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading second_panelHeading">
                                    <h4 class="subheading" id="timeline_head2"><a class="app_link" id="service5" style="cursor:pointer;">EASY TO NAVIGATE INTERACTIVE PLATFORM</a></h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted service5"> <i class="fa fa-share"></i> Simple loan application <br /> <i class="fa fa-share"></i> Online document Upload <br /> <i class="fa fa-share"></i> Loan Application Tracker <br /> <i class="fa fa-share"></i> Online query resolution </p>
                                </div>
                            </div>
                            <div class="line"></div>
                        </li>
                        <li class="thirdicon">
                            <div class="timeline-image" id="service6img" style=" top: -126%; margin-left: -14%;"> <img  class="img-circle img-responsive" src="images/new_icon2.png" alt=""> </div>
                            <div class="timeline-panel panel2" style="top: -136%; margin-left: 10%;">
                                <div class="timeline-heading">
                                    <h4 class="subheading third_panelHeading" id="timeline_head3"><a class="app_link" id="service6" style="cursor:pointer;">DEEP UNDERSTANDING OF STAKEHOLDERS</a></h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted service6"> <i class="fa fa-share"></i> Bridging MSME - lender gap. <br /> <i class="fa fa-share"></i> Higher chance of financial closure. <br /> <i class="fa fa-share"></i> Timely decision. </p>
                                </div>
                            </div>
                            <div class="line_hor"></div>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin-top:-130px;" class="sec_bg2">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h3 class="center-align" style="padding-left:50px;"><span>Application Process</span></h3>
                </div>
                <div class="col-md-12">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="box-icon">
                                <span class="fa fa-4x fa-user"></span>
                            </div>
                            <div class="info">
                                <h4 class="text-center">Stage 1</h4>
                                <p><a href="" class="app_link"><i class="fa fa-share"></i> Register</a></p>
                                <p><a href="" class="app_link"> <i class="fa fa-share"></i> Use Loan Advisor</a></p>
                                <p><a href="" class="app_link"><i class="fa fa-share"></i>  Choose Loan Product</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="box-icon">
                                <span class="fa fa-4x fa-upload"></span>
                            </div>
                            <div class="info">
                                <h4 class="text-center">Stage 2</h4>
                                <p><a id="service1" class="app_link" style="cursor:pointer"><i class="fa fa-share"></i> Login and Fill Form</a><br>
                                    <span class="service1"><i class="fa fa-share"></i> Promoter Background  &amp; Financials<br><i class="fa fa-share"></i> Business Details (Operating &amp; Financial)<br> <i class="fa fa-share"></i> Transaction/Loan Details</span>
                                </p>
                                <p><a id="service2" class="app_link"style="cursor:pointer" > <i class="fa fa-share"></i> Upload Documents</a><br>

                                    <span class="service2"><i class="fa fa-share"></i> KYC Documents (Promoter & Business)<br><i class="fa fa-share"></i> Balance Sheets & Bank Statements<br><i class="fa fa-share"></i> Security Documents<br><i class="fa fa-share"></i> Photographs , Contract Copies, Invoices &nbsp;&nbsp;&nbsp;&nbsp;(depending on Loan Product)</span>
                                </p>
                                <p><a class="app_link" style="cursor:pointer"><i class="fa fa-share" ></i>  Choose Lenders and Submit</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="box-icon">
                                <span class="fa fa-4x fa-question"></span>
                            </div>
                            <div class="info">
                                <h4 class="text-center">Stage 3</h4>
                                <p><a href="" class="app_link"><i class="fa fa-share"></i> Track Application Status</a></p>
                                <p> <a href="" class="app_link"><i class="fa fa-share"></i> Answer Lenders Queries Online</a></p>
                                <p><a href="" class="app_link"><i class="fa fa-share"></i>  Receive Sanction</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </section>

    <section style="padding-bottom:30px;" class="sec_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> <h3 class="center-align" style="padding-left:50px;"><span>Our Products</span></h3> </div>
                <div class="col-md-12">

                    <div id="Carousel" class="carousel slide" style="padding: 0 40px 30px 40px;">

                        <ol class="carousel-indicators">
                            <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#Carousel" data-slide-to="1"></li>
                            <li data-target="#Carousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            <div class="item active">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#first")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center;">
                                                    <img src="images/sba-feature.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Loan Against Property</h3>
                                                            <ul class="ulalign">
                                                                <li>5-10 year term loan secured by collateral property</li>
                                                                <li>Loan purpose to meet cashflow  mismatch </li>
                                                                <li>Loan to Value basis location and type of property </li>
                                                            </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#unsecured")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center;">
                                                    <img src="images/unsecured-business-loan.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Unsecured Business Loans</h3>
                                                        <ul class="ulalign">
                                                            <li>Meet cashflow mismatch of small amounts &nbsp;&nbsp;&nbsp;  (< 1 cr) through quick financing </li>
                                                            <li>Credit scores and financials as well as business vintage needs to be of good quality</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#equipment")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/equipment-financing.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Equipment Finance Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Financing purchase of cashflow generating equipment with good resale market& value –
                                                                transport, construction, medical or some manufacturing equipment</li>
                                                            <li>Loan to value between 50-90% depending on </li>
                                                            <li>Secured mainly by charge on equipment   </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                </div><!--.row-->
                            </div><!--.item-->

                            <div class="item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#Capital")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/project.png" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Capex/ New Project Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Financing capital investments, such as construction of a plant, office,  business expansion,
                                                                capital equipment purchase . </li>
                                                            <li>Loan tenor of 5-6 years secured by charge on fixed assets and collateral </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#working")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                   <img src="images/loan.png" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Working Capital  Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Meet core Working capital financing </li>
                                                            <li>Assessment basis  sufficient current assets (drawing power) or % of business turnover  </li>
                                                            <li>Secured by charge on current assets and some collateral property </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#receivable")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/small_business_loan.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Receivable Finance Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Short Term Discounting of cashflows expected from good quality debtors (ideally from long term
                                                                contracts or regular supply) </li>
                                                            <li>Primary security is the charge on the receivable and escrow of the payment by the debtors </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    </div>
                                    </div>

                            <div class="item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#inventory")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center;">
                                                    <img src="images/channel-inventory-finance-loan.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Channel Inventory Finance Loan</h3>
                                                        <ul class="ulalign">
                                                            <li class="forAdjustment">Finance inventory purchase of vendors to large ecommerce platforms or distributors of
                                                                large FMCG or durable good companies  </li>
                                                            <li class="forAdjustment">Financing basis sales track record/average monthly sales, vintage of association with
                                                                large company and its payment track record credit scores of promoters and health of
                                                                business </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#first")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center;">
                                                    <img src="images/sba-feature.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Loan Against Property</h3>
                                                        <ul class="ulalign">
                                                            <li>5-10 year term loan secured by collateral property</li>
                                                            <li>Loan purpose to meet cashflow  mismatch </li>
                                                            <li>Loan to Value basis location and type of property </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#unsecured")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/unsecured-business-loan.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Unsecured Business Loans</h3>
                                                        <ul class="ulalign">
                                                            <li>Meet cashflow mismatch of small amounts &nbsp;&nbsp;&nbsp;  (< 1 cr) through quick financing </li>
                                                            <li>Credit scores and financials as well as business vintage needs to be of good quality</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div><!--.row-->
                            </div><!--.item-->

                            <div class="item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#equipment")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/equipment-financing.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Equipment Finance Loan </h3>
                                                        <ul class="ulalign">
                                                            <li>Financing purchase of cashflow generating equipment with good resale market& value –
                                                                transport, construction, medical or some manufacturing equipment</li>
                                                            <li>Loan to value between 50-90% depending on </li>
                                                            <li>Secured mainly by charge on equipment   </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#Capital")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/project.png" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Capex/ New Project Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Financing capital investments, such as construction of a plant, office,  business expansion,
                                                                capital equipment purchase . </li>
                                                            <li>Loan tenor of 5-6 years secured by charge on fixed assets and collateral </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#working")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/loan.png" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Working Capital  Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Meet core Working capital financing </li>
                                                            <li>Assessment basis  sufficient current assets (drawing power) or % of business turnover  </li>
                                                            <li>Secured by charge on current assets and some collateral property </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                </div><!--.row-->
                            </div><!--.item-->

                            <div class="item">
                                <div class="row">

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#receivable")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/small_business_loan.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Receivable Finance Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Short Term Discounting of cashflows expected from good quality debtors (ideally from long term
                                                                contracts or regular supply) </li>
                                                            <li>Primary security is the charge on the receivable and escrow of the payment by the debtors </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#equipment")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/equipment-financing.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Equipment Finance Loan </h3>
                                                        <ul class="ulalign">
                                                            <li>Financing purchase of cashflow generating equipment with good resale market& value –
                                                                transport, construction, medical or some manufacturing equipment</li>
                                                            <li>Loan to value between 50-90% depending on </li>
                                                            <li>Secured mainly by charge on equipment   </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#working")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/loan.png" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Working Capital  Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Meet core Working capital financing </li>
                                                            <li>Assessment basis  sufficient current assets (drawing power) or % of business turnover  </li>
                                                            <li>Secured by charge on current assets and some collateral property </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#unsecured")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/unsecured-business-loan.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Unsecured Business Loans</h3>
                                                        <ul class="ulalign">
                                                            <li>Meet cashflow mismatch of small amounts &nbsp;&nbsp;&nbsp;  (< 1 cr) through quick financing </li>
                                                            <li>Credit scores and financials as well as business vintage needs to be of good quality</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#Capital")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center; ">
                                                    <img src="images/project.png" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Capex/ New Project Loan</h3>
                                                        <ul class="ulalign">
                                                            <li>Financing capital investments, such as construction of a plant, office,  business expansion,
                                                                capital equipment purchase . </li>
                                                            <li>Loan tenor of 5-6 years secured by charge on fixed assets and collateral </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href={{URL::to("/products/loans#first")}}>
                                            <div class="cuadro_intro_hover " style="background-color:#cccccc;">
                                                <p style="text-align:center;">
                                                    <img src="images/sba-feature.jpg" class="img-responsive" alt="">
                                                </p>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <h3>Loan Against Property</h3>
                                                        <ul class="ulalign">
                                                            <li>5-10 year term loan secured by collateral property</li>
                                                            <li>Loan purpose to meet cashflow  mismatch </li>
                                                            <li>Loan to Value basis location and type of property </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div><!--.carousel-inner-->
                        <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                        <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
                    </div><!--.Carousel-->

                </div>
            </div>
        </div><!--.container-->
    </section>

    <section  class="sec_bg2">
        <div class="container" >
            <div class="row">
                <div class="col-md-6">
                    <h3 class="center-align" style="padding-left:50px;padding-bottom:30px;"><span>Our Partners</span></h3>
                    <div class="col-md-4 col-sm-4 col-xs-6 partners"><img class="img-responsive" src="images/axisbank1.jpg" /></div>
                    <div class="col-md-4 col-sm-4 col-xs-6 partners"><img class="img-responsive" src="images/Edelweiss.jpg" /></div>
                    <div class="col-md-4 col-sm-4 col-xs-6 partners"><img class="img-responsive" src="images/ratnakar-bank-logo.jpg" /></div>
                    <div class="col-md-4 col-sm-4 col-xs-6 partners"><img class="img-responsive" src="images/YES BANK.jpg" /></div>
                    <div class="col-md-4 col-sm-4 col-xs-6 partners"><img class="img-responsive" src="images/religare.jpg" /></div>
                </div>
                <div class="col-md-6">
                   {{-- <div class="col-md-8 col-md-offset-2">--}}
                        <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
                        <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                            <!-- Carousel indicators -->
                            {{--<ol class="carousel-indicators">
                                <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                                <li data-target="#fade-quote-carousel" data-slide-to="2"></li>
                            </ol>--}}
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="active item">
                                    <blockquote>
                                        <p>" We are extremely happy with our experience of dealing with smeniwas.com who successfully arranged a long term Loan Against Property for our Company. The entire experience of the web portal including registration to online application was seamless and the way the platform created a proposal and credit score and presented it to our lender ensured a smooth sanction process on competitive terms "</p>
                                        <p>- Rajnikant Behera , Director RSB Industries Limited </p>
                                    </blockquote>
                                   {{-- <div class="profile-circle" style="background-color: rgba(0,0,0,.2);"></div>--}}
                                </div>
                               {{-- <div class="item">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempores.</p>
                                    </blockquote>
                                    <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
                                </div>
                                <div class="item">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore .</p>
                                    </blockquote>
                                    <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
                                </div>--}}
                            </div>
                        </div>
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>



@endsection
