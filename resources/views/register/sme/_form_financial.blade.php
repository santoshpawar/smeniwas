<div class="col-md-9" id="pan_details">
    <div class="tab-content tab-design" style="padding:20px;">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label(null,'&nbsp;') !!}
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
                    {!! Form::label('owner_mobile','Mobile No. *') !!}
                    {!! Form::text('owner_mobile',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('service_tax_number','Service Tax Number *') !!}
                    {!! Form::text('service_tax_number',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('vat_number','VAT Number *') !!}
                    {!! Form::text('vat_number',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('gross_equipment','Gross value of Plant & Machinery /
                    Equipment as on date ( in Lacs) *') !!}
                    {!! Form::text('gross_equipment',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" style="  margin-left: auto;">
                    {!! Form::label('latest_turnover','Latest Audited Turnover (In Lacs)') !!}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('turnover_201415','FY 2014-2015 *') !!}
                        {!! Form::text('turnover_201415',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('turnover_201314','FY 2013-2014 *') !!}
                        {!! Form::text('turnover_201314',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('turnover_201213','FY 2012-2013 *') !!}
                        {!! Form::text('turnover_201213',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('turnover_201112','FY 2011-2012 *') !!}
                        {!! Form::text('turnover_201112',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('gross_fixed_assets','Total value of Gross Fixed Assets
                        as on date ( in Lacs) *') !!}
                        {!! Form::text('gross_fixed_assets',null,['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="margin-left:20px;">
                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'window.location.href="/register/sme/promoter"')) !!}
                {!! Form::submit('Save & Continue', ['class' => 'btn btn-success btn-cons sme_button']) !!}
            </div>
        </div>
    </div>
</div>

@section('footer')


    <script src="{{ asset('/js/jquery-ui.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
@endsection