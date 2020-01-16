@extends('app')

@section('content')
    <!--body: Start-->
    <div>

        <!--banner:start-->
        <div class="bannerWrapper">
            <div class="centerPosition">
                <div class="bannerOuter">
                    <div id="slider_container_1">
                        <div id="SliderName">
                            <img src="{{ asset('img/1.jpg') }}" title="" alt="" />
                            <img src="{{ asset('img/2.jpg') }}" title="" alt="" />
                            <img src="{{ asset('img/3.jpg') }}" title="" alt="" />
                            <img src="{{ asset('img/4.jpg') }}" title="" alt="" />
                        </div>
                        <div id="SliderNameNavigation">
                        </div>

                        <script type="text/javascript">

                            // we created new effect and called it 'demo01'. We use this name later.
                            Sliderman.effect({ name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs' });

                            var demoSlider = Sliderman.slider({ container: 'SliderName', width: 975, height: 300, effects: 'demo01',
                                display: {
                                    pause: true, // slider pauses on mouseover
                                    autoplay: 3000, // 3 seconds slideshow
                                    always_show_loading: 200, // testing loading mode
                                    description: { background: '#ffffff', opacity: 0.5, height: 50, position: 'bottom' }, // image description box settings
                                    loading: { background: '#000000', opacity: 0.2, image: '{{ asset('img/loading.gif') }}' }, // loading box settings
                                    buttons: { opacity: 1, prev: { className: 'SliderNamePrev', label: '' }, next: { className: 'SliderNameNext', label: ''} }, // Next/Prev buttons settings
                                    navigation: { container: 'SliderNameNavigation', label: '&nbsp;'} // navigation (pages) settings
                                }
                            });

                        </script>

                    </div>
                </div>
                <div class="ourPartnersWrapper">
                    <div class="ourPartners">
                        <h2>
                            Our Partners</h2>
                        <div class="sliderSection">
                            <div class="prev">
                            </div>
                            <div class="sliderContent">
                                <ul style="margin-left: 0px;">
                                    <li>
                                        <img src="{{ asset('img/aditya-birla-logo.jpg') }}" alt="Aditya Birla Finance"
                                             title="Aditya Birla Finance" /></li>
                                    <li>
                                        <img src="{{ asset('img/hdfc-logo.jpg') }}" alt="HDFC Bank - We understand your world"
                                             title="HDFC Bank - We understand your world" /></li>
                                    <li>
                                        <img src="{{ asset('img/hdb-logo.jpg') }}" alt="HDB Financial Services" title="HDB Financial Services"></li><li>
                                        <img src="{{ asset('img/icici-bank-hl-logo.jpg') }}" alt="ICICI Home Loans - khayaal aapka"
                                             title="ICICI Home Loans - khayaal aapka" /></li>
                                    <li>
                                        <img src="{{ asset('img/indiabulls-logo.jpg') }}" alt="Indiabulls Home Loans"
                                             title="Indiabulls Home Loans" /></li>
                                    <li>
                                        <img src="{{ asset('img/kotak-logo.jpg') }}" alt="Kotak Mahindra Bank" title="Kotak Mahindra Bank" /></li>
                                    <li>
                                        <img src="{{ asset('img/simens-logo.jpg') }}" alt="Financial Services SIEMENS"
                                             title="Financial Services SIEMENS" /></li>
                                </ul>
                            </div>
                            <div class="next">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--banner:end-->
        <!--container:start-->
        <div class="containerWrapper greyColor">
            <div class="container">
                <h2>
                    The Learning Curve</h2>
                <div id="divDisplayLearingCurveArticles" class="infoSection">
                    <div class="infoContent">
                        <h3>
                            SME finance is an easy affair
                        </h3>
                        <p class="date">
                            November 17, 2014
                        </p>
                        <p>
                            SME finance can be a very easy affair in India if the SME goes through the right
                            channel and understands the issues in granting loans/ small business loans.
                        </p>
                        <a href="#" class="readMore">Read More</a> <a class="share" href="#">Share</a>
                    </div>
                    <div class="infoContent">
                        <h3>
                            Get the best out of your property
                        </h3>
                        <p class="date">
                            October 22, 2014
                        </p>
                        <p>
                            A loan against an immovable property, whether it’s a piece of land, your house,
                            your factory or any other immovable property can help you avail of credit very quickly
                            to finance your business.
                        </p>
                        <a href="#" class="readMore">Read More</a> <a class="share" href="#">Share</a>
                    </div>
                </div>
                <a class="viewAll" href="#">View all</a>
            </div>
        </div>
        <!--container:end-->
        <!--ourPartners:start-->
        <!--ourPartners:end-->
        <!--body: end-->

    </div>
@endsection