<div id="divTC-Div8">
    <div class="form-group">
        {!! Form::label(null,'Upload Details') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
    </div>
    <hr/>
    <div class="form-group">
        {!! Form::label(null,'Upload latest audited / Provisional annual report ') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('latest_audited_report', ['class' => 'form-control upload_details']) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
    <div class="form-group">
        {!! Form::label(null,'Upload 6 months bank account statement of company ') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('bank_account_statement', ['class' => 'form-control upload_details']) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
    <div class="form-group">
        {!! Form::label(null,'Upload PAN of Company ') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('pan_company', ['class' => 'form-control upload_details']) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
    <div class="upload_promoters_kyc_documents" id="upload_promoters_kyc_documents_1">
        <div class="form-group">
            {!! Form::label(null,'Upload Promoters KYC Documents') !!}
            {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        </div>
        <hr/>
        <div class="form-group">
            {!! Form::label(null,'Upload PAN of Promoter/ Director ') !!}
            {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
            {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
        </div>
        <div class="form-group">
            {!! Form::file('pan_promoter', ['class' => 'form-control upload_details']) !!}
        </div>
        <div class="form-group">
            {!! Form::button('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
        <div class="form-group">
            {!! Form::label(null,'Upload Proof of Address ') !!}
            {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
            {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
        </div>
        <div class="form-group">
            {!! Form::file('proof_address', ['class' => 'form-control upload_details']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('proof_address', $addressTypes, null, ['id' => 'address_types', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::button('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::button('Add Another Promoters KYC Documents', ['class' => 'btn btn-success btn-lg btn-block', 'id' => 'add_promoter_kyc_doc_1']) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Add Another Promoters KYC Documents', ['class' => 'btn btn-success btn-lg btn-block', 'id' => 'add_promoter_kyc_doc_2']) !!}
    </div>
    <div class="upload_promoters_networth_certificate" id="upload_promoters_networth_certificate_1">
    <div class="form-group">
        {!! Form::label(null,'Upload Promoters Networth Certificate') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
    </div>
    <hr/>
    <div class="form-group">
        {!! Form::label(null,'Upload Promoters Networth Certificate ', ['class' => 'label_upload_networth_certificate']) !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('proof_address', ['class' => 'form-control upload_details']) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
    </div>
    <div class="form-group">
        {!! Form::button('Add Networth Certificate', ['class' => 'btn btn-success btn-lg btn-block', 'id' => 'add_net_cert_1']) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Add Networth Certificate', ['class' => 'btn btn-success btn-lg btn-block', 'id' => 'add_net_cert_2']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('notice', '(All ') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div7'); return false;", 'value'=> 'Back' )) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>
@section('footer')
    <script src="{{ URL::asset('js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".upload_details").filestyle({buttonName: "btn-primary"});
        $(document).ready(function() {
            $('#address_types').select2({
                allowClear: true,
                placeholder: "Select Address Type"
            });
        });
    </script>
@endsection