<div id="divTC-Div7">
    {!! Form::hidden('loan_id', $loanId ) !!}
    @for ($formIndex = 0; $formIndex < $existingPromotersCount; $formIndex++)
        <?php $promoter = $existingPromoters->offsetGet($formIndex); ?>
        <div class="collapse" id="promoter_director_container_{{$formIndex}}">
            <div class="form-group">
                {!! Form::label('heading','Promoters / Directors Details '.($formIndex+1), array('class' => 'awesome')) !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::button('Delete Lender Details', array('class' => 'btn btn-primary','id'=>'delete_existing'.$formIndex)) !!}
                {!! Form::hidden('promoters['.$formIndex.'][process]', true ) !!}
                {!! Form::hidden('promoters['.$formIndex.'][isDeleted]', false, ['id'=> 'isDeleted'.$formIndex ] ) !!}
                {!! Form::hidden('promoters['.$formIndex.'][id]', $promoter->id ) !!}
                {!! Form::hidden('promoters['.$formIndex.'][loan_id]', $loanId ) !!}
            </div>
            <hr/>
            <div class="form-group">
                {!! Form::label(null,'Promoters / Directors Name ') !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('promoters['.$formIndex.'][promoter_name]',$promoter->promoter_name,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(null,'PAN of Promoter / Director ') !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('promoters['.$formIndex.'][pan_of_promoter]',$promoter->pan_of_promoter,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(null,'Director Identification Number (DIN) ') !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('promoters['.$formIndex.'][director_identification_number]',$promoter->director_identification_number,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(null,'No of Companies directorship ') !!}
                {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('promoters['.$formIndex.'][no_of_companies_directorship]',$promoter->no_of_companies_directorship,['class' => 'form-control']) !!}
            </div>
        </div>
    @endfor
    @for ($formIndex = 0; $formIndex < $newPromoterRecordsNum; $formIndex++)
        <?php $arrayIndex = $existingPromotersCount+$formIndex; ?>
            <div class="collapse" id="promoter_director_container_{{$arrayIndex}}">
                <div class="form-group">
                    {!! Form::label(null,'Promoters / Directors Details '.($formIndex+1)) !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::hidden('promoters['.$arrayIndex.'][process]', false, ['id'=> 'process'.$arrayIndex ] ) !!}
                    {!! Form::hidden('promoters['.$arrayIndex.'][id]', null ) !!}
                    {!! Form::hidden('promoters['.$arrayIndex.'][loan_id]', $loanId ) !!}
                </div>
                <hr/>
                <div class="form-group">
                    {!! Form::label(null,'Promoters / Directors Name ') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('promoters['.$arrayIndex.'][promoter_name]',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(null,'PAN of Promoter / Director ') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('promoters['.$arrayIndex.'][pan_of_promoter]',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(null,'Director Identification Number (DIN) ') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('promoters['.$arrayIndex.'][director_identification_number]',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(null,'No of Companies directorship ') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::label(null,'(?)', ['title' => 'INR in Lakhs']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('promoters['.$arrayIndex.'][no_of_companies_directorship]',null,['class' => 'form-control']) !!}
                </div>
            </div>
    @endfor
        <div class="form-group">
            {!! Form::button('Add Promoters / Directors Details', ['class' => 'btn btn-primary btn-lg btn-block add_promo_button', 'id' => 'add_promoter_director']) !!}
            {!! Form::button('Remove Promoters / Directors Details', ['class' => 'btn btn-warning btn-lg btn-block rem_promo_button', 'id' => 'rem_promoter_director']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('notice', '(All ') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div6'); return false;", 'value'=> 'Back' )) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>
@section('footer')
    <script type="text/javascript">

        $(document).ready(function() {

            var add_button = jQuery("#add_promoter_director");
            var delete_button = jQuery("#rem_promoter_director");
            var existingRecords = {{$existingPromotersCount}};
            var totalAllowedRecords = {{$maxPromoters}};
            var currentRecord = {{$existingPromotersCount}};


            // Display the form if any entry is in database
            for(var index = 0; index < currentRecord; index++){
                $('#promoter_director_container_'+index).collapse('show');
            }

            for(var index = currentRecord; index < totalAllowedRecords; index++){
                var processField = $('#process'+index);
                if(processField.val() == 1){
                    $('#promoter_director_container_'+currentRecord).collapse('show');
                    currentRecord++;
                }
            }

            if(currentRecord == totalAllowedRecords){ //On load, if maxrecords are shown, hide the add button
                add_button.hide();
            }

            if(currentRecord == existingRecords){ //On load, if only saved records are shown, hide the delete button
                delete_button.hide();
            }

            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if(currentRecord == totalAllowedRecords){
                    alert("Only "+ totalAllowedRecords + " Promoter Detail records can be added. Cannot add more records.");
                    $(this).hide();
                }else {
                    $('#process' + currentRecord).val(1);
                    //$('#detailsForm' + currentRecord).show().removeClass('hidden');
                    $('#promoter_director_container_' + currentRecord).collapse('show');

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
                    $('#promoter_director_container_' + currentRecord).collapse('hide');

                    if(currentRecord == existingRecords){
                        $(this).hide();
                    }
                }
            });

            @for ($formIndex = 0; $formIndex < $existingPromotersCount; $formIndex++)
                var delete_existing{{$formIndex}} = $("#delete_existing{{$formIndex}}"); //Delete button ID
                $(delete_existing{{$formIndex}}).click(function(e) { //on add input button click
                    e.preventDefault();
                    alert("Record will be removed after you press save and continue");
                    $('#isDeleted{{$formIndex}}').val(1);
                    $('#detailsForm{{$formIndex}}').collapse('hide');
                });
            @endfor


        });

       /* $(document).ready(function() {
            $("#add_promoter_director_2").hide();
        });

        var counter_id = 1; // Counter for the newly created ADD Buttons

        // Function to generate Form
        function generateForm(e) {

            counter_id++;
            console.log("Incremented : "+counter_id);

            var newForm = $("#promoter_director_container_1").html();

            //Changing the ID of the new Form

            var newID = e.target.id; // obtaining the target ID
            newID = newID.replace(e.target.id.substr(-1, 1), counter_id.toString()); // Incrementing the ID
            newID = 'id="' + newID + '"'; // Modifying the ID
            newForm = newForm.replace('id="add_promoter_director_1"', newID); // Replacement of ID

            $(e.target).parent().before('<div class="promoter_director_container" id="promoter_director_container_' + counter_id + '">' + newForm + '<div class="form-group"><button class="btn btn-warning btn-lg btn-block rem_promo_button" id="rem_promoter_director_' + counter_id + '" type="button">Remove Promoters / Directors Details</button></div></div>');

            // Incrementing the label counter
            $("#promoter_director_container_" + counter_id).find(".label_counter").text(counter_id);


            // Binding REMOVE Form function to newly created remove Button
            $("#rem_promoter_director_" + counter_id).on('click', function(event) {
                removeForm(event);
            });

        } //end generateForm

        // Function to remove Form
        function removeForm(e) {
            $(e.target).parent().parent().remove();
            counter_id--;
            var i = 1;
            $(".promoter_director_container").each(function(){
                $(this).attr('id', 'promoter_director_container_'+i);
                $(this).find(".label_counter").text(i);
                i++;
            });
        } //end removeForm

        $("#add_promoter_director_1").click(function(event) {
            generateForm(event);
            $(this).hide();
            $("#add_promoter_director_2").show();
        });

        $("#add_promoter_director_2").click(function(event) {
            generateForm(event);
        });*/

    </script>
@endsection;