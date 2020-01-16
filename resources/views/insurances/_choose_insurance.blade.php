    {{--<section class="content_style">--}}
        {{--<div class="carousel fade-carousel slide" data-ride="carousel" id="bs-carousel">--}}
            {{--<div class="carousel-inner">--}}
                {{--<div class="item slides active">--}}
                    {{--<div class="slide-4"></div>--}}
                    {{--<div class="hero">--}}
                        {{--<hgroup>--}}
                            {{--<h2 class="loan_advisor">Loan Advisor</h2>--}}
                        {{--</hgroup>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <section class="content_style" style="margin-left:-16px;margin-right:-15px;">
        <div class="carousel fade-carousel slide" data-ride="carousel" id="bs-carousel">
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-4"></div>
                    {{--<div class="hero">
                        <hgroup>
                            <h2 class="loan_advisor">Loan Advisor</h2>
                        </hgroup>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>


    <div class="container-fluid" style="">
    {{--<section>--}}
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="tab-content tab-design" style="border-radius: 2px;">
                        <div class="container-fluid main-container">
                            <div class="col-md-12 content">
                                <div class="row" style="margin-left: -17px;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::hidden('isMobileData', 0) !!}
                                            {!! Form::hidden('id', $userID) !!}
                                            {!! Form::label('business_type', 'Select Business Type') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            @if(isset($businessType))
                                                {!! Form::select('business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $businessType, ['class' => 'form-control','id'=>'businessType','data-mandatory'=>'M' ,$setDisable])!!}
                                            @else
                                                {!! Form::select('business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['class' => 'form-control','id'=>'businessType','data-mandatory'=>'M' ,$setDisable])!!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="manufacturing_location">
                                        <div class="form-group">
                                            {!! Form::label('number_mfglocations', 'Number of Manufacturing locations of your business',['class'=>'control-label',$setDisable]) !!}
                                            <br>
                                            <label class="radio-inline">
                                                {!! Form::radio('number_mfglocations', 'option_1', true, ['id' => 'mfgradio_option_1']) !!}
                                                1
                                            </label>
                                            <label class="radio-inline">
                                                {!! Form::radio('number_mfglocations', 'option_2', false, ['id' => 'mfgradio_option_2']) !!}
                                                2 - 4
                                            </label>
                                            <label class="radio-inline">
                                                {!! Form::radio('number_mfglocations', 'option_3', false, ['id' => 'mfgradio_option_3']) !!}
                                                > 4
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('industry_segment', 'Select Industry Segment') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::select('industry_segment', $industryTypes, null, ['class' => 'form-control', 'id' => 'industry_segment','data-mandatory'=>'M' ,$setDisable])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('co_business_old', 'How many years old is the business/company?') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::select('co_business_old', $businessVintage,null,['class' => 'form-control','id'=>'business_old','data-mandatory'=>'M' ,$setDisable]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('key_productservice_offered','Key Products/Services Offered (give brief description)') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            @if(isset($mobileKeyProduct))
                                                {!! Form::textarea('key_productservice_offered', isset($mobileKeyProduct)? $mobileKeyProduct:null, array('class' => 'form-control','id'=>'key_productservice_offered', 'placeholder' => 'Give brief description', 'size' => '10x3','data-mandatory'=>'M' ,$setDisable)) !!}
                                            @else
                                                {!! Form::textarea('key_productservice_offered', isset($key_products_manufactured)? $key_products_manufactured:null, array('class' => 'form-control','id'=>'key_productservice_offered', 'placeholder' => 'Give brief description', 'size' => '10x3','data-mandatory'=>'M' ,$setDisable)) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::hidden('isMobileData', 0) !!}
                                            {!! Form::hidden('id', $userID) !!}
                                            {!! Form::label('insurance_product','Insurance Product:') !!}<br>
                                            {!! Form::select('insurance_product',$insurance_product, $chosenInsuranceProduct, ['id' => 'insurance_product', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('policy_exists','Do you have any existing insurance policy') !!}
                                            {!! Form::label('policy_exists', '*', ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!! Form::select('policy_exists', $yesnotype, $chosenYesNoType, ['id' => 'policy_exists','class' => 'form-control', 'style' => 'width:100%;']) !!}
                                        </div>
                                    </div>
                                    <!-- start of engEquipment -->
                                    <div id="existingPolicyDetails" class="collapse">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="dynamic" class="form-group" style="margin-left: auto;">
                                                    @for($formIndex=0; $formIndex < $maxAnotherTypes; $formIndex++)

                                                        <?php $colorstyle = ""; ?>
                                                        @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )

                                                        <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                                                        @else
                                                        <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                                                        @endif

                                                        @if($formIndex == 0)
                                                            <div id="existingPolicyOptn_{{$formIndex}}" class="panel panel-success">
                                                                <div class="panel-heading">Existing Policy Details</div>
                                                        @else
                                                            <div id="existingPolicyOptn_{{$formIndex}}" class="panel panel-success collapse">
                                                                <div class="panel-heading">Existing Policy Details - {{($formIndex)}}</div>
                                                        @endif
                                       
                                                                <div class="row">
                                                                    <br>
                                                                    <div class="col-lg-12">
                                                                        <div class="col-md-6" style="padding-bottom:20px">
                                                                            {!! Form::label('name_of_insured_comp'.$formIndex,'Name of Insured Company') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('existingPolicy['.$formIndex.'][name_of_insured_comp]', null, array('class' => 'form-control', 'id'=>'name_of_insured_comp_'.$formIndex, 'placeholder'=>'Name of Insured Company','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-3" style="padding-bottom:20px">
                                                                            {!! Form::label('sum_insured'.$formIndex,'Sum Insured ( ') !!}
                                                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                                            {!! Form::label(null,' In Lacs )') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('existingPolicy['.$formIndex.'][sum_insured]', null, array('class' => 'form-control', 'id'=>'sum_insured_'.$formIndex, 'placeholder'=>'Sum Insured','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-3" style="padding-bottom:20px">
                                                                            {!! Form::label('annual_premium'.$formIndex,'Annual Primium ( ') !!}
                                                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                                            {!! Form::label(null,' In Lacs )') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('existingPolicy['.$formIndex.'][annual_premium]', null, array('class' => 'form-control', 'id'=>'annual_premium_'.$formIndex, 'placeholder'=>'Annual Premium','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-3" style="padding-bottom:20px">
                                                                            {!! Form::label('any_claims'.$formIndex,'Any claims in the last one year') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::select('existingPolicy['.$formIndex.'][any_claims]', $yesnotype, $chosenYesNoType, ['id' => 'any_claims_'.$formIndex,'class' => 'form-control', 'style' => 'width:100%;']) !!}
                                                                        </div>
                                                                        <div class="col-md-3 collapse" style="padding-bottom:20px" id="cAmount_{{{$formIndex}}}">
                                                                            {!! Form::label('claim_amount'.$formIndex,'Claim Amount ( ') !!}
                                                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                                            {!! Form::label(null,' In Lacs )') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('existingPolicy['.$formIndex.'][claim_amount]', null, array('class' => 'form-control', 'id'=>'claim_amount'.$formIndex, 'placeholder'=>'Claim Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-6 collapse" style="padding-bottom:20px" id="cReason_{{{$formIndex}}}">
                                                                            {!! Form::label('claim_reason'.$formIndex,'Manufacturer') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('existingPolicy['.$formIndex.'][claim_reason]', null, array('class' => 'form-control', 'id'=>'claim_reason_'.$formIndex, 'placeholder'=>'Manufacturer','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                    @endfor
                                                    {!! Form::hidden('policy_counter_storage', 0, array('id' => 'policy_counter_storage')) !!}
                                                    {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
                                                            </div>
                                                    <div class="form-group" style="padding-left: 20px;">
                                                        {!! Form::button('Add Another Policy Details', ['class'=>'btn btn-primary add_promo_button', 'id'=>'add_policy_details', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                                        {!! Form::button('Remove Policy Details', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'rem_policy_details', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- end of engEquipment -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-left:10px;">
                                        {!! Form::button('Start Application <i class="fa fa-chevron-right"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save', 'style' => 'margin-top:20px;' )) !!}
                                        {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;' )) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    {{--</section>--}}
    </div><!-- end container -->


@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sme.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#chooseLoan').on('submit', function(e){
                e.preventDefault();
                var amount = $('#amount').val();
                var loan_product = $('#loan_product').val();

                if (amount > 100 && loan_product === 'UBL') {
                    var myWindow = window.open('', 'formpopup', 'width=400,height=200,resizeable,scrollbars');
                    myWindow.document.write("<p>Only amounts < 1 crore are supported for Unsecured Business Loans</p>");
//                    form.target = 'formpopup';
//                    alert('Only amounts < 1 crore are supported for Unsecured Business Loans');
                }
                else{
                    this.submit();
                }
            });
        });

        $('#businessType').select2({
            allowClear: true,
            placeholder: "Select Business Type"
        });

        $('#industry_segment').select2({
            allowClear: true,
            placeholder: "Select option"
        });

        $('#policy_exists').select2({
            allowClear: true,
            placeholder: "Select option"
        });

        $('#business_old').select2({
            allowClear: true,
            placeholder: "Select option"
        });

        $('#policy_exists').change(function () {
            if ($(this).val() == '1') {
                $('#existingPolicyDetails').show();
            } else {
                $('#existingPolicyDetails').hide();
            }
        });


        if ($("#businessType option:selected").val().length == 0) {
            $('#manufacturing_location').hide();
        }
        
        $("#businessType" ).change(function () {
            if ($("#businessType option:selected").val() == 'Manufacturing') {
                $('#manufacturing_location').show();
                $('#manufacturing_location').after("<div class='clearfix'></div>");
            } else {
                $('#manufacturing_location').hide();
                $(".clearfix").remove();
            }
        });

        var counter = 0; // Hidden Field inventory Counter Variable
        var existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        var add_button = jQuery("#add_policy_details");
        var delete_button = jQuery("#rem_policy_details");
        var no_of_opened_containers = $("#no_of_opened_containers").val();

        for (var i = 0; i < existing_records; i++) {
            $("#existingPolicyOptn_" + i).collapse("show");
            counter = i;
            $("#policy_counter_storage").val(i);
        }

        var a = $("#policy_counter_storage").val();
        if (a > 0) {
            for (var i = 1; i <= a; i++) {
                $("#existingPolicyOptn_" + i).collapse("show");
                if (i == 4) {
                    add_button.hide();
                }
                counter = i;
            }
        }

        if (counter == 0) {
            $(delete_button).hide();
        }

        $(add_button).click(function(e){
            e.preventDefault();
            counter++;
            $("#policy_counter_storage").val(counter);
            existing_records++;
            $("#existingPolicyOptn_" + counter).collapse("show");
            if (counter == 3) {
                $(this).hide();
            }
            if (counter > 0) {
                $(delete_button).show();
            }
        });

        $(delete_button).click(function (e) {
            e.preventDefault();
            $("#existingPolicyOptn_" + counter).collapse("hide");
            counter--;
            $("#policy_counter_storage").val(counter);
            existing_records--;
            if (counter == 0) {
                $(delete_button).hide();
            }
            if (counter < 3) {
                $(add_button).show();
            }
        });


        @for ($recordNum = 0; $recordNum < 4; $recordNum++)
            
            $('#any_claims_{{{$recordNum}}}').select2({
                allowClear: true,
                placeholder: "Select option"
            });
            
            $('#any_claims_{{{$recordNum}}}').change(function () {
                console.log('#any_claims_{{{$recordNum}}}', $('#any_claims_{{{$recordNum}}}').val());
                if ($('#any_claims_{{{$recordNum}}}').val() == '1') {
                    $('#cAmount_{{{$recordNum}}}').show();
                    $('#cReason_{{{$recordNum}}}').show();
                } else {
                    $('#cAmount_{{{$recordNum}}}').hide();
                    $('#cReason_{{{$recordNum}}}').hide();
                }
            });
        @endfor


//        function SubmitForm()
//        {
//            var loan_product = $('#loan_product').val();
//            var amount = $('#amount').val();
//            alert(loan_product);exit;
//
//            if($("#emailDeals").is(':checked')){
//                document.forms['eclub'].action='http://cl.exct.net/subscribe.aspx';
//                document.forms['eclub'].target='_blank';
//                document.forms['eclub'].submit();
//            }
//            if($("#mobileDeals").is(':checked')){
//                document.forms['eclub'].action='/assets/waterfall/waterfall_rest.php';
//                document.forms['eclub'].submit();
//            }
//        }

        $('#insurance_product').select2({
            allowClear: true,
            placeholder: "Select Insurance Product"
        });
        $('#loan_tenure').select2({
            allowClear: true,
            placeholder: "Select Tenor (In Years)"
        });
        $('#end_use').select2({
            allowClear: true,
            placeholder: "Select End Use"
        });

//        $("#end_use").change(function(){
//            if($(this).val() == '' || $(this).val() == 0) {
//                $("#loanProduct").collapse("hide");
//            } else if($(this).val() != 0) {
//                $("#loanProduct").collapse("show");
//            }
//        });

        $( document ).ready(function() {
            $( "#end_use" ).change(function() {

                if($(this).val() == '' || $(this).val() == 0) {
                    $("#loanProduct").collapse("hide");
                } else if($(this).val() != 0) {
                    $("#loanProduct").collapse("show");
                }

                if($( "#end_use").val() == 'FI'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }

                    });
                }
                else if($( "#end_use").val() == 'FD'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }

                    });
                }
                else if($( "#end_use").val() == 'PV'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }

                    });
                }
                else if($( "#end_use").val() == 'PE'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'UBL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'VF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'CSCF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'PP'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'UBL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'VF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'CSCF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'MRMP'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'MFAP'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'CC'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'STAPCFP'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'STAPCFP'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'CE'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'CC'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'CSCF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'BRECP'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'EFL'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }
                    });
                }else if($( "#end_use").val() == 'PPE'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'CC'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'VF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element == 'CSCF'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }

                    });
                }else if($( "#end_use").val() == 'LTW'){
                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {
                        if(element == 'CC'){
                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                            $("#loan_product option[value=" + element + "]").show();
                        }

                    });
                }
            });
            $( "#loan_product" ).children().first().text("Select Loan Product Type");
        });


    </script>

@endsection