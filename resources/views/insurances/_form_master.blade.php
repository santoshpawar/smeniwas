<div class="container-fluid">
    <!-- Tab panes -->
    @if($sub_view_type == "insurances._choose_insurance")

    @else
        <section class="content_style2">
        </section>
    @endif
    {{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
    {{--<ul class="alert alert-danger">--}}
    {{--@foreach ($errors->all() as $error)--}}
    {{--<li>{{ $error }}</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--@endif--}}

    <section>
        <div class="container-fluid">
            <div class="row">
                @if($sub_view_type == "insurances._choose_insurance")
                    <div id="tab" class="btn-group leftside_tab" role = "group">
                        @if($sub_view_type == "insurances._choose_insurance")

                        @else
                            

                        @endif
                        @if(Auth::user()->isAnalyst() || Auth::user()->isAdmin() || Auth::user()->isBankUser())
                            

                        @endif
                        @if(Auth::user()->isBankUser())
                            
                        @endif
                    </div>
                @else
                    <div class="col-md-2">
                        <div id="tab" class="btn-group leftside_tab" role = "group">
                            @if($sub_view_type == "insurances._choose_insurance")

                            @else
                              <a style="width:100%;" href="{{{URL::to('insurances/fire-insurance/'.$insuranceType.'/'.$insuranceId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "insurances._fire_insurance" ? 'active' : ''}}}" role="button">Fire Insurance</a>      
                              <a style="width:100%;" href="{{{URL::to('insurances/marine-insurance/'.$insuranceType.'/'.$insuranceId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "insurances._marine_insurance" ? 'active' : ''}}}" role="button">Marine Insurance</a>      
                              <a style="width:100%;" href="{{{URL::to('insurances/industrial-insurance/'.$insuranceType.'/'.$insuranceId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "insurances._industrial_insurance" ? 'active' : ''}}}" role="button">Industrial Insurance</a>      
                              <a style="width:100%;" href="{{{URL::to('insurances/shop-insurance/'.$insuranceType.'/'.$insuranceId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "insurances._shop_insurance" ? 'active' : ''}}}" role="button">Shop Insurance</a>      
                              <a style="width:100%;" href="{{{URL::to('insurances/corporate-insurance/'.$insuranceType.'/'.$insuranceId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "insurances._corporate_insurance" ? 'active' : ''}}}" role="button">Corporate Insurance</a>      
                              <a style="width:100%;" href="{{{URL::to('insurances/fire-insurance/'.$insuranceType.'/'.$insuranceId)}}}" class="btn btn-large btn-success btn-space lefttabbtn" role="button">Liability Insurance</a>      

                            @endif
                            @if(Auth::user()->isAnalyst() || Auth::user()->isAdmin() || Auth::user()->isBankUser())
                                

                            @endif
                            @if(Auth::user()->isBankUser())
                                    
                            @endif
                        </div>
                    </div>
                @endif
                <div class="col">
                    <?php
                    if(!isset($insuranceId)){
                        $insuranceId = "''";
                    }
                    ?>
                    @include($sub_view_type)
                </div>
            </div>
        </div>

    </section>
</div><!-- end container -->

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