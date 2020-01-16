<div class="col-md-9" id="subsidiary">
    <div class="tab-content tab-design" style="padding:20px;">

        <div class="form-group">

            {!! Form::label('is_subsidiary','Do you have any Subsidiary/Associate company?*') !!}
            @if($choosenisSubsidiary == 1)
                {!! Form::select('is_subsidiary', array('placeholder' => '--select--', '1' => 'Yes', '0' => 'No'),['id' => 'is_subsidiary','class' => 'form-control']); !!}
            @else
                {!! Form::select('is_subsidiary', array('placeholder' => '--select--', '1' => 'Yes', '0' => 'No'),['id' => 'is_subsidiary','class' => 'form-control']); !!}
            @endif

        </div>
        <div id="divSuCompanyDetails">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label(null,'&nbsp;') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('owner_pan','PAN No') !!}
                        {!! Form::text('owner_pan',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name','Name of Subsidiary/Associate Company *') !!}
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('entity_type','Type of Legal Entity *') !!}
                        {!! Form::select('entity_type',$entityTypes,$chosenEntity, ['id' => 'entity_type','class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('business_nature','Nature of Business *') !!}
                        {!! Form::select('business_nature',$businessNatures, $chosenBusinessNature, ['id' => 'business_nature','class' => 'form-control'])
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('industry_type','Type of Industry *') !!}
                        {!! Form::select('industry_type',$industryType, $chosenIndustryType, ['id' => 'industry_type', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('business_details','Brief Details of Business *') !!}
                        {!! Form::textarea('business_details',null,['class' => 'form-control', 'size' => '10x5']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label(null,'Promoter/Owner Details *') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('owner_name','Name *') !!}
                        {!! Form::text('owner_name',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('owner_email','Email ID *') !!}
                        {!! Form::email('owner_email',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('owner_mobile','Mobile No. *') !!}
                        {!! Form::text('owner_mobile',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('landline','Landline No. *') !!}
                        {!! Form::text('std_code',null,['class' => 'form-control']) !!}<br><br>
                        {!! Form::text('landline',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('incorporation_date','Date of Incorporation *') !!}
                        {!! Form::text('incorporation_date','',['class' => 'form-control','id' => 'datepicker']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('tan','TAN *') !!}
                        {!! Form::text('tan',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('service_tax_number','Service Tax Number *') !!}
                        {!! Form::text('service_tax_number',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('vat_number','VAT Number *') !!}
                        {!! Form::text('vat_number',null,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" style="  margin-left: auto;">
                        {!! Form::label(null,'Registered Address *') !!}
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('registeredAddress[address1]','Address 1 *') !!}
                            {!! Form::text('registeredAddress[address1]',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('registeredAddress[address2]','Address 2 *') !!}
                            {!! Form::text('registeredAddress[address2]',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('registeredAddress[address3]','Address 3') !!}
                            {!! Form::text('registeredAddress[address3]',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('registeredAddress[city]','City *') !!}
                            {!! Form::text('registeredAddress[city]',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('registeredAddress[state]','State *') !!}
                            {!! Form::select('registeredAddress[state]',$states,$chosenState,['id' => 'state', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('registeredAddress[pincode]','Pincode *') !!}
                            {!! Form::text('registeredAddress[pincode]',null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label(null,'Operating Address') !!}

                            {!! Form::checkbox('operating_address' , '1',$isOperatingAddressSameAsRegistered, ['id' => 'operating_address']) !!}
                            {!! Form::label('operating_address','Same as Above') !!}
                        </div>
                    </div>
                    <div id="operatingAdd">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('operatingAddress[address1]','Address 1 *') !!}
                                {!! Form::text('operatingAddress[address1]',null,['class' => 'form-control','id'=>'field']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('operatingAddress[address2]','Address 2 *') !!}
                                {!! Form::text('operatingAddress[address2]',null,['class' => 'form-control','id'=>'field']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('operatingAddress[address3]','Address 3') !!}
                                {!! Form::text('operatingAddress[address3]',null,['class' => 'form-control','id'=>'field']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('operatingAddress[city]','City *') !!}
                                {!! Form::text('operatingAddress[city]',null,['class' => 'form-control','id'=>'field']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('operatingAddress[state]','State *') !!}
                                {!! Form::select('operatingAddress[state]',$states,$chosenOperatingState,['id' => 'operatingAddress_state', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('operatingAddress[pincode]','Pincode *') !!}
                                {!! Form::text('operatingAddress[pincode]',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label(null,'(All * marked fields are mandatory)') !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="margin-left:20px;">
                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'window.location.href="/register/sme/financial"')) !!}
                {!! Form::submit('Save & Continue', ['class' => 'btn btn-success btn-cons sme_button']) !!}
            </div>
        </div>

    </div>
</div>

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    <script>

        $('#entity_type').select2({
            allowClear: true,
            placeholder: "Select Entity Type"
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

        $(document).ready(function() {

            if($('#is_subsidiary :selected').val() == '0') {
                $("#divSuCompanyDetails").hide();
                //return false;
            }
            $('#is_subsidiary').change(function(){
                if($('#is_subsidiary').val() =='1'){
                    $("#divSuCompanyDetails").show();
                }
                else if($('#is_subsidiary').val() =='0'){
                    $("#divSuCompanyDetails").hide();
                }
                else if($('#is_subsidiary').text() =='--select--'){
                    $("#divSuCompanyDetails").hide();
                }

                $("#operating_address").change(function(){
                    if($('#operating_address').is(':checked')){
                        //alert("hello");
                        $("#operatingAdd").hide();
                        // $(this).val('1');
                    }
                    else{
                        $("#operatingAdd").show();
                    }

                });

            });
            if($('#operating_address').is(':checked')){
                $("#operatingAdd").hide();
            }
            $("#operating_address").change(function(){
                if($('#operating_address').is(':checked')){
                    $("#operatingAdd").hide();
                }
                else{
                    $("#operatingAdd").show();
                }

            });




        });

    </script>

    <script src="{{ asset('/js/jquery-ui.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
@endsection