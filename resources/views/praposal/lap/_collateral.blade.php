<div id="divTC-Div2">
    <div class="form-group">
        {!! Form::label(null,'Security being provided') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::hidden('loan_id', $loanId ) !!}
    </div>
    <hr/>
    <div class="form-group">
        {!! Form::label('property','Details of Property', ['id' => 'label_property_types']) !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::label('property','(?)', ['title' => 'INR in Lakhs']) !!}
        {!! Form::select('property_name', $propertyTypes, $choosenPropertyName, ['id' => 'property_types', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group" id="commercial_type">
        {!! Form::label('property_types','Type', ['class' => 'label_commercial_types']) !!}
        {!! Form::label(null,'*', ['class' => 'redmarks label_commercial_types']) !!}
        {!! Form::label('property_types','(?)', ['title' => 'INR in Lakhs', 'class' => 'label_commercial_types']) !!}
        {!! Form::select('property_type[]', $commercialTypes, $choosenPropertyType, ['id' => 'commercial_types', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group" id="residential_type">
        {!! Form::label('property_types','Type', ['class' => 'label_residential_types']) !!}
        {!! Form::label(null,'*', ['class' => 'redmarks label_residential_types']) !!}
        {!! Form::label('property_types','(?)', ['title' => 'INR in Lakhs', 'class' => 'label_residential_types']) !!}
        {!! Form::select('property_type[]', $residentialTypes, $choosenPropertyType, ['id' => 'residential_types', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group" id="land_type">
        {!! Form::label('property_types','Type', ['class' => 'label_land_types']) !!}
        {!! Form::label(null,'*', ['class' => 'redmarks label_land_types']) !!}
        {!! Form::label('property_types','(?)', ['title' => 'INR in Lakhs', 'class' => 'label_land_types']) !!}
        {!! Form::select('property_type[]', $landTypes, $choosenPropertyType, ['id' => 'land_types', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('approx_amount','Approx Valuation ( ') !!}
        {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label('approx_amount',' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('approx_value', $choosenApproxValue, array('class' => 'form-control')) !!}
    </div>
    <hr/>
    <div class="form-group">
        {!! Form::label('location','Location of Property') !!}
        {!! Form::label(null,' *', ['class' => 'redmarks']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[address1]','Address 1') !!}
        {!! Form::label(null,' *', ['class' => 'redmarks']) !!}
        {!! Form::textarea('registeredAddress[address1]', null, ['class' => 'form-control', 'rows' => '2']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[address2]','Address 2') !!}
        {!! Form::textarea('registeredAddress[address2]', null, ['class' => 'form-control', 'rows' => '2']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[address3]','Address 3') !!}
        {!! Form::textarea('registeredAddress[address3]', null, ['class' => 'form-control', 'rows' => '2']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[city]','City') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('registeredAddress[city]', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[state]','State') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::select('registeredAddress[state]', $states, $chosenState, ['id' => 'state', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[pincode]','Pincode') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('registeredAddress[pincode]', null, ['class' => 'form-control']) !!}
    </div>
    <hr/>
    <div class="form-group">
        {!! Form::label('loan_amount','Details of Property Owner') !!}
        {!! Form::label(null,' *', ['class' => 'redmarks']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('owner','Details of Owner') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('owner','(?)', ['title' => 'INR in Lakhs']) !!}
        {!! Form::select('owner_type', $ownerList, null, ['class' => 'form-control', 'id' => 'owner_type']) !!}
    </div>
    <hr/>
    <div class="form-group">
        {!! Form::label('loan_amount','Third Party Details', ['id' => 'label_third_party']) !!}
    </div>
    <div class="third_party">
        <div class="form-group">
            {!! Form::label('name','Name') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::label('name','(?)', ['title' => 'Name']) !!}
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('relationship','Relationship with Applicant') !!}
            {!! Form::label('relationship','(?)', ['title' => 'Relationship']) !!}
            {!! Form::select('relationship', $relationWithApplicantTypes, null, ['id' => 'relationshipWithApplicant', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('pan','PAN') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::label('pan','(?)', ['title' => 'PAN']) !!}
            {!! Form::text('pan', null, array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('thirdpartyAddress[address1]','Address 1') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::textarea('thirdpartyAddress[address1]', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('thirdpartyAddress[address2]','Address 2') !!}
            {!! Form::textarea('thirdpartyAddress[address2]', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('thirdpartyAddress[address3]','Address 3') !!}
            {!! Form::textarea('thirdpartyAddress[address3]', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('thirdpartyAddress[city]','City') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::text('thirdpartyAddress[city]', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('thirdpartyAddress[state]','State') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::select('thirdpartyAddress[state]', $states, $chosenThirdPartyState, ['id' => 'state_third_party', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('thirdpartyAddress[pincode]','Pincode') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::text('thirdpartyAddress[pincode]', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('notice', '(All ') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div1'); return false;", 'value'=> 'Back' )) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>
@section('footer')
    <script>
        $(document).ready(function () {
            $('#state').select2({
                allowClear: true,
                placeholder: "Select State"
            });
            $('#relationshipWithApplicant').select2({
                allowClear: true,
                placeholder: "Select Relationship"
            });
           $(".third_party").hide();
            $("#label_third_party").prev().hide();
            $("#label_third_party").hide();

            $('#property_types').select2({
                allowClear: true,
                placeholder: "Select Property Type"
            });
            $("#commercial_type").hide();
            $("#residential_type").hide();
            $("#land_type").hide();
            $("#state").next().children().show();

            $('#property_types').change(function (){
                //$("span.selection:not(:first)").hide();
               // $("#state").next().children().show();

                if(this.value === 'Commercial') {
                    $("#commercial_type").show();
                    $('#commercial_types').select2({
                        allowClear: true,
                        placeholder: "Select Commercial Type"
                    });
                    $("#residential_type").hide();
                    $("#land_type").hide();

                } else if(this.value === 'Residential' ){
                    $("#residential_type").show();
                    $('#residential_types').select2({
                        allowClear: true,
                        placeholder: "Select Residential Type"
                    });
                    $("#commercial_type").hide();
                    $("#land_type").hide();
                } else if(this.value === 'Land Non-Agri') {
                    $("#land_type").show();
                    $('#land_types').select2({
                        allowClear: true,
                        placeholder: "Select Land Type"
                    });
                    $("#residential_type").hide();
                    $("#commercial_type").hide();

                } else if (this.value === 'Land Agri') {
                    $("#land_type").hide();
                    $("#residential_type").hide();
                    $("#commercial_type").hide();
                } else if(this.value === 'Industrial') {
                    $("#land_type").hide();
                    $("#residential_type").hide();
                    $("#commercial_type").hide();
                }


            });
            if($('#property_types').val()== 'Commercial'){
                $("#commercial_type").show();
                $('#commercial_types').select2({
                    allowClear: true,
                    placeholder: "Select Commercial Type"
                });
                $("#residential_type").hide();
                $("#land_type").hide();
            }
            if($('#property_types').val()== 'Residential'){
                $("#residential_type").show();
                $('#residential_types').select2({
                    allowClear: true,
                    placeholder: "Select Residential Type"
                });
                $("#commercial_type").hide();
                $("#land_type").hide();
            }
            if($('#property_types').val()== 'Land Non-Agri'){
                $("#land_type").show();
                $('#land_types').select2({
                    allowClear: true,
                    placeholder: "Select Land Type"
                });
                $("#residential_type").hide();
                $("#commercial_type").hide();
            }

            if($("#owner_type").val() == 'Third Party'){
                $(".third_party").show();
            }
            $('#owner_type').select2({
                allowClear: true,
                placeholder: "Select Owner"
            });
            $("#owner_type").change(function() {
                if($(this).val() === 'Third Party') {
                    $(".third_party").fadeIn();
                    $("#label_third_party").prev().show();
                    $("#label_third_party").fadeIn();
                    $('#state_third_party').select2({
                        allowClear: true,
                        placeholder: "Select State"
                    });
                } else if($(this).val() === 'Self') {
                    $(".third_party").fadeOut();
                    $("#label_third_party").prev().hide();
                    $("#label_third_party").hide();
                }else{
                    $(".third_party").hide();
                    $("#label_third_party").prev().hide();
                    $("#label_third_party").hide();
                }
            });


        });

    </script>
@endsection