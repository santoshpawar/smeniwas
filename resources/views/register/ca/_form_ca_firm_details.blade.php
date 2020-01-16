<div id="divTC-Div9">

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name','Name of Firm*') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
        {!! $errors->first('name','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('entity_type','Type of Legal Entity *') !!}
        {!! Form::select('entity_type',$entityTypes,$chosenEntity, ['id' => 'entity_type','class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label(null,'Contact Details of Firm *') !!}
    </div>

    <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
        {!! Form::label('mobile','Mobile No. *') !!}
        {!! Form::text('mobile',null,['class' => 'form-control']) !!}
        {!! $errors->first('mobile','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('website','Website') !!}
        {!! Form::text('website',null,['class' => 'form-control']) !!}

    </div>

    <div class="form-group">
        {!! Form::label('landline','Landline No. *') !!}
    </div>
    <div class="form-group {{ $errors->has('std_code') ? 'has-error' : '' }}">
        {!! Form::text('std_code',null,['class' => 'form-control']) !!}
        {!! $errors->first('std_code','<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group {{ $errors->has('landline') ? 'has-error' : '' }}">
        {!! Form::text('landline',null,['class' => 'form-control']) !!}
        {!! $errors->first('landline','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::label(null,'Registered Address *') !!}
    </div>

    <div class="form-group">
        {!! Form::label('registeredAddress[address1]','Address 1 *') !!}
        {!! Form::text('registeredAddress[address1]',null,['class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[address2]','Address 2 *') !!}
        {!! Form::text('registeredAddress[address2]',null,['class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[address3]','Address 3') !!}
        {!! Form::text('registeredAddress[address3]',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[city]','City *') !!}
        {!! Form::text('registeredAddress[city]',null,['class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[state]','State *') !!}
        {!! Form::select('registeredAddress[state]',$states,$chosenState,['id' => 'state', 'class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[pincode]','Pincode *') !!}
        {!! Form::text('registeredAddress[pincode]',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group {{ $errors->has('operating_address') ? 'has-error' : '' }}">
        {!! Form::label(null,'Operating Address') !!}

        {!! Form::checkbox('operating_address' , '1',null, ['id' => 'operating_address']) !!}
        {!! Form::label('operating_address','Same as Above') !!}
    </div>
    <div id="operatingAdd">
        <div class="form-group">
            {!! Form::label('operatingAddress[address1]','Address 1 *') !!}
            {!! Form::text('operatingAddress[address1]',null,['class' => 'form-control']) !!}

            {!! Form::label('operatingAddress[address2]','Address 2 *') !!}
            {!! Form::text('operatingAddress[address2]',null,['class' => 'form-control']) !!}

            {!! Form::label('operatingAddress[address3]','Address 3') !!}
            {!! Form::text('operatingAddress[address3]',null,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('operatingAddress[city]','City *') !!}
            {!! Form::text('operatingAddress[city]',null,['class' => 'form-control']) !!}

            {!! Form::label('operatingAddress[state]','State *') !!}
            {!! Form::select('operatingAddress[state]',$states,$chosenState,['id' => 'operatingAddress_state', 'class' => 'form-control']) !!}

            {!! Form::label('operatingAddress[pincode]','Pincode *') !!}
            {!! Form::text('operatingAddress[pincode]',null,['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('purpose_of_loan','Purpose Of Loan *') !!}
        {!! Form::select('purpose_of_loan',$purpose_of_loan, $chosenPurposeOfLoan, ['id' => 'purpose_of_loan', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('required_amount','Required Amount  (Rs Lacs) *') !!}
        {!! Form::text('required_amount',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label(null,'(All * marked fields are mandatory)') !!}
    </div>
    <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-12">
        {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn btn',
        'onclick' => 'window.location.href="/register/ca"')) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>

</div>

@section('footer')
    <script>
        $(document).ready(function() {
            $('#entity_type').select2({
                allowClear: true,
                placeholder: "Select Entity Type"
            });
            $('#purpose_of_loan').select2({
                allowClear: true,
                placeholder: "Select Purpose of Loan"
            });
            $('#state').select2({
                allowClear: true,
                placeholder: "Select State"
            });
            $('#operatingAddress_state').select2({
                allowClear: true,
                placeholder: "Select State"
            });
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