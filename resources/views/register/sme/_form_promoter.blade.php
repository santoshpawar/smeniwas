<div class="col-md-9" id="promoter">
    <div class="tab-content tab-design" style="padding:20px;">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('owner_name','Main Promoter/Owner name *') !!}
                    {!! Form::text('owner_name',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('owner_email','Main Promoter Email Id *') !!}
                    {!! Form::email('owner_email',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('owner_mobile','Mobile No. *') !!}
                    {!! Form::text('owner_mobile',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('owner_pan','Main Promoter/Owner PAN *') !!}
                        {!! Form::text('owner_pan',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('landline','Landline No 1. *') !!}
                        {!! Form::text('owner_std_code',null,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('landline','Landline No 2. *') !!}
                        {!! Form::text('owner_landline',null,['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="margin-left:20px;">
                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'window.location.href="/register/sme/details"')) !!}
                {!! Form::submit('Save & Continue', ['class' => 'btn btn-success btn-cons sme_button']) !!}
            </div>
        </div>
    </div>
</div>

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $('#entity_type').select2({
            allowClear: true,
            placeholder: "Select Entity Type"
        });
        $('#purpose_of_loan').select2({
            allowClear: true,
            placeholder: "Select Purpose of Loan"
        });
        $('#business_nature').select2({
            allowClear: true,
            placeholder: "Select Business Nature"
        });
        $('#industry_type').select2({
            allowClear: true,
            placeholder: "Select Industry Type"
        });
        $('#state').select2({
            allowClear: true,
            placeholder: "Select State"
        });
        $('#operatingAddress_state').select2({
            allowClear: true,
            placeholder: "Select State"
        });


    </script>
@endsection
