<div id="divTC-Div1">
    <div class="form-group">
        {!! Form::label(null,'Loan Requirements Details') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::hidden('loan_id', $loanId ) !!}
    </div>
    <hr/>
    <div class="form-group">

        {!! Form::label('loan_amount','Loan Amount (') !!}
        {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label('loan_amount',' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('loan_amount', null, array('class' => 'form-control')) !!}

    </div>
    <div class="form-group">
        {!! Form::label('loan_tenure','Tenure in Year') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::label('loan_tenure','(?)', ['title' => 'INR in Lakhs']) !!}
        {!! Form::select('loan_tenure', $tenureYear , $choosenTenureYear ,['id' => 'loan_tenure', 'class' => 'form-control']) !!}
        <!--{!! Form::select('loan_tenure', ['' => 'Select Tenure', 1 => '1  Year', 2 => '2 Year', 3 => '3 year', 4 => '4 Year', 5 => '5 Year'], null, ['class' => 'form-control']) !!}-->
    </div>
    <div class="form-group">
        {!! Form::label('monthly_emi','Monthly EMI for existing Loan ( ') !!}
        {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label('monthly_emi',' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('monthly_emi', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('max_additional_emi','Maximum additional EMI Serviceable ( ') !!}
        {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label('loan_amount',' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('max_additional_emi', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('notice', '(All ') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
    </div>

    <div class="form-group">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div1'); return false;", 'value'=> 'Back' )) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>
@section('footer')
    <script>
        $(document).ready(function () {
            $('#loan_tenure').select2({
                allowClear: true,
                placeholder: "Select Tenure Year"
            });


        });

    </script>
@endsection