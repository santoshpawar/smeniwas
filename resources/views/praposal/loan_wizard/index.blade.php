@extends('app_header')

@section('content')
    <section class="content_style">
        <div class="carousel fade-carousel slide" data-ride="carousel" id="bs-carousel">
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-2"></div>
                    {{--<div class="hero">
                        <hgroup>
                            <h2 class="loan_advisor">Loan Advisor</h2>
                        </hgroup>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    {!! Form::open(['id' => 'wizard_form']) !!}

    <div class="container-fluid" style="margin-top: 2%;">
        <div class="row">
            <div class="col-md-12 paragraph_style">
                <p class="paragraph_style_info" style="padding: 5px;"><strong>Answer the questionnaire to generate recommendation for most Likely to be Approved Loan Structure.</strong></p>
            </div>
        </div><!-- end row -->
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-body" id="left-content">
                        <div class="form-group collapse" id="question_1">
                            {!! Form::label('businessType', 'Select Business Type') !!}
                            {!! Form::select('businessType', ['Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'], null, ['class' => 'form-control','id'=>'business_type'])!!}
                        </div><!-- end question_1 -->
                        <div class="form-group collapse" id="question_2">
                            {!! Form::label('industrySegment', 'Select Industry Segment') !!}
                            {!! Form::select('industrySegment', $industryTypes, null, ['class' => 'form-control']) !!}
                        </div><!-- end question_2 -->
                        <div class="form-group collapse" id="question_3">
                            {!! Form::label('endUse', 'Select End Use') !!}
                            {!! Form::select('endUse', $endUse, null, ['class' => 'form-control']) !!}
                        </div><!-- end question_3 -->
                        <div class="form-group collapse" id="question_4">
                            {!! Form::label('turnOver', 'Latest full year turnover/total income / Net Sales (Rs Lacs)') !!}
                            {!! Form::text('turnOver', null, ['class' => 'form-control amount',  'id' => 'turnOver']) !!}
                        </div><!-- end question_4 -->
                        <div class="form-group collapse" id="question_5">
                            {!! Form::label('businessAge', 'How many years old is the business/company?') !!}
                            {!! Form::select('businessAge', ['less than 3' => '< 3 years', '3 - 7' => '3 - 7 years', 'greater than 7 - 12' => '7 - 12 years', 'greater than 12' => '> 12 years'], null, ['class' => 'form-control']) !!}
                        </div><!-- end question_5 -->
                        <div class="form-group collapse" id="question_6">
                            {!! Form::label('loanRequired', 'Specify Loan Amount Required') !!}
                            <div class="range range-danger">
                                <input type="range" name="range" min="1" max="1000" value="50" onchange="rangeDanger.value=value + ' Lakhs'">
                                <output id="rangeDanger">50 Lakhs</output>
                            </div>
                        </div><!-- end question_6 -->
                        <div class="form-group collapse" id="question_7">
                            {!! Form::label('existingOwnerLoan', 'What is current total borrowing of promoter/owner? (Rs Lacs)') !!}
                            {!! Form::text('existingOwnerLoan', 0, ['class' => 'form-control amount', 'id' => 'existingOwnerLoan']) !!}
                            {!! Form::label('existingCompany', 'What is current total borrowing of business? (Rs Lacs)?') !!}
                            {!! Form::text('existingCompany', 0, ['class' => 'form-control amount', 'id' => 'existingCompany']) !!}
                            {!! Form::label('totalBorrowing', 'Total Borrowing (Rs Lacs)') !!}
                            {!! Form::text('totalBorrowing', 0, ['class' => 'form-control amount', 'disabled' => 'disabled', 'id' => 'totalBorrowing']) !!}
                        </div><!-- end question_7 -->
                        <div class="form-group collapse" id="question_8">
                            {!! Form::label('emiAmount', 'What is current  monthly interest + EMI liability of the company/business? (Rs Lacs)') !!}
                            {!! Form::text('emiAmount', 0, ['class' => 'form-control amount', 'id' => 'emiAmount']) !!}
                            {!! Form::label('emiAmount2', 'What is current  monthly interest + EMI liability of the promoter/owner? (Rs Lacs)') !!}
                            {!! Form::text('emiAmount2', 0, ['class' => 'form-control amount', 'id' => 'emiAmount2']) !!}
                            {!! Form::label('totalMonthlyEMI', 'Total Current Monthly EMI (Rs Lacs)') !!}
                            {!! Form::text('totalMonthlyEMI', 0, ['class' => 'form-control amount', 'disabled' => 'disabled', 'id' => 'totalMonthlyEMI']) !!}
                        </div><!-- end question_8 -->
                        <div class="form-group collapse" id="question_9">
                            {!! Form::label('additionalEMIAmt', 'What  is additional monthly interest + EMI liability that business can service? (Rs Lacs)') !!}
                            {!! Form::text('additionalEMIAmt', null, ['class' => 'form-control amount', 'id' => 'additionalEMIAmt']) !!}
                        </div><!-- end question_9 -->
                        <div class="form-group collapse" id="question_10">
                            {!! Form::label('additionalIncome', 'Does promoter have other sources of income? (Interest, rental, others)') !!}
                            <label class="radio-inline"><input type="radio" name="additionalIncome" id="additionalIncomeYes">Yes</label>
                            <label class="radio-inline"><input type="radio" name="additionalIncome" id="additionalIncomeNo" checked>No</label>
                            <div id="additionalIncomeContainer">
                                <label for="additionalIncome">Enter Additional Income</label>
                                {!! Form::text('additionalIncome', null, ['class' => 'form-control', 'id' => 'additionalIncome', 'placeholder' => '(Rs in Lacs)']) !!}
                            </div>
                        </div><!-- end question_10 -->
                        <div class="form-group collapse" id="question_11">
                            {!! Form::label('cibilScore', 'Do you know your CIBIL Score?') !!}
                            <label class="radio-inline"><input type="radio" name="cibilScore" id="cibilScoreYes">Yes</label>
                            <label class="radio-inline"><input type="radio" name="cibilScore" id="cibilScoreNo" checked>No</label>
                            <div id="cibilScoreContainer">
                                <label for="cibilScore">Enter Cibil Score</label>
                                {!! Form::text('cibilScore', null, ['class' => 'form-control', 'id' => 'cibilScore']) !!}
                            </div>
                        </div><!-- end question_11 -->
                        <div class="form-group collapse" id="question_12">
                            {!! Form::label('collateralProperty', 'Would you be able to provide any property as collateral?') !!}
                            <label class="radio-inline"><input type="radio" name="collateralProperty" id="collateralPropertyYes">Yes</label>
                            <label class="radio-inline"><input type="radio" name="collateralProperty" id="collateralPropertyNo" checked>No</label>
                            <div id="collateralPropertyContainer">
                                <br>
                                <label for="collateralProperty">Enter Value of Property</label>
                                {!! Form::text('collateralProperty', null, ['class' => 'form-control', 'id' => 'collateralProperty', 'placeholder' => '(Rs in Lacs)']) !!}
                            </div>
                        </div><!-- end question_12 -->
                    </div>
                    <div class="panel-footer left-panel-footer">
                        <button type="button" class="btn btn-primary btn-lg btn-block sme_wizard_btn" id="next">Next <span class="fa fa-share"></span></button>
                        <button type="button" class="btn btn-success btn-lg btn-block" id="finish" data-toggle="modal" data-target="#loan_recommendation_modal">Finish <span class="fa fa-floppy-o"></span></button>
                        <button type="reset" class="btn btn-danger btn-lg btn-block" id="reset">Reset <span class="fa fa-refresh"></span></button>
                    </div>
                </div> <!-- end panel -->
            </div> <!-- end left panel -->
            <div class="col-md-7">
                <div class="panel panel-primary right-panel">
                    <div class="panel-body">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>Question</th>
                                <th>Answers</th>
                                <th>Action</th>
                            </tr>
                            <tr id="display_question_1" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_2" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_3" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_4" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_5" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_6" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_7" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_8" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_9" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_10" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_11" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                            <tr id="display_question_12" class="data_toggle">
                                <td></td>
                                <td></td>
                                <td><span class="edit_toggle">Edit</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- end right panel -->
        </div><!-- end row -->
        {!! Form::close() !!}
        <div class="row" id="loan_recommendation_container">
            <div class="modal fade" id="loan_recommendation_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Generated Loan Recommendation</h4>
                        </div>
                        <div class="modal-body" id="loan_recommendation_result">

                        </div>
                        <div class="modal-footer">
                            <hr>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</button>
                            {{--<button type="submit" class="btn btn-success" id="submitt"><span class="glyphicon glyphicon-check"></span>&nbsp;Proceed to Loan Application</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    <link href="{{ asset('/css/sme.css') }}" rel="stylesheet">

    <script type="text/javascript">
        $(document).ready(function () {

            var counter = 0;
            $("#question_1").collapse("show");
            $("#finish").hide();
            $("#reset").hide();
            $(".edit_toggle").hide();
            $(".data_toggle").hide();
            $(".edit_toggle").css({'cursor' : 'pointer', 'text-decoration' : 'underline'});
            $("#existingOwnerLoan, #existingCompany ").blur(function (event) {
                $("#totalBorrowing").val((parseFloat($("#existingOwnerLoan").val()) + parseFloat($("#existingCompany").val()) ).toPrecision(3) );
            });
            $("#emiAmount, #emiAmount2 ").blur(function (event) {
                $("#totalMonthlyEMI").val( (parseFloat($("#emiAmount").val()) + parseFloat($("#emiAmount2").val()) ).toPrecision(3) );
            });
            $("#additionalIncome, #additionalIncomeContainer, #cibilScore, #cibilScoreContainer, #collateralProperty, #collateralPropertyContainer").hide();
            $("#additionalIncomeYes").click(function () {
                $("#additionalIncomeContainer").show();
                $("#additionalIncome").show();
            });
            $("#additionalIncomeNo").click(function () {
                $("#additionalIncome").hide();
                $("#additionalIncomeContainer").hide();
            });
            $("#cibilScoreYes").click(function () {
                $("#cibilScore").show();
                $("#cibilScoreContainer").show();
            });
            $("#cibilScoreNo").click(function () {
                $("#cibilScore").hide();
                $("#cibilScoreContainer").hide();
            });
            $("#collateralPropertyYes").click(function () {
                $("#collateralProperty").show();
                $("#collateralPropertyContainer").show();
            });
            $("#collateralPropertyNo").click(function () {
                $("#collateralProperty").hide();
                $("#collateralPropertyContainer").hide();
            });

            var valid = false;
            $("#next").click(function () {

                /* Data Validations */
                if( $("#turnOver:visible").val() == '') {
                    $("#turnOver:visible").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#existingOwnerLoan").val() ) ) ) {
                    $("#existingOwnerLoan").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#existingCompany").val() ) ) ) {
                    $("#existingCompany").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#emiAmount").val() ) ) ) {
                    $("#emiAmount").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#emiAmount2").val() ) ) ) {
                    $("#emiAmount2").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( $("#turnOver").is(":visible") ) {
                    if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#turnOver").val() ) ) ) {
                        $("#turnOver:visible").css({'border-color' : 'red'});
                        valid = false;
                        return false;
                    }else{
                        valid = true;
                    }
                }
                if($("#additionalEMIAmt:visible").val() == ''){
                    $("#additionalEMIAmt:visible").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( $("#additionalEMIAmt").is(":visible") ) {
                    if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#additionalEMIAmt").val() ) ) ) {
                        $("#additionalEMIAmt:visible").css({'border-color' : 'red'});
                        valid = false;
                        return false;
                    }else{
                        valid = true;
                    }
                }
                if($("#additionalIncome:visible").val() == ''){
                    $("#additionalIncome:visible").css({'border-color' : 'red'});
                    valid = true;
                    return false;
                }else{
                    valid = true;
                }
                if( $("#additionalIncome").is(":visible") ) {
                    if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#additionalIncome").val() ) ) ) {
                        $("#additionalIncome:visible").css({'border-color' : 'red'});
                        valid = false;
                        return false;
                    }else{
                        valid = true;
                    }
                }
                if($("#cibilScore:visible").val() == ''){
                    $("#cibilScore:visible").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( $("#cibilScore").is(":visible") ) {
                    if( (/[^0-9]/.test( $("#cibilScore").val() ) ) ) {
                        $("#cibilScore:visible").css({'border-color' : 'red'});
                        valid = false;
                        return false;
                    }else{
                        valid  = true;
                    }
                }
                if($("#collateralProperty:visible").val() == ''){
                    $("#collateralProperty:visible").css({'border-color' : 'red'});
                    valid = false;
                    return false;
                }else{
                    valid = true;
                }
                if( $("#collateralProperty").is(":visible") ) {
                    if( !(/^[0-9]+(\.[0-9]{1})?$/.test( $("#collateralProperty").val() ) ) ) {
                        $("#collateralProperty:visible").css({'border-color' : 'red'});
                        valid = false;
                        return false;
                    }else{
                        valid = true;
                    }
                }
                counter++;
                $("#display_question_"+counter).show();
                $("#display_question_"+counter).children(":nth-child(3)").children(".edit_toggle").show();
                if(counter == 7) {
                    $("#display_question_"+counter).children().first().text($("#question_"+counter).children(":nth-child(5)").text());
                }
                else if(counter == 8) {
                    $("#display_question_"+counter).children().first().text($("#question_"+counter).children(":nth-child(5)").text());
                }else {
                    $("#display_question_"+counter).children().first().text($("#question_"+counter).children().first().text());
                }

                if(counter == 3) {
                    $("#display_question_"+counter).children(":nth-child(2)").text($("#question_3").children(":nth-child(2)").children(":selected").text());
                }
                else if(counter == 6){
                    $("#display_question_"+counter).children(":nth-child(2)").text($("output").val());
                }
                else if(counter == 7) {
                    $("#display_question_"+counter).children(":nth-child(2)").text($("#question_"+counter).children(":nth-child(6)").val());
                }
                else if(counter == 8) {
                    $("#display_question_"+counter).children(":nth-child(2)").text($("#question_"+counter).children(":nth-child(6)").val());
                }
                else if( counter == 10 ) {
                    if($("#question_"+counter).children(":nth-child(4)").children("#additionalIncome").val() == null || $("#question_"+counter).children(":nth-child(4)").children("#additionalIncome").val() == '') {
                        $("#display_question_"+counter).children(":nth-child(2)").text('No');
                    } else {
                        $("#display_question_"+counter).children(":nth-child(2)").text($("#question_"+counter).children(":nth-child(4)").children("#additionalIncome").val());
                    }
                }
                else if( counter == 11 ) {
                    if($("#question_"+counter).children(":nth-child(4)").children("#cibilScore").val() == null || $("#question_"+counter).children(":nth-child(4)").children("#cibilScore").val() == '') {
                        $("#display_question_"+counter).children(":nth-child(2)").text('No');
                    } else {
                        $("#display_question_"+counter).children(":nth-child(2)").text($("#question_"+counter).children(":nth-child(4)").children("#cibilScore").val());
                    }
                }
                else if( counter == 12 ) {
                    if($("#question_"+counter).children(":nth-child(4)").children("#collateralProperty").val() == null || $("#question_"+counter).children(":nth-child(4)").children("#collateralProperty").val() == '') {
                        $("#display_question_"+counter).children(":nth-child(2)").text('No');
                    } else {
                        $("#display_question_"+counter).children(":nth-child(2)").text($("#question_"+counter).children(":nth-child(4)").children("#collateralProperty").val());
                    }
                }
                else {
                    $("#display_question_"+counter).children(":nth-child(2)").text($("#question_"+counter).children(":nth-child(2)").val());
                }
                if( counter == 12) {
                    $("#next").hide();
                    $("#finish").show();
                    $("#reset").show();
                    return false;
                }
                $(".collapse:visible").collapse("hide").next().collapse("show");
            });

            $('#submitt').click(function (e) {
                if(valid==true){
                    return true;
                }else{
                    e.preventDefault();
                }
            });


            $("#finish").click(function (event) {
                $("#loan_recommendation_result").html('');
                event.preventDefault();
                $.ajax({
                    url: '{{{URL::to('/loans/wizard/processData')}}}',
                   // url: window.location.origin+'/smeniwas2/public/loans/wizard/processData',
                    type: 'get',
                    data: {
                        _token: $("input[name='_token']").val(),
                        businessType : $("#question_1").children(":nth-child(2)").val(),
                        industrySegment : $("#question_2").children(":nth-child(2)").val(),
                        endUse : $("#question_3").children(":nth-child(2)").val(),
                        turnOver : $("#question_4").children(":nth-child(2)").val(),
                        businessAge : $("#question_5").children(":nth-child(2)").val(),
                        loanRequired : $("output").val(),
                        totalBorrowing : $("#question_7").children(":nth-child(6)").val(),
                        totalEMI : $("#question_8").children(":nth-child(6)").val(),
                        additionalEMIAmt : $("#question_9").children(":nth-child(2)").val(),
                        otherIncomeSource : $("#additionalIncome").val(),
                        cibilScore : $("#cibilScore").val(),
                        collateralPropertyValue : $("#collateralPropertyValue").val()

                    },
                    success: function (data) {
                        $("#loan_recommendation_result").append(data);
                    }

                });
            });

            /* Click event for reset button */
            $("#reset").click(function () {
                window.location.href= window.location.origin + '/loans/wizard';
                $("input[type='text']").val('');
            });

            /* Function for edit button */
            $(".edit_toggle").click(function (event) {
                var targetId = $(event.target).parent().parent().attr('id').substr(17);
                if($("#question_"+targetId).is(":visible") ) {
                    $("#question_"+targetId).collapse("show");
                } else {
                    $(".collapse:visible").collapse("hide");
                    $("#question_"+targetId).collapse("show");
                }
                $("#next").show();
                $("#finish").hide();
                $("#reset").hide();
                counter = targetId - 1;
            });

        });



    </script>
@endsection