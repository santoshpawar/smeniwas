<div id="divTC-Div1">
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading"><label>Company / Business Background Details</label></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group required">
                            {!! Form::label('cin_no','CIN', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::text('cin_no', null, array('class' => 'form-control', 'id'=>'cin_no', 'placeholder'=>'Certificate of Incorporation Number')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-3">
                        <div class="form-group required">
                            {!! Form::label('vat_no','VAT', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::text('vat_no', null, array('class' => 'form-control', 'id'=>'vat_no', 'placeholder'=>'VAT Registration Number')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-lg-5">
                        <div class="form-group required">
                            {!! Form::label('service_tax_no','Service Tax', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('service_tax_no', null, array('class' => 'form-control', 'id'=>'service_tax_no', 'placeholder'=>'Service Tax Registration Number')) !!}
                            </div>
                        </div>
                    </div>
                </div><br/>
                <div class="row" id="Que3">
                    <div class="col-md-6">
                        <label for="mfgradio">Number of Manufacturing locations of your business <span class="redmarks">*</span></label>

                            {!! Form::radio('mfgradio', 'option_1', false, ['id' => 'mfgradio_option_1']) !!}
                            {!! Form::label('mfgradio', '1') !!}
                            {!! Form::radio('mfgradio', 'option_2', false, ['id' => 'mfgradio_option_2']) !!}
                            {!! Form::label('mfgradio', '2 - 4') !!}
                            {!! Form::radio('mfgradio', 'option_3', false, ['id' => 'mfgradio_option_3']) !!}
                            {!! Form::label('mfgradio', '> 4') !!}

                    </div>
                    <div class="col-md-6">
                        {!! Form::label('branches_location_no','Are Your Sales to a?') !!}
                        <div>
                            @foreach ($userType as $Name=>$Value)
                                {!! Form::radio('end_sales', $Value,$choosenUserType) !!}
                                {!! Form::label('end_sales',$Name) !!}
                            @endforeach
                        </div>
                    </div>
                </div><br/>
                <div class="row" id="Que4">
                    <div class="col-md-6">
                        {!! Form::label('key_products_manufactured','Key Products/Services Offered (give brief description)') !!}
                        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                        <div>
                            {!! Form::textarea('key_products_manufactured', isset($key_products_manufactured)? $key_products_manufactured:null, array('class' => 'form-control', 'placeholder' => 'Give brief description', 'size' => '30x3')) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label(null,'Type of Customer') !!}
                        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                        <div>
                            @foreach ($userType as $Name=>$Value)
                                {!! Form::radio('end_users', $Value,$choosenUserType) !!}
                                {!! Form::label('end_users',$Name) !!}
                            @endforeach
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('distributor','Are you a distributor/stockists of any company') !!}
                        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}

                            {!! Form::radio('areyoudist_radio', 'option_1', false, ['id' => 'areyoudist_radio_option_1']) !!}
                            {!! Form::label('areyoudist_radio', 'Yes') !!}
                            {!! Form::radio('areyoudist_radio', 'option_2', false, ['id' => 'areyoudist_radio_option_2']) !!}
                            {!! Form::label('areyoudist_radio', 'No') !!}
                            <div id="diststockiest_from" class="collapse">
                                @for($formIndex=1; $formIndex < 6; $formIndex++)
                                    @if($formIndex == 1)
                                        <div id="detailsForm{{$formIndex}}" class="panel panel-info" >
                                            @else
                                                <div id="detailsForm{{$formIndex}}" class="panel panel-info collapse">
                                                    @endif
                                                    <div class="panel-heading">Company Details</div>
                                                    <div class="panel-body">
                                                        <div>
                                                            {!! Form::label('company_name','Company Name') !!}
                                                            {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                                                            {!! Form::text('company_nm'.$formIndex, null, ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div>
                                                            {!! Form::label('product_name','Product Name') !!}
                                                            {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                                                            {!! Form::text('product_nm'.$formIndex, null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endfor
                                                <div class="form-group" id="firstButton">
                                                    {!! Form::button('Add Company Details', array('class' => 'btn btn-primary add_field_button','id'=>'add_button_1')) !!}
                                                    {!! Form::button('Delete Company Details', array('class' => 'btn btn-primary delete_field_button','id'=>'delete_button')) !!}
                                                </div>
                                        </div>
                            </div>

                        <div class="col-md-6">
                            {!! Form::label(null,'Are your Sales ?') !!}
                            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}

                                {!! Form::radio('areyoursales_radio', 'option_1', false, ['id' => 'areyoursales_radio_option_1']) !!}
                                {!! Form::label('areyoursales_radio', 'Domestic') !!}
                                {!! Form::radio('areyoursales_radio', 'option_2', false, ['id' => 'areyoursales_radio_option_2']) !!}
                                {!! Form::label('areyoursales_radio', 'Export') !!}
                                {!! Form::radio('areyoursales_radio', 'option_3', false, ['id' => 'areyoursales_radio_option_3']) !!}
                                {!! Form::label('areyoursales_radio', 'Both') !!}
                                <div id="AnnualValueExport" class="collapse">
                                    {!! Form::label('annual_value_exports','Annual Value of Exports (') !!}
                                    {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
                                    {!! Form::label('export_amount',' In Lacs )') !!}
                                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                                    {!! Form::text('annual_value_exports', isset($annual_value_exports)? $annual_value_exports:null, array('class' => 'form-control')) !!}
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" align="center">
            {!! Form::button('Next', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div2',$loanId); return false;", 'value'=> 'Next' )) !!}
            {!! Form::button('Exit', array('class' => 'inputBtn btn', 'onclick' => "showTab('Home',$loanId); return false;", 'value'=> 'Exit' )) !!}
        </div>

        @if(isset($loanId))
            <div class="form-group" align="center">
                {!! Form::button(HTML::linkAction('Pdf\PrintController@getIndex', 'Download PDF File', array('loanId' => $loanId)), array('class' => 'inputBtn btn link-button')) !!}
            </div>
        @endif

    </div>

    @section('footer')
        <script>
            function showTab(tabid,loanid)
            {
                if(tabid == "Div1")
                {
                    document.location = "{{URL::to('/loans/newlap/index/'.$loanId)}}";
                }
                else if(tabid == "Div2") {
                    document.location = "{{URL::to('/loans/newlap/promoter/'.$loanId)}}";
                }
                else if(tabid == "Div3")
                {
                    document.location = "{{URL::to('/loans/newlap/financial/'.$loanId)}}";
                }
                else if(tabid == "Div4")
                {
                    document.location = "{{URL::to('/loans/newlap/business/'.$loanId)}}";
                }
                else if(tabid == "Div5")
                {
                    document.location = "{{URL::to('/loans/newlap/uploaddoc/'.$loanId)}}";
                }
                else
                {
                    document.location = "{{URL::to('/home#')}}";
                }
            }

            $(document).ready(function()
            {
                var add_button_1_count = 1;

                $("#areyoursales_radio_option_1").click(function ()
                {
                    $("#AnnualValueExport").collapse("hide");
                });
                $("#areyoursales_radio_option_2").click(function ()
                {
                    $("#AnnualValueExport").collapse("show");
                });
                $("#areyoursales_radio_option_3").click(function ()
                {
                    $("#AnnualValueExport").collapse("show");
                });


                $("#areyoudist_radio_option_1").click(function ()
                {
                    $("#diststockiest_from").collapse("show");
                });
                $("#areyoudist_radio_option_2").click(function ()
                {
                    $("#diststockiest_from").collapse("hide");
                });


                //==========================================//
                $('#add_button_1').click(function()
                {
                    add_button_1_count = add_button_1_count + 1;
                    $('#detailsForm'+add_button_1_count).show();
                    if(add_button_1_count == 5)
                    {
                        $('#add_button_1').hide();
                    }
                    else
                    {
                        $('#add_button_1').show();
                    }

                    if(add_button_1_count == 1)
                    {
                        $('#delete_button').hide();
                    }
                    else
                    {
                        $('#delete_button').show();
                    }
                });

                $('#delete_button').click(function() {

                    $('#detailsForm'+add_button_1_count).hide();
                    add_button_1_count = add_button_1_count - 1;
                    if(add_button_1_count == 5)
                    {
                        $('#add_button_1').hide();
                    }
                    else
                    {
                        $('#add_button_1').show();
                    }

                    if(add_button_1_count == 1)
                    {
                        $('#delete_button').hide();
                    }
                    else
                    {
                        $('#delete_button').show();
                    }
                });

                //==========================================//




                /* $('#issales').on("change",function()
                 {
                 if($("#issales option:selected").val() >= 1)
                 {
                 $('#Que6').show();
                 }
                 else
                 {
                 $('#Que6').hide();
                 }
                 });

                 if($( "#distributor option:selected" ).val() == 1){
                 $('#firstButton').show();
                 }else{
                 $('#firstButton').hide();
                 }
                 $('#product_type').select2({
                 allowClear: true,
                 placeholder: "Select Product/Services Type"
                 });
                 $('#distributor').on("change",function() {
                 if($( "#distributor option:selected" ).val() == 1){
                 $('#firstButton').show();
                 $('#existing_from').slideToggle();
                 }else{
                 $('#firstButton').hide();
                 $('#existing_from').slideToggle();
                 $('#new_form').slideToggle();


                 }
                 });
                 var add_button      = $(".add_field_button"); //Add button ID
                 var delete_button      = $(".delete_field_button"); //Delete button ID

                 var existingRecords = {{$existingCompanyDeailsCount}};
             var totalAllowedRecords = {{$maxCompanyDetails}};
             var currentRecord = {{$existingCompanyDeailsCount}};

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
             console.log(currentRecord);
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
                @for ($formIndex = 0; $formIndex < $existingCompanyDeailsCount; $formIndex++)
                 var delete_existing{{$formIndex}} = $("#delete_existing{{$formIndex}}"); //Delete button ID
             $(delete_existing{{$formIndex}}).click(function(e) { //on add input button click
             e.preventDefault();
             alert("Record will be removed after you press save and continue");
             $('#isDeleted{{$formIndex}}').val(1);
             $('#detailsForm{{$formIndex}}').collapse('hide');
             });
                @endfor*/

            });

        </script>
@endsection