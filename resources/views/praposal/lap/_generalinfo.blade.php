<div id="divTC-Div9">
    <div class="form-group">
        {!! Form::label(null,'General Information Required') !!}
        {!! Form::hidden('loan_application_id',$loanApplicationId) !!}
    </div>
    <div class="form-group">
        {!! Form::label(null,'Promoters Generation are') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}

    </div>
    <div class="form-group">
        @foreach ($promotersGenerationType as $promotersGenerationTypeName=>$promotersGenerationTypeValue)
            {!! Form::radio('promoter_generation_type', $promotersGenerationTypeValue,$choosenPromoterGenerationtype) !!}
            {!! Form::label('promoter_generation_type',$promotersGenerationTypeName) !!}
        @endforeach
    </div>
    <!--<div class="form-group">

        {!! Form::radio('promoter_generation_type', '1st Generation Entrepreneurs') !!}
        {!! Form::label('promoter_generation_type','1st Generation Entrepreneurs') !!}

        {!! Form::radio('promoter_generation_type', '2nd Generation') !!}
        {!! Form::label('promoter_generation_type','2nd Generation  ') !!}

        {!! Form::radio('promoter_generation_type', '3rd or More Generation') !!}
        {!! Form::label('promoter_generation_type','3rd or More Generation     ') !!}


    </div>-->

    <div class="form-group">
        {!! Form::label(null,'Promoters are') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
    </div>
    <div class="form-group">
        @foreach ($promotersBackground as $promotersBackgroundName=>$promotersBackgroundValue)
            {!! Form::radio('promoter_background', $promotersBackgroundValue,$choosenPromoterBackground) !!}
            {!! Form::label('promoter_background',$promotersBackgroundName) !!}
        @endforeach
    </div>

    <!--<div class="form-group">
            {!! Form::radio('promoter_background', 'Professionals (CA/MBA)') !!}
            {!! Form::label('promoter_background','Professionals (CA/MBA)  ') !!}

            {!! Form::radio('promoter_background', 'Technocrats (Engineering & Technical Background)') !!}
            {!! Form::label('promoter_background','Technocrats (Engineering & Technical Background)  ') !!}

            {!! Form::radio('promoter_background', 'Business Family') !!}
            {!! Form::label('promoter_background','Business Family  ') !!}


    </div>-->

    <div class="form-group">
        {!! Form::label('other_key_businesses','Other Key businesses of the promoters') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('other_key_businesses',null,['class' => 'form-control']) !!}

        {!! Form::label('manufacturing_location_no','Nos of manufacturing location') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('manufacturing_location_no',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('branches_location_no','Nos of Locations of Offices/Branches') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('branches_location_no',null,['class' => 'form-control']) !!}

        {!! Form::label('key_products_manufactured','Key products Manufactured') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('key_products_manufactured',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('product_uses','Uses of Products / Services') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::select('product_uses',$productType, $chosenproductType, ['id' => 'product_type', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('industry_segment','Specify industry segment') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('industry_segment', null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('services_nature','Nature of Services Offered') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('services_nature',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('end_users','End Users/key customer segments') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('end_users',null,['class' => 'form-control']) !!}

        {!! Form::label('total_staff','Total Staff') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::text('total_staff',null,['class' => 'form-control']) !!}
    </div>



    <div class="form-group">
        {!! Form::label(null,'Your company has which of the following positions') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('help','(?)', ['title' => 'Select lender']) !!}

    </div>
    <div class="form-group">
        @foreach ($companyPositionTypes as $companyPositionTypeName=>$companyPositionTypeValue)
            {!! Form::checkbox('positions[]', $companyPositionTypeValue,(in_array($companyPositionTypeValue,$chosenCompanyPositionTypes) ? true: false)) !!}
            {!! Form::label('positions',$companyPositionTypeName) !!}
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label(null,'Sales') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}


    </div>
    <div class="form-group">
        @foreach ($sales as $salesName=>$salesValue)
            {!! Form::radio('sales_geography_type', $salesValue,$choosenSales) !!}
            {!! Form::label('sales_geography_type',$salesName) !!}
        @endforeach
    </div>

    <!--<div class="form-group">
        {!! Form::radio('sales_geography_type', 'Domestic Sales') !!}
        {!! Form::label('sales_geography_type','Domestic Sales  ') !!}

        {!! Form::radio('sales_geography_type', 'Export Sales') !!}
        {!! Form::label('sales_geography_type','Export Sales  ') !!}

        {!! Form::radio('sales_geography_type', 'Both') !!}
        {!! Form::label('sales_geography_type','Both  ') !!}
    </div>-->
    <div class="formButton">
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>



</div>
@section('footer')
    <script>
        $(document).ready(function() {
            $('#product_type').select2({
                allowClear: true,
                placeholder: "Select Product/Services Type"
            });

        });
    </script>
@endsection