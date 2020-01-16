<style>

  /*start css from upload doc*/
  .btn span.glyphicon {
  opacity: 0;
}
.btn.active span.glyphicon {
  opacity: 1;
}
.securityColl-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 5.33333px;
  right: 0;
  bottom: 0;
  left: -4px;
  height: 20px;
  width: 20px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
  min-height: 20px !important;
}
.form-group input[type=file] {
  opacity: 1;
  position: inherit;
  /* top: 31px; */
  /* right: 13px; */
  /* bottom: 0; */
  /* left: 15px; */
  /* width: 100%; */
  /* height: inherit !important; */
  /* z-index: 100; */
}
.comppress{

  border-radius:  solid1px  #000;
  border: 2px solid #a09696;
  padding: 11px;
  padding-left: 113px;

}
.alert.alert-default.comppress{
  width: 70%;
  margin: 0 auto;
}
span.text-center.btn.btn-primary {
  width: 32%;
  margin: 0 auto;
}
span.text-center.btn.btn-primary a {
 color: white;
 font-weight: 800;
}

  /*end css from upload doc*/

.sharePop {
  background: #083b82;
  font-size: 16px;
  padding: 5px;
  color: white;
  animation: blinker 7s linear infinite;
}
@keyframes blinker {
  50% { opacity: 0; }
}



.form-group {
  padding-bottom: 0px;
  margin: 0px 0 0 0;
  width: 100% !important;
}
.form-control{
  /*  height: 9px !important;*/
}
.form-group .form-control {
  margin-bottom: 4px !important;
}
.form-horizontal .form-group {
  margin-right: 175px;
  margin-left: -6px;
}
.table > tbody > tr > td{
  padding: 5px 0px 5px 11px !important;
  font-weight: bold;
}
.form-group.is-empty {
  width: 100%;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>
{{-- @if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged, array('id' => 'companySharePledged')) !!}
@endif
@if(isset($displayNoneSecurity))
{!! Form::hidden('displayNoneSecurity', $displayNoneSecurity, array('id' => 'displayNoneSecurity')) !!}
@endif --}}
<section>
<div class="container-fluid">
 <div class="row">
   <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">Checklist<span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
       <form method="post" action="">
        {{ csrf_field() }}
     </div>
     <hr>
     <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div id="tab" class="btn-group" data-toggle="tab" style="margin-left:10px;">
              <a href="#prices2" class="btn btn-large btn-success btn-space btn-info" data-toggle="tab"style="font-size: 14px !important;">KYC of Business</a>
              <a href="#features2" class="btn btn-large btn-success btn-space btn-info" data-toggle="tab"style="font-size: 14px !important;">KYC Of Promoters/Guarantor</a>

              <a href="#requests2" class="btn btn-large btn-success btn-space btn-info" data-toggle="tab"style="font-size: 14px !important;">Loan Documents</a>
              <a href="#contact2" class="btn btn-large btn-success btn-space btn-info"  data-toggle="tab"style="font-size: 14px !important;">Security Documents</a>
            </div>





              <div class="tab-content">
                  <div class="tab-pane active" id="prices2">
                      <div class="row">
                        <div class="span9">
                      <!-- Start Kyc Details Of company--> 
              <div class="tab-pane" id="" style="padding-left: 20px;padding-right: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">

                      <div>
                        <h3>KYC Of Business</h3>
                      </div>
                    

                          {!! Form::hidden('id',null) !!}

                      <table class="table"  border="solid">
                        <thead class="thead-dark">
                          <tr>
                            <th><strong>NAME</strong></th>
                            <th><strong>APPLICABLE</strong></th>
                            <th><strong>DOCUMENTS</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                          </tr>
                        </thead>
                        <tbody>

            {{--  @$loanadminchecklist  --}}
    <tr>
    <td>{!! Form::label('moa','MOA', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_applicable1','yes'  ,@$praposalChecklist->moa_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_applicable1','no' ,@$praposalChecklist->moa_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_document1','yes'  ,@$praposalChecklist->moa_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_document1','no' ,@$praposalChecklist->moa_document1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_document1_no']) !!}
             No
           </label>

        </td>

           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_discrepancies1','yes'  ,@$praposalChecklist->moa_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_discrepancies1','no' ,@$praposalChecklist->moa_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_discrepancies1_no']) !!}
             No
           </label>

   {!! Form::text('moa_remark1', isset($praposalChecklist->moa_remark1) ? @$praposalChecklist->moa_remark1 : null, array('class' => 'form-control', 'id'=>'moa_remark1', 'placeholder'=>'', '')) !!}
    
        </td>


      </tr>
      <tr>

        <td>{!! Form::label('pan','PAN', ['class'=>'form-label']) !!}</td>
            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_applicable1','yes'  ,@$praposalChecklist->pan_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_applicable1','no' ,@$praposalChecklist->pan_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_document1','yes'  ,@$praposalChecklist->pan_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_document1','no' ,@$praposalChecklist->pan_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_discrepancies1','yes'  ,@$praposalChecklist->pan_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_discrepancies1','no' ,@$praposalChecklist->pan_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_discrepancies1_no']) !!}
             No
           </label>

              {!! Form::text('pan_remark1', isset($praposalChecklist->pan_remark1) ? @$praposalChecklist->pan_remark1 : null, array('class' => 'form-control', 'id'=>'pan_remark1', 'placeholder'=>'', '')) !!}
        </td>


   </tr>

         <tr>

        <td>{!! Form::label('cor','COR', ['class'=>'form-label']) !!}</td>
            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_applicable1','yes'  ,@$praposalChecklist->cor_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_applicable1','no' ,@$praposalChecklist->cor_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_document1','yes'  ,@$praposalChecklist->cor_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_document1','no' ,@$praposalChecklist->cor_document1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_discrepancies1','yes'  ,@$praposalChecklist->cor_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_discrepancies1','no' ,@$praposalChecklist->cor_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_discrepancies1_no']) !!}
             No
           </label>


              {!! Form::text('cor_remark1', isset($praposalChecklist->cor_remark1) ? @$praposalChecklist->cor_remark1 : null, array('class' => 'form-control', 'id'=>'cor_remark1', 'placeholder'=>'', '')) !!}
        </td>

   </tr>
<tr>
  <td>{!! Form::label('shopcertificate','SHOP CERTIFICATE', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_applicable1','yes'  ,@$praposalChecklist->shopcertificate_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_applicable1','no' ,@$praposalChecklist->shopcertificate_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_document1','yes'  ,@$praposalChecklist->shopcertificate_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_document1','no' ,@$praposalChecklist->shopcertificate_document1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_document1_no']) !!}
             No
           </label>

        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_discrepancies1','yes'  ,@$praposalChecklist->shopcertificate_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_discrepancies1','no' ,@$praposalChecklist->shopcertificate_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('shopcertificate_remark1', isset($praposalChecklist->shopcertificate_remark1) ? @$praposalChecklist->shopcertificate_remark1 : null, array('class' => 'form-control', 'id'=>'shopcertificate_remark1', 'placeholder'=>'', '')) !!}


        </td>

</tr>

<tr>
  <td>{!! Form::label('gstcertificate','GST CERTIFICATE', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('gstcertificate_applicable1','yes'  ,@$praposalChecklist->gstcertificate_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'gstcertificate_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('gstcertificate_applicable1','no' ,@$praposalChecklist->gstcertificate_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'gstcertificate_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('gstcertificate_document1','yes'  ,@$praposalChecklist->gstcertificate_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'gstcertificate_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('gstcertificate_document1','no' ,@$praposalChecklist->gstcertificate_document1 == 'no' ? 'checked' : '' ,  ['id' => 'gstcertificate_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('gstcertificate_discrepancies1','yes'  ,@$praposalChecklist->gstcertificate_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'gstcertificate_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('gstcertificate_discrepancies1','no' ,@$praposalChecklist->gstcertificate_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'gstcertificate_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('gstcertificate_remark1', isset($praposalChecklist->gstcertificate_remark1) ? @$praposalChecklist->gstcertificate_remark1 : null, array('class' => 'form-control', 'id'=>'gstcertificate_remark1', 'placeholder'=>'', '')) !!}
        </td>


</tr>


<tr>
  <td>{!! Form::label('ghumastalicence','GHUMASTA LICENCE', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_applicable1','yes'  ,@$praposalChecklist->ghumastalicence_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_applicable1','no' ,@$praposalChecklist->ghumastalicence_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_document1','yes'  ,@$praposalChecklist->ghumastalicence_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_document1','no' ,@$praposalChecklist->ghumastalicence_document1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_discrepancies1','yes'  ,@$praposalChecklist->ghumastalicence_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_discrepancies1','no' ,@$praposalChecklist->ghumastalicence_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_discrepancies1_no']) !!}
             No
           </label>


             {!! Form::text('ghumastalicence_remark1', isset($praposalChecklist->ghumastalicence_remark1) ? @$praposalChecklist->ghumastalicence_remark1 : null, array('class' => 'form-control', 'id'=>'ghumastalicence_remark1', 'placeholder'=>'', '')) !!}
        </td>


</tr>

<tr>
  <td>{!! Form::label('rentagreement','RENT AGREEMENT', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_applicable1','yes'  ,@$praposalChecklist->rentagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_applicable1','no' ,@$praposalChecklist->rentagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_document1','yes'  ,@$praposalChecklist->rentagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_document1','no' ,@$praposalChecklist->rentagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_discrepancies1','yes'  ,@$praposalChecklist->rentagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_discrepancies1','no' ,@$praposalChecklist->rentagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('rentagreement_remark1', isset($praposalChecklist->rentagreement_remark1) ? @$praposalChecklist->rentagreement_remark1 : null, array('class' => 'form-control', 'id'=>'rentagreement_remark1', 'placeholder'=>'', '')) !!}

        </td>

</tr>

<tr>
  <td>{!! Form::label('udyogadhar','UDYOG AADHAR', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_applicable1','yes'  ,@$praposalChecklist->udyogadhar_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_applicable1','no' ,@$praposalChecklist->udyogadhar_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_document1','yes'  ,@$praposalChecklist->udyogadhar_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_document1','no' ,@$praposalChecklist->udyogadhar_document1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_discrepancies1','yes'  ,@$praposalChecklist->udyogadhar_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_discrepancies1','no' ,@$praposalChecklist->udyogadhar_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('udyogadhar_remark1', isset($praposalChecklist->udyogadhar_remark1) ? @$praposalChecklist->udyogadhar_remark1 : null, array('class' => 'form-control', 'id'=>'udyogadhar_remark1', 'placeholder'=>'', '')) !!}
        </td>



</tr>

<tr>
  <td>{!! Form::label('electricitybill','ELECTRICITY BILL', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_applicable1','yes'  ,@$praposalChecklist->electricitybill_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_applicable1','no' ,@$praposalChecklist->electricitybill_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_document1','yes'  ,@$praposalChecklist->electricitybill_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_document1','no' ,@$praposalChecklist->electricitybill_document1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_discrepancies1','yes'  ,@$praposalChecklist->electricitybill_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_discrepancies1','no' ,@$praposalChecklist->electricitybill_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('electricitybill_remark1', isset($praposalChecklist->electricitybill_remark1) ? @$praposalChecklist->electricitybill_remark1 : null, array('class' => 'form-control', 'id'=>'electricitybill_remark1', 'placeholder'=>'', '')) !!}
        </td>



</tr>

<tr>
  <td>{!! Form::label('cibilofentity','CIBIL OF ENTITY', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_applicable1','yes'  ,@$praposalChecklist->cibilofentity_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_applicable1','no' ,@$praposalChecklist->cibilofentity_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_document1','yes'  ,@$praposalChecklist->cibilofentity_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_document1','no' ,@$praposalChecklist->cibilofentity_document1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_discrepancies1','yes'  ,@$praposalChecklist->cibilofentity_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_discrepancies1','no' ,@$praposalChecklist->cibilofentity_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('cibilofentity_remark1', isset($praposalChecklist->cibilofentity_remark1) ? @$praposalChecklist->cibilofentity_remark1 : null, array('class' => 'form-control', 'id'=>'cibilofentity_remark1', 'placeholder'=>'', '')) !!}

  
        </td>


</tr>

<tr>
  <td>{!! Form::label('other1','OTHER', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other1_applicable1','yes'  ,@$praposalChecklist->other1_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other1_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other1_applicable1','no' ,@$praposalChecklist->other1_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other1_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other1_document1','yes'  ,@$praposalChecklist->other1_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other1_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other1_document1','no' ,@$praposalChecklist->other1_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other1_document1_no']) !!}
             No
           </label>
        </td>

   <td colspan="2">

       {!! Form::text('other1_remarks', isset($praposalChecklist->other1_remarks) ? @$praposalChecklist->other1_remarks : null, array('class' => 'form-control', 'id'=>'other1_remarks', 'placeholder'=>'Remarks', '', 'style' => 'height:100px;')) !!}
    </td>

</tr>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br>

<!-- End Kyc Details Of company--> 
        <hr>

        

        <hr>
       {{--  new --}}






                    </div>
                </div>
              </div>


              <div class="tab-pane" id="features2">
                <div class="row">
                    <div class="span6">
                      <!--Start Kyc Details Of director-->
<div class="tab-pane" id="" style="padding-left: 20px;padding-right: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">
                      <div>
                        <h3>KYC of Promoters/Guarantor</h3>
                      </div><br>
                      <table class="table"  border="solid">
                        <thead class="thead-dark">
                          <tr>
                            <th><strong>NAME</strong></th>
                            <th><strong>APPLICABLE</strong></th>
                            <th><strong>DOCUMENTS</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                           {{--  <th><strong>ATTACHMENT</strong></th> --}}
                          </tr>
                        </thead>
                        <tbody>
    <tr>
        <td>{!! Form::label('pan2','PAN', ['class'=>'form-label']) !!}</td>
        <td>
                     <label class="checkbox-inline">
              {!! Form::checkbox('pan2_applicable1','yes'  ,@$praposalChecklist->pan2_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_applicable1','no' ,@$praposalChecklist->pan2_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan2_document1','yes'  ,@$praposalChecklist->pan2_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_document1','no' ,@$praposalChecklist->pan2_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan2_discrepancies1','yes'  ,@$praposalChecklist->pan2_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_discrepancies1','no' ,@$praposalChecklist->pan2_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_discrepancies1_no']) !!}
             No
           </label>

              {!! Form::text('pan2_remark2', isset($praposalChecklist->pan2_remark2) ? @$praposalChecklist->pan2_remark2 : null, array('class' => 'form-control', 'id'=>'pan2_remark2', 'placeholder'=>'', '')) !!}
        </td>


                    
    </tr>

    <tr>
      <td>{!! Form::label('addressproof','Address Proof', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_applicable1','yes'  ,@$praposalChecklist->addressproof_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_applicable1','no' ,@$praposalChecklist->addressproof_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_document1','yes'  ,@$praposalChecklist->addressproof_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_document1','no' ,@$praposalChecklist->addressproof_document1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_discrepancies1','yes'  ,@$praposalChecklist->addressproof_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_discrepancies1','no' ,@$praposalChecklist->addressproof_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_discrepancies1_no']) !!}
             No
           </label>
    
             {!! Form::text('addressproof_remark2', isset($praposalChecklist->addressproof_remark2) ? @$praposalChecklist->addressproof_remark2 : null, array('class' => 'form-control', 'id'=>'addressproof_remark2', 'placeholder'=>'', '')) !!}


        </td>


      
    </tr>

     <tr>
      <td>{!! Form::label('networthcertificate','Networth Certificate', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_applicable1','yes'  ,@$praposalChecklist->networthcertificate_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_applicable1','no' ,@$praposalChecklist->networthcertificate_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_document1','yes'  ,@$praposalChecklist->networthcertificate_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_document1','no' ,@$praposalChecklist->networthcertificate_document1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_discrepancies1','yes'  ,@$praposalChecklist->networthcertificate_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_discrepancies1','no' ,@$praposalChecklist->networthcertificate_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_discrepancies1_no']) !!}
             No
           </label>

              {!! Form::text('networthcertificate_remark2', isset($praposalChecklist->networthcertificate_remark2) ? @$praposalChecklist->networthcertificate_remark2 : null, array('class' => 'form-control', 'id'=>'networthcertificate_remark2', 'placeholder'=>'', '')) !!}


        </td>


      
      
    </tr>

     <tr>
      <td>{!! Form::label('cibilofpromoter','CIBIL Of Promoter', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_applicable1','yes'  ,@$praposalChecklist->cibilofpromoter_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_applicable1','no' ,@$praposalChecklist->cibilofpromoter_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_document1','yes'  ,@$praposalChecklist->cibilofpromoter_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_document1','no' ,@$praposalChecklist->cibilofpromoter_document1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_discrepancies1','yes'  ,@$praposalChecklist->cibilofpromoter_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_discrepancies1','no' ,@$praposalChecklist->cibilofpromoter_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('cibilofpromoter_remark2', isset($praposalChecklist->cibilofpromoter_remark2) ? @$praposalChecklist->cibilofpromoter_remark2 : null, array('class' => 'form-control', 'id'=>'cibilofpromoter_remark2', 'placeholder'=>'', '')) !!}



        </td>


      
      
    </tr>

     <tr>
      <td>{!! Form::label('other2','Others', ['class'=>'form-label']) !!}</td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other2_applicable1','yes'  ,@$praposalChecklist->other2_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other2_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other2_applicable1','no' ,@$praposalChecklist->other2_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other2_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other2_document1','yes'  ,@$praposalChecklist->other2_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other2_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other2_document1','no' ,@$praposalChecklist->other2_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other2_document1_no']) !!}
             No
           </label>
        </td>

   <td colspan="2">
      
         {!! Form::text('other2_remarks', isset($praposalChecklist->other2_remarks) ? @$praposalChecklist->other2_remarks : null, array('class' => 'form-control', 'id'=>'other2_remarks', 'placeholder'=>'Remarks', '' , 'style' => 'height:100px;')) !!}
    </td>
      
    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<!--End Kyc Details of director--> 
                    </div>
                </div>
  
              </div>

              <div class="tab-pane" id="requests2">
                <div class="row">
                    <div class="span5">
                     <!--Start Loan Documents-->
<div class="tab-pane" id="" style="padding-left: 20px;padding-right: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">
                      <div>
                        <h3>Loan Documents</h3>
                      </div><br>
                      <table class="table"  border="solid">
                        <thead class="thead-dark">
                          <tr>
                            <th><strong>NAME</strong></th>
                            <th><strong>APPLICABLE</strong></th>
                            <th><strong>DOCUMENTS</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                            {{-- <th><strong>ATTACHMENT</strong></th> --}}
                          </tr>
                        </thead>
                        <tbody>
    <tr>
      <td>{!! Form::label('acceptedtermsheet','Accepted Termsheet', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('acceptedtermsheet_applicable1','yes'  ,@$praposalChecklist->acceptedtermsheet_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_applicable1','no' ,@$praposalChecklist->acceptedtermsheet_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('acceptedtermsheet_document1','yes'  ,@$praposalChecklist->acceptedtermsheet_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_document1','no' ,@$praposalChecklist->acceptedtermsheet_document1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('acceptedtermsheet_discrepancies1','yes'  ,@$praposalChecklist->acceptedtermsheet_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_discrepancies1','no' ,@$praposalChecklist->acceptedtermsheet_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_discrepancies1_no']) !!}
             No
           </label>

              {!! Form::text('acceptedtermsheet_remark3', isset($praposalChecklist->acceptedtermsheet_remark3) ? @$praposalChecklist->acceptedtermsheet_remark3 : null, array('class' => 'form-control', 'id'=>'acceptedtermsheet_remark3', 'placeholder'=>'', '' )) !!}
        </td>


    </tr>

    <tr>
      <td>{!! Form::label('loanagreement','Loan Agreement', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_applicable1','yes'  ,@$praposalChecklist->loanagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_applicable1','no' ,@$praposalChecklist->loanagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_document1','yes'  ,@$praposalChecklist->loanagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_document1','no' ,@$praposalChecklist->loanagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_discrepancies1','yes'  ,@$praposalChecklist->loanagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_discrepancies1','no' ,@$praposalChecklist->loanagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::text('loanagreement_remark3', isset($praposalChecklist->loanagreement_remark3) ? @$praposalChecklist->loanagreement_remark3 : null, array('class' => 'form-control', 'id'=>'loanagreement_remark3', 'placeholder'=>'', '' )) !!}
        </td>


    </tr>

    
    <tr>
      <td>{!! Form::label('personalguarantee','Personal Guarantee', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_applicable1','yes'  ,@$praposalChecklist->personalguarantee_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_applicable1','no' ,@$praposalChecklist->personalguarantee_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_document1','yes'  ,@$praposalChecklist->personalguarantee_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_document1','no' ,@$praposalChecklist->personalguarantee_document1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_document1_no']) !!}
             No
           </label>
        </td>


           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_discrepancies1','yes'  ,@$praposalChecklist->personalguarantee_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_discrepancies1','no' ,@$praposalChecklist->personalguarantee_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_discrepancies1_no']) !!}
             No
           </label>

              {!! Form::text('personalguarantee_remark3', isset($praposalChecklist->personalguarantee_remark3) ? @$praposalChecklist->personalguarantee_remark3 : null, array('class' => 'form-control', 'id'=>'personalguarantee_remark3', 'placeholder'=>'', '' )) !!}
        </td>


    </tr>

    
    <tr>
      <td>{!! Form::label('signatureverification','Signature Verification', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_applicable1','yes'  ,@$praposalChecklist->signatureverification_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_applicable1','no' ,@$praposalChecklist->signatureverification_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_document1','yes'  ,@$praposalChecklist->signatureverification_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_document1','no' ,@$praposalChecklist->signatureverification_document1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_discrepancies1','yes'  ,@$praposalChecklist->signatureverification_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_discrepancies1','no' ,@$praposalChecklist->signatureverification_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_discrepancies1_no']) !!}
             No
           </label>

           {!! Form::text('signatureverification_remark3', isset($praposalChecklist->signatureverification_remark3) ? @$praposalChecklist->signatureverification_remark3 : null, array('class' => 'form-control', 'id'=>'signatureverification_remark3', 'placeholder'=>'', '' )) !!}
        </td>

    </tr>


    <tr>
        <td>{!! Form::label('dpn','DPN', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_applicable1','yes'  ,@$praposalChecklist->dpn_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_applicable1','no' ,@$praposalChecklist->dpn_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_document1','yes'  ,@$praposalChecklist->dpn_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_document1','no' ,@$praposalChecklist->dpn_document1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_document1_no']) !!}
             No
           </label>
        </td>

 

           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_discrepancies1','yes'  ,@$praposalChecklist->dpn_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_discrepancies1','no' ,@$praposalChecklist->dpn_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_discrepancies1_no']) !!}
             No
           </label>

          {!! Form::text('dpn_remark3', isset($praposalChecklist->dpn_remark3) ? @$praposalChecklist->dpn_remark3 : null, array('class' => 'form-control', 'id'=>'dpn_remark3', 'placeholder'=>'', '' )) !!}
        </td>


    </tr>
    <tr>
  <td>{!! Form::label('boardresolve','BOARD RESOLUTION', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_applicable1','yes'  ,@$praposalChecklist->boardresolve_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_applicable1','no' ,@$praposalChecklist->boardresolve_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_document1','yes'  ,@$praposalChecklist->boardresolve_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_document1','no' ,@$praposalChecklist->boardresolve_document1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_discrepancies1','yes'  ,@$praposalChecklist->boardresolve_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_discrepancies1','no' ,@$praposalChecklist->boardresolve_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_discrepancies1_no']) !!}
             No
           </label>

                {!! Form::text('boardresolve_remark3', isset($praposalChecklist->boardresolve_remark3) ? @$praposalChecklist->boardresolve_remark3 : null, array('class' => 'form-control', 'id'=>'boardresolve_remark3', 'placeholder'=>'', '' )) !!}

        </td>

</tr>



  <tr>
    <td>{!! Form::label('other3','Others', ['class'=>'form-label']) !!}</td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other3_applicable1','yes'  ,@$praposalChecklist->other3_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other3_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other3_applicable1','no' ,@$praposalChecklist->other3_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other3_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other3_document1','yes'  ,@$praposalChecklist->other3_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other3_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other3_document1','no' ,@$praposalChecklist->other3_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other3_document1_no']) !!}
             No
           </label>
        </td>

   <td colspan="2">

        {!! Form::text('other3_remarks', isset($praposalChecklist->other3_remarks) ? @$praposalChecklist->other3_remarks : null, array('class' => 'form-control', 'id'=>'other3_remarks', 'placeholder'=>'Remarks', '', 'style' => 'height:100px;'  )) !!}

    </td>

  </tr>
            </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<!--End Loan Documents--> 
                    </div>
                </div>
    

              </div>


              <div class="tab-pane" id="contact2">
                <form class="well span8">
                  <div class="row">
                        <!--Security Documents-->
<div class="tab-pane" id="" style="padding-left: 20px;padding-right: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">
                      <div>
                        <h3>Security Documents</h3>
                      </div><br>
                      <table class="table"  border="solid">
                        <thead class="thead-dark">
                          <tr>
                            <th><strong>NAME</strong></th>
                            <th style="width: :100px"><strong>APPLICABLE</strong></th>
                            <th><strong>DOCUMENTS</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                           {{--  <th><strong>ATTACHMENT</strong></th> --}}
                          </tr>
                        </thead>
                        <tbody>
  <tr>
      <td>{!! Form::label('mortgagedocument','Mortgage Documents', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('mortgagedocument_applicable1','yes'  ,@$praposalChecklist->mortgagedocument_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_applicable1','no' ,@$praposalChecklist->mortgagedocument_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('mortgagedocument_document1','yes'  ,@$praposalChecklist->mortgagedocument_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_document1','no' ,@$praposalChecklist->mortgagedocument_document1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('mortgagedocument_discrepancies1','yes'  ,@$praposalChecklist->mortgagedocument_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_discrepancies1','no' ,@$praposalChecklist->mortgagedocument_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_discrepancies1_no']) !!}
             No
           </label>


            {!! Form::text('mortgagedocument_remark4', isset($praposalChecklist->mortgagedocument_remark4) ? @$praposalChecklist->mortgagedocument_remark4 : null, array('class' => 'form-control', 'id'=>'mortgagedocument_remark4', 'placeholder'=>'', ''  )) !!}

        </td>


  </tr>

   <tr>
      <td>{!! Form::label('hypothicationagreement','Hypothication Agreement', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_applicable1','yes'  ,@$praposalChecklist->hypothicationagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_applicable1','no' ,@$praposalChecklist->hypothicationagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_document1','yes'  ,@$praposalChecklist->hypothicationagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_document1','no' ,@$praposalChecklist->hypothicationagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_discrepancies1','yes'  ,@$praposalChecklist->hypothicationagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_discrepancies1','no' ,@$praposalChecklist->hypothicationagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_discrepancies1_no']) !!}
             No
           </label>
     

            {!! Form::text('hypothicationagreement_remark4', isset($praposalChecklist->hypothicationagreement_remark4) ? @$praposalChecklist->hypothicationagreement_remark4 : null, array('class' => 'form-control', 'id'=>'hypothicationagreement_remark4', 'placeholder'=>'', ''  )) !!}
        </td>

         
  </tr>

   <tr>
      <td>{!! Form::label('escrowagreement','Escrow Agreement', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_applicable1','yes'  ,@$praposalChecklist->escrowagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_applicable1','no' ,@$praposalChecklist->escrowagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_document1','yes'  ,@$praposalChecklist->escrowagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_document1','no' ,@$praposalChecklist->escrowagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_document1_no']) !!}
             No
           </label>
        </td>

           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_discrepancies1','yes'  ,@$praposalChecklist->escrowagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_discrepancies1','no' ,@$praposalChecklist->escrowagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_discrepancies1_no']) !!}
             No
           </label>
        

           {!! Form::text('escrowagreement_remark4', isset($praposalChecklist->escrowagreement_remark4) ? @$praposalChecklist->escrowagreement_remark4 : null, array('class' => 'form-control', 'id'=>'escrowagreement_remark4', 'placeholder'=>'', ''  )) !!}

        </td>

                
  </tr>

   <tr>
      <td>{!! Form::label('nachagreement','NACH Agreement', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_applicable1','yes'  ,@$praposalChecklist->nachagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_applicable1','no' ,@$praposalChecklist->nachagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_document1','yes'  ,@$praposalChecklist->nachagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_document1','no' ,@$praposalChecklist->nachagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_discrepancies1','yes'  ,@$praposalChecklist->nachagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_discrepancies1','no' ,@$praposalChecklist->nachagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_discrepancies1_no']) !!}
             No
           </label>
  
            {!! Form::text('nachagreement_remark4', isset($praposalChecklist->nachagreement_remark4) ? @$praposalChecklist->nachagreement_remark4 : null, array('class' => 'form-control', 'id'=>'nachagreement_remark4', 'placeholder'=>'', ''  )) !!}
        </td>


  </tr>

   <tr>
      <td>{!! Form::label('pdc','PDCs', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_applicable1','yes'  ,@$praposalChecklist->pdc_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_applicable1','no' ,@$praposalChecklist->pdc_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_document1','yes'  ,@$praposalChecklist->pdc_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_document1','no' ,@$praposalChecklist->pdc_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_discrepancies1','yes'  ,@$praposalChecklist->pdc_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_discrepancies1','no' ,@$praposalChecklist->pdc_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_discrepancies1_no']) !!}
             No
           </label>
          
            {!! Form::text('pdc_remark4', isset($praposalChecklist->pdc_remark4) ? @$praposalChecklist->pdc_remark4 : null, array('class' => 'form-control', 'id'=>'pdc_remark4', 'placeholder'=>'', ''  )) !!}
        </td>

                   
  </tr>

   

   <tr>
      <td>{!! Form::label('pdccoveringletter','PDC Covering Letter', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_applicable1','yes'  ,@$praposalChecklist->pdccoveringletter_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_applicable1','no' ,@$praposalChecklist->pdccoveringletter_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_document1','yes'  ,@$praposalChecklist->pdccoveringletter_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_document1','no' ,@$praposalChecklist->pdccoveringletter_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_discrepancies1','yes'  ,@$praposalChecklist->pdccoveringletter_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_discrepancies1','no' ,@$praposalChecklist->pdccoveringletter_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_discrepancies1_no']) !!}
             No
           </label>

 
       {!! Form::text('pdccoveringletter_remark4', isset($praposalChecklist->pdccoveringletter_remark4) ? @$praposalChecklist->pdccoveringletter_remark4 : null, array('class' => 'form-control', 'id'=>'pdccoveringletter_remark4', 'placeholder'=>'', ''  )) !!}

        </td>

         
  </tr>

   <tr>
      <td>{!! Form::label('other4','Others', ['class'=>'form-label']) !!}</td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other4_applicable1','yes'  ,@$praposalChecklist->other4_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other4_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other4_applicable1','no' ,@$praposalChecklist->other4_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other4_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other4_document1','yes'  ,@$praposalChecklist->other4_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other4_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other4_document1','no' ,@$praposalChecklist->other4_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other4_document1_no']) !!}
             No
           </label>
        </td>

   <td colspan="2">

          {!! Form::text('other4_remarks', isset($praposalChecklist->other4_remarks) ? @$praposalChecklist->other4_remarks : null, array('class' => 'form-control', 'id'=>'other4_remarks', 'placeholder'=>'Remarks', '', 'style' => 'height:100px;'  )) !!}
    </td>
  </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

        </div>

     
<!--End Security Documents-->
    
     </div>
   </div>
   <br>
    <div class="alert alert-default comppress"  role="alert"><span style="width: ">  Before you upload Convert and Compress PDF files 
             find Bellow Link <br>
             <span class="text-center btn btn-primary"><a href="https://pdfcompressor.com/" target="_blank" title="">PDF Compressor</a></span>  </span></div> 
                 <div class="row">
                        <div class="col-md-12" style="margin-left:20px;">
                          {{--{!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}--}}
                          <div id="currentSection">
                            {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                           {{--  {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!} --}}
                            {!! Form::button('Proceed to Submission<i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
                            @if($user->isSME() || $user->isBankUser())
                            {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            @endif
                            {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                          </div>
                        </div>
                      </div>
   </section>
   @section('footer')
   <script>

    $('#saveDetails').click(function (e){
      if(validateForm('#divTab_sub')){
        return true;
      }else{
        e.preventDefault();
      }
    });
  </script>
  <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

{{-- start script from upload doc --}}
 

  @stop