<section class="content_style">
    <div class="carousel fade-carousel" data-ride="carousel" id="bs-carousel">
        <div class="carousel-inner">
            <div class="item slides active">
                <div class="slide-6"></div>
                {{--<div class="hero">--}}
                {{--<hgroup>--}}
                {{--<h2 class="loan_advisor" style="margin-bottom: 125px; font-weight:bold;">Register User</h2>--}}
                {{--</hgroup>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row  roundedbox">
        <br>
        <div class="col-md-12">
            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7535.135930625046!2d72.83992133038029!3d19.214063469810938!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b6d205db5f5f%3A0x14e163e194099896!2sHappy+To+Help+You!5e0!3m2!1sen!2sin!4v1419066658079" width="100%" height="300" frameborder="0" style="border:0"></iframe>--}}
            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1883.6234439255143!2d72.97266992062377!3d19.22806905431035!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b95e60c4af69%3A0xaafda71ec46053b8!2sNiwas+Homefin+Services+Pvt+Ltd!5e0!3m2!1sen!2sin!4v1439189310985" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD_K-8KEGRtJd8ioQlO5FmIcnivZshBR8g&q=SINE,+IIT+Bombay+Campus" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            <script>
                google.maps.event.addDomListener(window, 'load', init);
                var map;
                function init() {
                    var mapOptions = {
                        center: new google.maps.LatLng(36.580247, -41.817628),
                        zoom: 3,
                        zoomControl: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.DEFAULT,
                        },
                        disableDoubleClickZoom: true,
                        mapTypeControl: true,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                        },
                        scaleControl: true,
                        scrollwheel: true,
                        panControl: true,
                        streetViewControl: true,
                        draggable: true,
                        overviewMapControl: true,
                        overviewMapControlOptions: {
                            opened: false,
                        },
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                    }
                    var mapElement = document.getElementById('102  Lighbridge Hiranandani Meadows Thane 400610');
                    var map = new google.maps.Map(mapElement, mapOptions);
                    var locations = [
                        ['Niwas Homefin Services Pvt Ltd', 'undefined', 'undefined', 'undefined', 'undefined', 19.2270217, 72.97189230000004, 'https://mapbuildr.com/assets/img/markers/default.png']
                    ];
                    for (i = 0; i < locations.length; i++) {
                        if (locations[i][1] == 'undefined') {
                            description = '';
                        } else {
                            description = locations[i][1];
                        }
                        if (locations[i][2] == 'undefined') {
                            telephone = '';
                        } else {
                            telephone = locations[i][2];
                        }
                        if (locations[i][3] == 'undefined') {
                            email = '';
                        } else {
                            email = locations[i][3];
                        }
                        if (locations[i][4] == 'undefined') {
                            web = '';
                        } else {
                            web = locations[i][4];
                        }
                        if (locations[i][7] == 'undefined') {
                            markericon = '';
                        } else {
                            markericon = locations[i][7];
                        }
                        marker = new google.maps.Marker({
                            icon: markericon,
                            position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                            map: map,
                            title: locations[i][0],
                            desc: description,
                            tel: telephone,
                            email: email,
                            web: web
                        });
                        link = '';
                    }

                }
            </script>
            <style>
                #102  Lighbridge Hiranandani Meadows Thane  {
                    height:400px;
                    width:550px;
                }
                .gm-style-iw * {
                    display: block;
                    width: 100%;
                }
                .gm-style-iw h4, .gm-style-iw p {
                    margin: 0;
                    padding: 0;
                }
                .gm-style-iw a {
                    color: #4272db;
                }
            </style>

            <div id='102  Lighbridge Hiranandani Meadows Thane 400610'></div>
        </div>
     
        <div class="col-md-6 paragraph_style">
               @if(Session::has('flash_message'))
        <div class = "alert alert-success{{{Session::has('flash_message_important') ? ' alert-important' : ''}}}">
            @if(Session::has('flash_message_important'))
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @endif

            {{ Session::get('flash_message') }}
        </div>
        @endif
            
            <h3 class="center-align2"><span>Enquiry Form</span></h3>
            <div class="form-group">
                {!! Form::text('name', null, array('class' => 'form-control', 'id'=>'name', 'placeholder'=>'Name','data-mandatory'=>'M')) !!}
            </div>
            <div class="form-group">
                {!! Form::email('email', null, array('class' => 'form-control', 'id'=>'email', 'placeholder'=>'Email','data-mandatory'=>'M')) !!}
            </div>
            <div class="form-group">
                {!! Form::text('mobile', null, array('class' => 'form-control', 'id'=>'mobile', 'placeholder'=>'Mobile Number','data-mandatory'=>'M')) !!}
            </div>
            <div class="form-group">
                {!! Form::text('subject', null, array('class' => 'form-control', 'id'=>'subject', 'placeholder'=>'Subject','data-mandatory'=>'M')) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('message', null, array('class' => 'form-control', 'id'=>'message', 'placeholder'=>'Message','data-mandatory'=>'M')) !!}
            </div>

            <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
        </div>
        <div class="col-md-6 paragraph_style">
            <h3 class="center-align2"><span>Contact Information</span></h3>
            <p><i class="fa fa-map-marker"></i> Address
                <br>Niwas Homefin Services Pvt. Ltd.
                <br>3rd Floor, SINE, IIT Bombay Campus,
                <br>Powai, Mumbai - 400 076
            </p>
            <p><i class="fa fa-envelope"></i> <a href="mailto:contact@smeniwas.com">contact@smeniwas.com</a></p>
            <p><i class="fa fa-phone"></i> <a href="tel:+91-22-20852054">+91-22-20852054</a></p>
        </div>
    </div>
</div>