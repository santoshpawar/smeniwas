<div class="col-md-9" id="sme-details">
    <div class="tab-content tab-design" style="padding:20px;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label(null,'&nbsp;') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_of_firm','Name of Firm *') !!}
                    {!! Form::text('name_of_firm',null,['class' => 'form-control']) !!}
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
                    {!! Form::label(null,'Contact Details of Company *') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mobile','Mobile No. *') !!}
                    {!! Form::text('mobile',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('website','Website') !!}
                    {!! Form::text('website',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('landline','Landline No. *') !!}
                    {!! Form::text('std_code',null,['class' => 'form-control']) !!}<br><br>
                    {!! Form::text('landline',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('purpose_of_loan','Purpose Of Loan *') !!}
                    {!! Form::select('purpose_of_loan',$purpose_of_loan, $chosenPurposeOfLoan, ['id' => 'purpose_of_loan', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('required_amount','Required Amount  (Rs Lacs) *') !!}
                    {!! Form::text('required_amount',null,['class' => 'form-control']) !!}
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

        <div class="row">
            <div class="col-md-12" style="margin-left:20px;">
                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'window.location.href="/register/sme"')) !!}
                {!! Form::submit('Save & Continue', ['class' => 'btn btn-success btn-cons sme_button']) !!}
            </div>
        </div>
    </div>
<div>


@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

    {{--<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>--}}

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

        $(document).ready(function() {

            $("#operating_address").change(function(){
                if($('#operating_address').is(':checked')){
                    $("#operatingAdd").hide();
                }
                else{
                    $("#operatingAdd").show();
                }
            });
            if($('#operating_address').is(':checked')){
                $("#operatingAdd").hide();
                $("#operatingAdd").find(":text").val('');
                $("#operatingAdd").find(":selected").text('');


            }
            $("#operating_address").change(function(){
                if($('#operating_address').is(':checked')){
                    $("#operatingAdd").hide();
                    $("#operatingAdd").find(":text").val('');
                    $("#operatingAdd").find(":selected").text('');
                }
                else{
                    $("#operatingAdd").show();
                }

            });
        });
    </script>
@endsection