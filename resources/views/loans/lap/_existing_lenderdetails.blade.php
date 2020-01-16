<div id="divTC-Div3">
    {!! Form::hidden('loan_id', $loanId ) !!}
    @for ($formIndex = 0; $formIndex < $existingLendersCount; $formIndex++)
        <?php $lender = $existingLenders->offsetGet($formIndex); ?>
        <div id ="detailsForm{{$formIndex}}" class="collapse">
            <div class="form-group">
                {!! Form::label('heading', 'Existing Lender Details '.($formIndex+1), array('class' => 'awesome')) !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::button('Delete Lender Details', array('class' => 'btn btn-primary','id'=>'delete_existing'.$formIndex)) !!}
                {!! Form::hidden('lenders['.$formIndex.'][process]', true ) !!}
                {!! Form::hidden('lenders['.$formIndex.'][isDeleted]', false, ['id'=> 'isDeleted'.$formIndex ] ) !!}
                {!! Form::hidden('lenders['.$formIndex.'][id]', $lender->id ) !!}
                {!! Form::hidden('lenders['.$formIndex.'][loan_id]', $loanId ) !!}
            </div>
            <hr/>
            <div class="form-group">
                {!! Form::label('lender_type','Lender Details ') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'Select lender']) !!}
                {!! Form::select('lenders['.$formIndex.'][lender_type]',$lenderTypes, $lender->lender_type, ['id' => 'lender_type'.$formIndex, 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name',' Name',['id' => 'name']) !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'Name']) !!}
                {!! Form::text('lenders['.$formIndex.'][name]',$lender->name,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('outstanding_amount',' Amount Outstanding (in Lacs)') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'INR in Lakhs']) !!}
                {!! Form::text('lenders['.$formIndex.'][outstanding_amount]',$lender->outstanding_amount,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('roi',' ROI') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'ROI']) !!}
                {!! Form::text('lenders['.$formIndex.'][roi]',$lender->roi,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('loan_type','Type of Loan') !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::label('loan_type','(?)', ['title' => 'Type of Loan']) !!}
                {!! Form::select('lenders['.$formIndex.'][loan_type]', $loanType, $lender->loan_type, ['class' => 'form-control','id'=>'loan_type'.$formIndex,'id'=>'loan_type'.$formIndex]) !!}
            </div>
            <div id="working_capital{{$formIndex}}" class="collapse">
                <div class="form-group">
                    {!! Form::label('fund_based_limits',' Fund Based Limits(in Lacs)') !!}
                    {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                    {!! Form::label('help','(?)', ['title' => 'INR in Lacs']) !!}
                    {!! Form::text('lenders['.$formIndex.'][fund_based_limits]',$lender->fund_based_limits,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('non_fund_based_limits','Non Fund Based Limits (in Lacs)') !!}
                    {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                    {!! Form::label('help','(?)', ['title' => 'INR in Lacs']) !!}
                    {!! Form::text('lenders['.$formIndex.'][non_fund_based_limits]',$lender->non_fund_based_limits,['class' => 'form-control']) !!}
                </div>
            </div>
            <div id="term_loan{{$formIndex}}" class="collapse">
                <div class="form-group">
                    {!! Form::label('tenure','Tenure in Year') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label('tenure','(?)', ['title' => 'Tenure in Year']) !!}
                    {!! Form::select('lenders['.$formIndex.'][tenure]', $tenureYear, $lender->tenure, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('maturity_date','Date of Maturity ') !!}
                    {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                    {!! Form::label('help','(?)', ['title' => 'Date of Maturity']) !!}
                    {!! Form::input('date','lenders['.$formIndex.'][maturity_date]',$lender->maturity_date,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('current_emi','Current Monthly Installment (in Lacs)') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label('current_emi','(?)', ['title' => 'INR in Lakhs']) !!}
                    {!! Form::text('lenders['.$formIndex.'][current_emi]', $lender->current_emi, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('notice', '(All ') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
            </div>
        </div>
    @endfor

    @for ($formIndex = 0; $formIndex < $newLenderRecordsNum; $formIndex++)
        <?php $arrayIndex = $existingLendersCount+$formIndex; ?>
        <div id ="detailsForm{{$arrayIndex}}" class="collapse">
            <div class="form-group">
                {!! Form::label('heading', 'Existing Lender Details '.($arrayIndex+1), array('class' => 'awesome')) !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::hidden('lenders['.$arrayIndex.'][process]', false, ['id'=> 'process'.$arrayIndex ] ) !!}
                {!! Form::hidden('lenders['.$arrayIndex.'][id]', null ) !!}
                {!! Form::hidden('lenders['.$arrayIndex.'][loan_id]', $loanId ) !!}
            </div>
            <hr/>
            <div class="form-group">
                {!! Form::label('lender_type','Lender Details ') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'Select lender']) !!}
                {!! Form::select('lenders['.$arrayIndex.'][lender_type]',$lenderTypes, null, ['id' => 'lenders['.$arrayIndex.'][lender_type]', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name',' Name',['id' => 'name']) !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'Name']) !!}
                {!! Form::text('lenders['.$arrayIndex.'][name]',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('outstanding_amount',' Amount Outstanding (in Lacs)') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'INR in Lakhs']) !!}
                {!! Form::text('lenders['.$arrayIndex.'][outstanding_amount]',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('roi',' ROI') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('help','(?)', ['title' => 'ROI']) !!}
                {!! Form::text('lenders['.$arrayIndex.'][roi]',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('loan_type','Type of Loan') !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::label('loan_type','(?)', ['title' => 'Type of Loan']) !!}
                {!! Form::select('lenders['.$arrayIndex.'][loan_type]', [''=>'-select loan-','Working Capital' =>'Working Capital', 'Term Loan' => 'Term Loan'], null, ['class' => 'form-control','id'=>'loan_type'.$arrayIndex]) !!}
            </div>
            <div id="working_capital{{$arrayIndex}}" class="collapse">
                <div class="form-group">
                    {!! Form::label('fund_based_limits',' Fund Based Limits(in Lacs)') !!}
                    {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                    {!! Form::label('help','(?)', ['title' => 'INR in Lacs']) !!}
                    {!! Form::text('lenders['.$arrayIndex.'][fund_based_limits]',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('non_fund_based_limits','Non Fund Based Limits (in Lacs)') !!}
                    {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                    {!! Form::label('help','(?)', ['title' => 'INR in Lacs']) !!}
                    {!! Form::text('lenders['.$arrayIndex.'][non_fund_based_limits]',null,['class' => 'form-control']) !!}
                </div>
            </div>
            <div id="term_loan{{$arrayIndex}}" class="collapse">
                <div class="form-group">
                    {!! Form::label('tenure','Tenure in Year') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label('tenure','(?)', ['title' => 'Tenure in Year']) !!}
                    {!! Form::select('lenders['.$arrayIndex.'][tenure]', ['' => 'Select Tenure', 1 => '1  Year', 2 => '2 Year', 3 => '3 year', 4 => '4 Year', 5 => '5 Year'], null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('maturity_date','Date of Maturity ') !!}
                    {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                    {!! Form::label('help','(?)', ['title' => 'Date of Maturity']) !!}
                    {!! Form::input('date','lenders['.$arrayIndex.'][maturity_date]',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('current_emi','Current Monthly Installment (in Lacs)') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label('current_emi','(?)', ['title' => 'INR in Lakhs']) !!}
                    {!! Form::text('lenders['.$arrayIndex.'][current_emi]', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('notice', '(All ') !!}
                {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
            </div>
        </div>
    @endfor

    <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-12">
        <div class="form-group" id="firstButton">
            {!! Form::button('Add Lender Details', array('class' => 'btn btn-primary add_field_button','id'=>'add_button_1')) !!}
            {!! Form::button('Delete Lender Details', array('class' => 'btn btn-primary delete_field_button','id'=>'delete_button')) !!}
        </div>
        <div class="form-group">
            {!! Form::checkbox('terms_condition' , '1',null, ['id' => 'terms_condition']) !!}
            {!! Form::label('notice', 'I have read, understood and accepted the Terms and Conditions. ') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}

        </div>
        {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn btn',
        'onclick' => 'window.location.href=""')) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>

@section('footer')
    <script>
        $(document).ready(function() {
            @for ($formIndex = 0; $formIndex < 3; $formIndex++)
            $('lender_type{{$formIndex}}').select2({
                allowClear: true,
                placeholder: "Select Lender"
            });
            @endfor
            $('#loan_type').select2({
                        allowClear: true,
                        placeholder: "Select loan"
                    });

            var add_button      = $(".add_field_button"); //Add button ID
            var delete_button      = $(".delete_field_button"); //Delete button ID

            var existingRecords = {{$existingLendersCount}};
            var totalAllowedRecords = {{$maxLenderRecords}};
            var currentRecord = {{$existingLendersCount}};

            for(var index = 0; index < currentRecord; index++){
                $('#detailsForm'+index).collapse('show');
            }

            for(var index = currentRecord; index < totalAllowedRecords; index++){
                var processField = $('#process'+index);
                if(processField.val() == 1){
                    $('#detailsForm'+currentRecord).collapse('show');
                    currentRecord++;
                }
            }

            if(currentRecord==totalAllowedRecords){ //On load, if maxrecords are shown, hide the add button
                add_button.hide();
            }

            if(currentRecord==existingRecords){ //On load, if only saved records are shown, hide the delete button
                delete_button.hide();
            }

            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if(currentRecord == totalAllowedRecords){
                    alert("Only "+ totalAllowedRecords + " Lender Detail records can be added. Cannot add more records.");
                    $(this).hide();
                }else {
                    $('#process' + currentRecord).val(1);
                    //$('#detailsForm' + currentRecord).show().removeClass('hidden');
                    $('#detailsForm' + currentRecord).collapse('show');

                    if(currentRecord==existingRecords){ //If delete button was hidden, then show it
                        delete_button.show();
                    }

                    currentRecord++;
                    if(currentRecord == totalAllowedRecords){
                        $(this).hide();
                    }
                }
            });

            $(delete_button).click(function(e) { //on add input button click
                e.preventDefault();

                if(currentRecord == existingRecords){
                    alert("Only new Lender Detail records can be deleted using this button. Deleted previously saved records individually.");
                    $(this).hide();
                }else {
                    if(currentRecord == totalAllowedRecords){//If add button was hidden on max records, then show it
                        add_button.show();
                    }

                    currentRecord--;

                    $('#process' + currentRecord).val("");
                    $('#detailsForm' + currentRecord).collapse('hide');

                    if(currentRecord == existingRecords){
                        $(this).hide();
                    }
                }
            });

            @for ($formIndex = 0; $formIndex < $existingLendersCount; $formIndex++)
            var delete_existing{{$formIndex}} = $("#delete_existing{{$formIndex}}"); //Delete button ID
            $(delete_existing{{$formIndex}}).click(function(e) { //on add input button click
                e.preventDefault();
                alert("Record will be removed after you press save and continue");
                $('#isDeleted{{$formIndex}}').val(1);
                $('#detailsForm{{$formIndex}}').collapse('hide');
            });
            @endfor

            var workingCapitalValue = 'Working Capital';
            var termLoanValue = 'Term Loan';

            @for ($formIndex = 0; $formIndex < $maxLenderRecords; $formIndex++)
            var loanTypeSelect{{$formIndex}} = $('#loan_type{{$formIndex}}');

            //On form load, show or hide the required sections
            if(loanTypeSelect{{$formIndex}}.val() == workingCapitalValue){
                $('#term_loan{{$formIndex}}').collapse('hide');
                $('#working_capital{{$formIndex}}').collapse('show');
            }else if(loanTypeSelect{{$formIndex}}.val() == termLoanValue){
                $('#term_loan{{$formIndex}}').collapse('show');
                $('#working_capital{{$formIndex}}').collapse('hide');
            }

            //Add listeners for the selectbox change
            loanTypeSelect{{$formIndex}}.change(function(){
                var selectedValue = loanTypeSelect{{$formIndex}}.val();

                if(selectedValue == workingCapitalValue){
                    $('#term_loan{{$formIndex}}').collapse('hide');
                    $('#working_capital{{$formIndex}}').collapse('show');
                }else if(selectedValue == termLoanValue){
                    $('#term_loan{{$formIndex}}').collapse('show');
                    $('#working_capital{{$formIndex}}').collapse('hide');
                }
            });
            @endfor
        });


    </script>
@endsection