 <div class="container-fluid">
     <div class="row">
         <div class="card">
             <div class="card-header" data-background-color="green">
             <h3 class="title">Create New Loan Application <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h3>
                {{-- <p class="category">Apply new loan</p> --}}
            </div>
            <div class="card-content">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="tab-content tab-design" style="border-radius: 2px;">
                        <div class="container-fluid main-container">
                            <div class="col-md-12 content">
                                <div class="row" style="margin-left: -17px;">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="form-group">
                                            {!! Form::hidden('isMobileData', 0) !!}
                                            {!! Form::hidden('id', $userID) !!}
                                            {!! Form::label('end_use','End Use:') !!}<br>
                                            {!! Form::select('end_use',$end_use, $chosenEndUse, ['id' => 'end_use', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-3">
                                        <div class="form-group collapse" id="loanProduct">
                                            <div class="form-group">
                                                {!! Form::label('loan_product','Loan Product:') !!}<br>
                                                @if(isset($loanType))
                                                {!! Form::label('loan_product',App\Helpers\FormatHelper::formatLoanType($loanType)) !!}
                                                @else

                                                {!! Form::select('loan_product',$loan_product, $chosenLoanProduct, ['id' => 'loan_product', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6 col-sm-3">
                                        <div class="form-group">
                                            {!! Form::label('loan_tenure','Tenor in Years:') !!}<br>
                                            {!! Form::select('loan_tenure',$loan_tenure, $chosenLoanTenure, ['id' => 'loan_tenure', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                                        </div>
                                    </div> 
                                     <div class="col-md-6 col-sm-3">
                                        <div class="form-group">
                                            {!! Form::label('amount','Amount (Rs Lacs):') !!}<br>
                                            {!! Form::text('amount', $amount, ['id' => 'amount', 'class' => 'form-control amount','placeholder' => 'Amount (Rs Lacs)', 'style' => 'width:100%']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-3">
                                        <div class="form-group collapse" id="companySharePledged">
                                            {!! Form::label('company_share','Name of Company whos share are being pledged:') !!}<br>
                                            {!! Form::text('companySharePledged', '', ['id' => 'companySharePledged', 'class' => 'form-control','placeholder' => '', 'style' => 'width:100%']) !!}
                                        </div>
                                    </div> 

                                    <div class="col-md-6 col-sm-3">
                                        <div class="form-group collapse" id="bscNscCode">
                                            {!! Form::label('bscNscCode','BSE/NSE Code:') !!}<br>
                                            {!! Form::text('bscNscCode','', ['id' => 'bscNscCode', 'class' => 'form-control', 'style' => 'width:100%']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-left:10px;">
                                        {!! Form::button('Start Application <i class="fa fa-chevron-right"></i>', array('type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button', 'value'=> 'Save', 'style' => 'margin-top:20px;' )) !!}
                                        {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;' )) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




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



    $('#loan_product').select2({
        allowClear: true,
        placeholder: "Select Loan Product Type"
    });
    $('#loan_tenure').select2({
        allowClear: true,
        placeholder: "Select Tenor (In Years)"
    });
    $('#end_use').select2({
        allowClear: true,
        placeholder: "Select End Use"
    });






    $( document ).ready(function() {
        $( "#end_use" ).change(function() {

            if($(this).val() == '' || $(this).val() == 0) {
               $("#loanProduct").collapse("hide");
           } else if($(this).val() != 0) {
                    $("#loanProduct").collapse("show"); //true
                }

                if($( "#end_use").val() == 'FI'){

                    var values = $("#loan_product>option").map(function() { return $(this).val(); });
                    $(values).each(function(index,element)
                    {


                        if(element == 'EFL'){

                            $("#loan_product option[value=" + element + "]").hide();
                        }else if(element.length){
                          //  alert('Bot EFL');
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

 jQuery(document).ready(function($){


     $("#loanProduct").change(function(event) {

     });
 })   

 $( "#loan_product" ).change(function() {

    if($(this).val() == 'LAS' ) {

     $("#companySharePledged").collapse("show");
     $("#bscNscCode").collapse("show");
 }else{
     $("#companySharePledged").collapse("hide");
     $("#bscNscCode").collapse("hide");
 }
});
</script>

