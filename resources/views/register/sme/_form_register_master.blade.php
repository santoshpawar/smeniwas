<div class="container-fluid">

    <!-- Tab panes -->
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
        <div class="container-fluid" style="margin-top: 2%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid main-container">

                        <div class="clearfix"></div>
                        <div class="row">
                            {{--<div class="col-md-3">--}}
                                {{--<div id="tab" class="btn-group leftside_tab" role = "group">--}}
                                    {{--<a style="width:100%;" href="{{{URL::to('/register/sme')}}}" class="btn btn-large btn-info {{{$sub_view_type == "register.sme._form_register" ? 'active' : ''}}}" role="button">Registration</a>--}}
                                    {{--<a style="width:100%;" href="{{{URL::to('/register/sme/details')}}}" class="btn btn-large btn-info {{{$sub_view_type == "register.sme._form_details" ? 'active' : ''}}}" role="button">SME Details</a>--}}
                                    {{--<a style="width:100%;" href="{{{URL::to('/register/sme/promoter')}}}" class="btn btn-large btn-info {{{$sub_view_type == "register.sme._form_promoter" ? 'active' : ''}}}" role="button">Promoter</a>--}}
                                    {{--<a style="width:100%;" href="{{{URL::to('/register/sme/financial')}}}" class="btn btn-large btn-info {{{$sub_view_type == "register.sme._form_financial" ? 'active' : ''}}}" role="button">PAN Details</a>--}}
                                    {{--<a style="width:100%;" href="{{{URL::to('/register/sme/subsidiary')}}}" class="btn btn-large btn-info {{{$sub_view_type == "register.sme._form_subsidiary" ? 'active' : ''}}}" role="button">Subsidiary</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col" style="margin-left:20px;">
                                @include($sub_view_type)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- end container -->

@section('footer')
    <script>
        $(document).ready(function()
        {
            $('#loan_product').select2({
                allowClear: true,
                placeholder: "Select Loan Product Type"
            });
            $('#loan_tenure').select2({
                allowClear: true,
                placeholder: "Select Tenure"
            });
        });
    </script>
@append


