<style>
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
</style> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>
{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
@if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged, array('id' => 'companySharePledged')) !!}
@endif
@if(isset($displayNoneSecurity))
{!! Form::hidden('displayNoneSecurity', $displayNoneSecurity, array('id' => 'displayNoneSecurity')) !!}
@endif
<div class="container-fluid">
  <div class="row">
    <div class="card">
      <div class="card-header" data-background-color="green">
        <h4 class="title">Create Checklist <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h4>
        {{--    <p class="category">Apply new loan</p> --}}
      </div>
      <div class="card-content">
        <div class="tab-content tab-design" style="padding-top:20px;">
          <div class="btn-group leftside_tab" data-toggle="tab" style="margin-left:10px;">
            <a id="lnkLoanDtls1" href="#" class="btn btn-large btn-success btn-space active" style="font-size: 14px !important;">KYC of Business</a>
            <a id="lnkLoanDtls2" href="#" class="btn btn-large btn-success btn-space {{{ $user->isAnalyst() ? '' : 'disabled'}}}" style="font-size: 14px !important;">KYC Of Promoters/Guarantor</a>
            <a id="lnkLoanDtls3" href="#" class="btn btn-large btn-success btn-space {{{ $user->isAnalyst() ? '' : 'disabled'}}}" style="font-size: 14px !important;">Loan Documents</a>
            <a id="lnkLoanDtls4" href="#" class="btn btn-large btn-success btn-space {{{ $user->isAnalyst() ? '' : 'disabled'}}}" style="font-size: 14px !important;">Security Documents</a>
          </div>
          <div id="divTab_sub1" class="collapse" style="margin-left:25px;margin-right:25px;">

            
           {{--  new --}}
            <hr>
                      <!-- Start Kyc Details Of company--> 
              <div class="tab-pane" id="" style="padding-left: 20px;padding-right: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">

                      <div>
                        <h3>KYC of Business</h3>
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
        

<!-- End Kyc Details Of company--> 

            <hr>
           {{--  end new --}}
            <br>

            <div class="alert alert-default comppress"  role="alert"><span style="width: ">  Before you upload Convert and Compress PDF files 
             find Bellow Link <br>
             <span class="text-center btn btn-primary"><a href="https://pdfcompressor.com/" target="_blank" title="">PDF Compressor</a></span>  </span></div> 
             <br>
             <!-- start F1.1 -->
             @if($deletedQuestionHelper->isQuestionValid("F1.1"))
             <div id="" class="panel panel-success">

              <div class="panel-heading">Please click on below to upload business documents</div>
              <br>
              <div class="col-sm-12">
 
                {{-- <div class="col-md-3">
                  <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="uploadBank">
                  <label for="input Bank Statement">Bank Statement</label>
                </div> --}}
                
               {{--  <div class="col-md-2">
                  <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="uploadCibil">
                  <label for="CIBIL Report ">CIBIL Report </label>
                </div> --}}
                
                <div class="col-md-4">
                  <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="uploadKyc">
                  <label for="inputKYC Details (Mandatory) ">Upload KYC of Business</label>
                </div>


                <div class="col-md-3">
                  <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="uploadFinancial">
                  <label for="inputFinancials Reports/Balance Sheets ">Others</label>
                </div>

              </div>
              <br><br>
            </div>
            <br><br>


            @endif
            <!-- end F1.1 -->

              <!-- start F1.3 -->
            
              <fieldset class="upKyc">
                <div id="yearQue37" class="form-group">
                  <div id="kycdetails" class="panel panel-success">
                    <div class="panel-heading">KYC Details</div>
                    <div style="padding: 10px;">
                      <div class="row">
                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'MOA') !!}
                          {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                          {!! Form::file('kycDetails[1][pancard_file_path]', ['class' => 'form-control upload_details',
                          'id'=>'pancard_file','data-mandatory'=>''.$mandatoryField.'' ]) !!}
                          {!! Form::hidden('pan_card_check1', 0, array('id' => 'pan_card_check1')) !!}
                          @if(isset($pancard_file))
                          <input type="hidden" name="text" value="44" id="openClosePanCard">
                          <a href='{{ $pancard_file }}' class="btn">Download File</a>
                          @endif
                        </div>
                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'PAN Card') !!}
                          {!! Form::file('kycDetails[1][vatreg_file_path]', ['class' => 'form-control
                          upload_details', 'id'=>'vatregistration_file']) !!}
                          @if(isset($vatregistration_file))
                          <a href='{{ $vatregistration_file }}' class="btn">Download File</a>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'COR') !!}
                          {!! Form::file('[shopestablish_file_path]', ['class' => 'form-control upload_details',
                          'id'=>'shopestablish_file_path']) !!}    {{-- //shopestablish_file --}}
                          @if(isset($shopestablish_file_path))
                          <a href='{{ $shopestablish_file_path }}' class="btn">Download File</a>
                          @endif
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div id="Que41" class="">
                            {!! Form::label('Gurav', 'Gurav') !!}sssssssssssss
                            {!! Form::file('gurav', ['class' => 'form-control upload_details','id'=>'gurav']) !!}
                          </div>
                          @if(isset($gurav))
                          <a href='{{ $gurav }}' class="btn">Download File</a>
                        
                          @endif
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'Shop Certificate') !!}
                          {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                          {!! Form::file('kycDetails[1][addproof_file_path]', ['class' => 'form-control
                          upload_details', 'id'=>'addressproof_company_file','data-mandatory'=>''.$mandatoryField.'']) !!}
                          {!! Form::hidden('addressproof_company_file_check', 0, array('id' => 'addressproof_company_file_check')) !!}
                          @if(isset($addressproof_company_file))
                          <a href='{{ $addressproof_company_file }}' class="btn">Download File</a>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'GST Certificate') !!}
                          {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                          {!! Form::file('kycDetails[1][kyc_extra_file1_path]', ['class' => 'form-control upload_details','id'=>'optional_file1']) !!}
                          {!! Form::hidden('optional_file1_check', 0, array('id' => 'optional_file1_check')) !!}
                          @if(isset($optional_file1))
                          <a href='{{ $optional_file1 }}' class="btn">Download File</a>
                          @endif
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'CIBIL Of Entity') !!}
                          {!! Form::file('kycDetails[1][kyc_extra_file2_path]', ['class' => 'form-control upload_details',
                          'id'=>'optional_file2',$setDisable]) !!}
                          @if(isset($optional_file2))
                          <a href='{{ $optional_file2 }}' class="btn">Download File</a>
                          @endif
                        </div> 
                      
                        

                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
             
              <!-- end F1.3 -->

              {{-- others start --}}
                          <div id="clearfix" style="padding: 10px;"></div>
            <fieldset class="upFinancial">
              <div id="yearQue37" class="form-group">
                <div id="finreports" class="panel panel-success">
                  <div class="panel-heading">Others Documents</div>
                  <div style="padding: 10px;">
                    <div class="row">
                      <?php $i = 0; ?>
                      @foreach($bl_year as $blyear)
                      <?php $i++; ?>

                      <?php
                        echo "<pre>";
                        print_r($blplfile);
                        echo "</pre>";
                      ?>
                      @if($i <= 2)
                      <div class="col-md-4">
                        {!! Form::label('other') !!}
                        @if($i<=1)                    
                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                        {!! Form::file('asasasassasa'.$i.'_path', ['class' => 'form-control upload_details','id'=>'blplfile_'.$i ,'data-mandatory'=>''.$mandatoryField.'' ] ) !!}
                        @else
                        {!! Form::file('asasasassasa'.$i.'_path', ['class' => 'form-control upload_details','id'=>'blplfile_'.$i ] ) !!}
                        @endif
                        {!! Form::hidden('fin_year_'.$i, 0, array('id' => 'fin_year_'.$i)) !!}
                        @if(isset($blplfile['asasasassasa'.$i.'_path']))
                        <input type="hidden" name="text" value="7" id="openClose">
                        <div>
                          <a href='{{ $blplfile['asasasassasa'.$i.'_path'] }}' class="btn">Download File</a>
                        </div>
                        @endif
                      </div>
                      @endif
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
            
            <!-- end F1.1 -->

              {{-- others end --}}
            </div>
            <!-- Promotor KYC & Financials -->
            <div id="divTab_sub2" class="collapse" style="margin-left:25px;margin-right:25px;">
              
             {{--  new --}}
              <hr>

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

              <hr>
                <div class="alert alert-default comppress"  role="alert"><span style="width: ">  Before you upload Convert and Compress PDF files 
             find Bellow Link <br>
             <span class="text-center btn btn-primary"><a href="https://pdfcompressor.com/" target="_blank" title="">PDF Compressor</a></span>  </span></div>
             <br>
              {{-- end new --}}
              <!-- start F2.1 -->
              @if($deletedQuestionHelper->isQuestionValid("F2.1"))
              <div id="" class="panel panel-success">
                <div class="panel-heading">Please click on below to upload Promoter/Guarantor Documents</div>
                <br>
                <div class="col-sm-12">

{{--                   <div class="col-md-4">
                    <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="f2uploadBank">
                    <label for="Bank Statement">Bank Statement</label>
                  </div>

                  <div class="col-md-4">
                    <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="f2uploadFinancil">
                    <label for="Bank Statement">Financials</label>
                  </div> --}}

                  <div class="col-md-4">
                    <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="f2uploadKyc">
                    <label for="Bank Statement">KYC Details</label>
                  </div>
                </div>
                <br><br>
              </div>
              <br><br>

              @endif
              <!-- end F2.2 -->
              <!-- start F2.3 -->
              @if($deletedQuestionHelper->isQuestionValid("F2.3"))
              <fieldset class="f2upKyc">
                <div id="yearQue37" class="form-group">
                  <div id="kycdetailspr" class="panel panel-success">
                    <div class="panel-heading">KYC Details</div>
                    <div style="padding: 10px;">
                      <div class="row">
                   {{--      <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'PAN') !!}
                          {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                          {!! Form::select('prom_kyc_addproof_name', array('' => 'Please select','Electricity Bill' =>
                            'Electricity Bill', 'Aadhar Card' => 'Aadhar Card', 'Ration Card' => 'Ration Card','Passport' => 'Passport'), $model['prom_kyc_addproof_name'],
                            ['id' => 'promoter_proof_address', 'class' => 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}
                          </div> --}}
                          <div class="col-sm-12 col-lg-6">
                            {!! Form::label(null,'PAN') !!}
                            {!! Form::file('prom_kyc_addproof_file_path', ['class' => 'form-control upload_details',
                            'id'=>'promoter_proof_address_file','data-mandatory'=>''.$mandatoryField.'' ]) !!}
                            {!! Form::hidden('prom_kyc_addproof_file_path_check', 0, array('id' => 'prom_kyc_addproof_file_path_check')) !!}
                            @if(isset($promoter_proof_address_file))
                            <input type="hidden" name="text" value="223" id="openClosePromKyc">
                            <a href='{{ $promoter_proof_address_file }}' class="btn">Download File</a>
                            @endif
                          </div>
                        </div>
                        <div class="row">
                    {{--       <div class="col-sm-12 col-lg-6">
                            {!! Form::label(null,'Address Proof') !!}
                            {!! Form::select('prom_idproof_name', array('' => 'Please select','Passport' =>
                              'Passport', 'Driving License' => 'Driving License', 'Election Card' => 'Election Card','PAN' => 'PAN'), $model['prom_idproof_name'], ['id' =>
                              'promoter_identity_proof', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}
                            </div> --}}
                            <div class="col-sm-12 col-lg-6">
                              {!! Form::label('AssetsFA', 'Address Proof') !!}
                              {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                              {!! Form::file('prom_idproof_file_path', ['class' => 'form-control upload_details',
                              'id'=>'identityproof_file','data-mandatory'=>''.$mandatoryField.'']) !!}
                              {!! Form::hidden('identity_proof_file_check', 0, array('id' => 'identity_proof_file_check')) !!}
                              @if(isset($identity_proof_file))
                              <a href='{{ $identity_proof_file }}' class="btn">Download File</a>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12 col-lg-6">
                              {!! Form::label('AssetsFA', 'Network Certificate') !!}
                              {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                              {!! Form::file('prom_visiting_file_path', ['class' => 'form-control upload_details',
                              'id'=>'visitingcard_file','data-mandatory'=>''.$mandatoryField.'']) !!}
                              {!! Form::hidden('visitingcard_file_check', 0, array('id' => 'visitingcard_file_check')) !!}
                              @if(isset($visitingcard_file))

                              <a href='{{ $visitingcard_file }}' class="btn">Download File</a>
                              @endif

                            </div>
                            <div class="col-sm-12 col-lg-6">
                              {!! Form::label(null,'CIBIL of Promoter') !!}
                              {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                              {!! Form::file('prom_pancard_file_path', ['class' => 'form-control upload_details',
                              'id'=>'pan_promoter_file','data-mandatory'=>''.$mandatoryField.'' ]) !!}
                              {!! Form::hidden('pan_promoter_file_check', 0, array('id' => 'pan_promoter_file_check')) !!}
                              @if(isset($pan_promoter_file))
                              <a href='{{ $pan_promoter_file }}' class="btn">Download File</a>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  @endif
                  <!-- end F2.3 -->
                </div>
                <div id="divTab_sub3" class="collapse" style="margin-left:25px;margin-right:25px;">

                  
                  {{-- new --}}
                  <hr>

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

                  <hr>
            <div class="alert alert-default comppress"  role="alert"><span style="width: ">  Before you upload Convert and Compress PDF files find Bellow Link <br>
             <span class="text-center btn btn-primary"><a href="https://pdfcompressor.com/" target="_blank" title="">PDF Compressor</a></span>  </span></div>

                  {{-- end new --}}
                  <br>
                  <div id="" class="panel panel-success">
                    <div class="panel-heading">Please Click on the below to upload Loan Documents</div>
                    <br>
                    <div class="col-sm-12">
              {{--         <div class="col-md-4">
                        <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="f3uploadCorporate">
                        <label for="Bank Statement">Corporate Details </label>
                      </div>

                      <div class="col-md-4">
                        <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="f3uploadEquipment">
                        <label for="Bank Statement">Invoice Copy of Equipment Purchase</label>
                      </div>  --}}
                      <div class="col-md-4">
                        <input type="checkbox" class="securityColl-input" name="finacial" value="finacial" id="f3uploadBill">
                        <label for="Bank Statement">Upload Documents</label>
                      </div>
                    </div>
                    <br><br>
                  </div>
                  <br><br>

                    <!-- end F3.3 -->
                    <!-- start F3.4 -->
                    <fieldset class="f3upBill">
                      <div id="invcopy">
                        @for($i=1; $i < $maxInvoiceBillDetails; $i++)
                        @if($i == 1)
                        <div id="InvCopy_<?php echo $i; ?>" class="panel panel-success">
                          <div class="panel-heading">Kyc details of loan documents</div>
                          @else
                          <div id="InvCopy_<?php echo $i; ?>" class="panel panel-success collapse">
                            <div class="panel-heading">Kyc details of loan documents- {{$i}}</div>
                            @endif
                            <div class="row" style="padding: 10px;">
                              <div class="col-sm-12 col-lg-6">
                                {!! Form::label('', 'Upload File') !!}
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                {!! Form::file('invoiceBillFile[business_invoice_bill'.$i.'_file_path]', ['class' => 'form-control upload_details', 'id'=>'invoicecopy_file_'.$i,'data-mandatory'=>''.$mandatoryField.'']) !!}
                                {!! Form::hidden('invoicecopy_file_check_'.$i, 0, array('id' => 'invoicecopy_file_check_'.$i)) !!}
                                @if(isset($invoiceCopy['business_invoice_bill'.$i.'_file_path']))
                                <input type="hidden" name="text" value="323" id="openCloseBizInvBill">
                                <a href='{{ $invoiceCopy['business_invoice_bill'.$i.'_file_path'] }}' class="btn">Download File</a>
                                @endif
                              </div>
                            </div>
                          </div>
                          @endfor
                          <div class="form-group">
                            {!! Form::button('Add Loan Documents', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_invoicecopy']) !!}
                            {!! Form::button('Delete Loan Documents', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_invoicecopy']) !!}
                            {!! Form::hidden('num_invoice_detail', 1, array('id' => 'num_invoice_detail')) !!}
                          </div>
                        </div>
                        <!-- end F4 -->
                      </div>
                      <div id="divTab_sub4" class="collapse" style="margin-left:25px;margin-right:25px;">
                        <br>
                        {{-- new --}}
                        <hr>
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


                        <hr>
         <div class="alert alert-default comppress"  role="alert"><span style="width: ">  Before you upload Convert and Compress PDF files find Bellow Link <br>
             <span class="text-center btn btn-primary"><a href="https://pdfcompressor.com/" target="_blank" title="">PDF Compressor</a></span>  </span></div>


                        {{-- end new --}}
                        <br>
                        <!-- Security Documnet__Form 4 -->
                        <!-- start F4.1 -->
                        <div id="yearQue37" class="form-group">
                          @for($i=1; $i < $maxSecurityDocument; $i++)
                          @if($i == 1)
                          <div id="security_doc_<?php echo $i; ?>" class="panel panel-success">
                            <div class="panel-heading">Security Document Details - Please Upload Available Security Documents</div>
                            @else
                            <div id="security_doc_<?php echo $i; ?>" class="panel panel-success collapse">
                              <div class="panel-heading">Security Document Details- {{$i}}</div>
                              @endif
                              <div style="padding: 10px;">
                                <div class="row">
                                  <div class="col-sm-12 col-lg-6">
                                    {!! Form::label('', 'Mortagage Document')!!}
                                    {!! Form::file('security_lastvaluation_file[last_pro_val_report'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastvaluation_file_'.$i]) !!}
                                    {!! Form::hidden('last_pro_val_report_'.$i, 0, array('id' => 'last_pro_val_report_'.$i)) !!}
                                    @if(isset($lastValuation[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $lastValuation[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $lastValuation[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'Hypothication Agreement') !!}
                                      {!! Form::file('security_titlesearch_file[pro_title_search_report'.$i.'_path]', ['class' => 'form-control upload_details', 'id'=>'security_titlesearch_file_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('pro_title_search_report_'.$i, 0, array('id' => 'pro_title_search_report_'.$i)) !!}
                                    @if(isset($titleSearch[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $titleSearch[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $titleSearch[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'Escrow Agreement') !!}
                                      {!! Form::file('security_propertytax_file[pro_tax_card'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'security_propertytax_file_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('pro_tax_card_'.$i, 0, array('id' => 'pro_tax_card_'.$i)) !!}
                                    @if(isset($propertyTax[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $propertyTax[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $propertyTax[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'NACH Agreement') !!}
                                      {!! Form::file('security_occupation_file[oc'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'security_occupation_file_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('oc_'.$i, 0, array('id' => 'oc_'.$i)) !!}
                                    @if(isset($occupation[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $occupation[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $occupation[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'PDCs') !!}
                                      {!! Form::file('security_societyshare_file[society_share_cert'.$i.'_path]', ['class' =>'form-control upload_details','id'=>'security_societyshare_file_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('society_share_cert_'.$i, 0, array('id' => 'society_share_cert_'.$i)) !!}
                                    @if(isset($socityShare[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                    {{--array('file_name' => $socityShare[$i-1]),--}}
                                    {{--array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $socityShare[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'PDC Covering Letter') !!}
                                      {!! Form::file('security_712extract_file[copy_7_12_extract'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'security_712extract_file_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('copy_7_12_extract_'.$i, 0, array('id' => 'copy_7_12_extract_'.$i)) !!}
                                    @if(isset($extractFile[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                    {{--array('file_name' => $extractFile[$i-1]),--}}
                                    {{--array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $extractFile[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12 col-lg-6">
                                    @if($loanType == 'LAP')
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'Copy of Last Sales/Purchase Deed')!!}
                                      {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                      {!! Form::file('security_lastsaledeed_file[copy_last_sales_pur'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastsaledeed_file_'.$i,'data-mandatory'=>''.$mandatoryField.'' ]) !!}
                                    </div>
                                    @else
                                    <div id="Que46" class="">
                                      @if($isQuestionMandatory->isMandatory('avl_doc_name_1','Sale /Purchase Deed'))
                                      {!! Form::label('', 'Copy of Last Sales/Purchase Deed')!!}
                                      {!! Form::file('security_lastsaledeed_file[copy_last_sales_pur'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastsaledeed_file_'.$i,'data-mandatory'=>''.$mandatoryField.'' ]) !!}
                                      @else
                                      {!! Form::label('', 'Others')!!}
                                      {!! Form::file('security_lastsaledeed_file[copy_last_sales_pur'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastsaledeed_file_'.$i]) !!}
                                      @endif
                                    </div>
                                    @endif
                                    {!! Form::hidden('copy_last_sales_pur_'.$i, 0, array('id' => 'copy_last_sales_pur_'.$i)) !!}
                                    @if(isset($lastSaledeed[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                    {{--array('file_name' => $lastSaledeed[$i-1]),--}}
                                    {{--array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $lastSaledeed[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'Others2') !!}
                                      {!! Form::file('muncipal_plan[municipal_plan'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'muncipal_plan_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('municipal_plan_count_'.$i, 0, array('id' => 'municipal_plan_count_'.$i)) !!}
                                    @if(isset($muncipalFile[$i-1]))
                                    {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                    {{--array('file_name' => $muncipalFile[$i-1]),--}}
                                    {{--array('class' => 'btn',$setDisable)) !!}--}}
                                    <a href='{{ $muncipalFile[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12 col-lg-6">
                                    <div id="Que46" class="">
                                      {!! Form::label('', 'Others3') !!}
                                      {!! Form::file('electricity_bill[electricity_bill_'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'electricity_bill_'.$i]) !!}
                                    </div>
                                    {!! Form::hidden('electricity_bill_count_'.$i, 0, array('id' => 'electricity_bill_count_'.$i)) !!}
                                    @if(isset($electricityBill[$i-1]))
                                    <a href='{{ $electricityBill[$i-1] }}' class="btn">Download File</a>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endfor
                     {{--        <div class="form-group">
                              {!! Form::button('Add Security Document Details', ['class' =>
                              'btn btn-primary add_promo_button', 'id' => 'add_security',$setDisable]) !!}
                              {!! Form::button('Delete Security Document Details', ['class' =>
                              'btn btn-warning rem_promo_button collapse', 'id' =>'rem_security',$setDisable]) !!}
                              {!! Form::hidden('num_security_doc', 1, array('id' => 'num_security_doc')) !!}
                            </div> --}}
                          </div>
                        {{--</div>--}}
                      </div>
                      <!-- end F4 -->
                      <div class="row">
                        <div class="col-md-12" style="margin-left:20px;">
                          {{--{!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}--}}
                          <div id="currentSection">
                            {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            {!! Form::button('Proceed to Submission<i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            @if($user->isSME() || $user->isBankUser())
                            {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            @endif
                            {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <link rel="stylesheet" href={{{URL::asset("/css/sme.css")}}} type="text/css" media="all" />
                <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
                <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
                <style type="text/css" media="screen">
                table.ui-datepicker-calendar{
                  display: none !important;
                }
              </style>
              <script type="text/javascript">
                jQuery(document).ready(function ($) {
                  $('#fromDateStat').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM-yy',
                    yearRange: '2015:2019',
                    monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
                    monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
                    onClose: function(dateText, inst) {
                      var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).datepicker('setDate', new Date(year, month, 1));
                    },
                  })
                  $('#toDateStat').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM-yy',
                    yearRange: '2015:2019',
                    monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
                    monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
                    onClose: function(dateText, inst) {
                      var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).datepicker('setDate', new Date(year, month, 1));
                    },
                  })
                } );
                jQuery(document).ready(function($) {
                  jQuery(".upFinancial").hide();
                  jQuery("#uploadFinancial").click(function() {
                    if($(this).is(":checked")) {
                      $(".upFinancial").show();
                    } else {
                      $(".upFinancial").hide();
                    }
                  });
                });
                jQuery(document).ready(function($) {
                  jQuery(".upBank").hide();
                  jQuery("#uploadBank").click(function() {
                    if($(this).is(":checked")) {
                      $(".upBank").show();
                    } else {
                      $(".upBank").hide();
                    }
                  });
                });
                jQuery(document).ready(function($) {
                  jQuery(".upCibil").hide();
                  jQuery("#uploadCibil").click(function() {
                    if($(this).is(":checked")) {
                      $(".upCibil").show();
                    } else {
                      $(".upCibil").hide();
                    }
                  });
                });
                jQuery(document).ready(function($) {
                  jQuery(".upKyc").hide();
                  jQuery("#uploadKyc").click(function() {
                    if($(this).is(":checked")) {
                      $(".upKyc").show();
                    } else {
                      $(".upKyc").hide();
                    }
                  });
                });
                jQuery(document).ready(function($) {
                  jQuery(".f2upKyc").hide();
                  jQuery("#f2uploadKyc").click(function() {
                    if($(this).is(":checked")) {
                      $(".f2upKyc").show();
                    } else {
                      $(".f2upKyc").hide();
                    }
                  });
                });
                jQuery(document).ready(function($) {
                  jQuery(".f2upfinancial").hide();
                  jQuery("#f2uploadFinancil").click(function() {
                    if($(this).is(":checked")) {
                      $(".f2upfinancial").show();
                    } else {
                      $(".f2upfinancial").hide();
                    }
                  });
                });
                jQuery(document).ready(function($) {
                  jQuery(".f2upBank").hide();
                  jQuery("#f2uploadBank").click(function() {
                    if($(this).is(":checked")) {
                      $(".f2upBank").show();
                    } else {
                      $(".f2upBank").hide();
                    }
                  });
                });
                                                    //Form 3
                                                    jQuery(document).ready(function($) {
                                                      jQuery(".f3upCorporate").hide();
                                                      jQuery("#f3uploadCorporate").click(function() {
                                                        if($(this).is(":checked")) {
                                                          $(".f3upCorporate").show();
                                                        } else {
                                                          $(".f3upCorporate").hide();
                                                        }
                                                      });
                                                    });
                                                    jQuery(document).ready(function($) {
                                                      jQuery(".f3upEquipment").hide();
                                                      jQuery("#f3uploadEquipment").click(function() {
                                                        if($(this).is(":checked")) {
                                                          $(".f3upEquipment").show();
                                                        } else {
                                                          $(".f3upEquipment").hide();
                                                        }
                                                      });
                                                    });
                                                    jQuery(document).ready(function($) {
                                                      jQuery(".f3upBill").hide();
                                                      jQuery("#f3uploadBill").click(function() {
                                                        if($(this).is(":checked")) {
                                                          $(".f3upBill").show();
                                                        } else {
                                                          $(".f3upBill").hide();
                                                        }
                                                      });
                                                    });
                                                  </script>
                                                  <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        // alert($('#openClose').val());
                                                        if($('#openClose').val()=='7'){
                                                         $( "#uploadFinancial").prop('checked', true);
                                                         $(".upFinancial").show();
                                                       }
                                                       if($('#openCloseBankStat').val()=='22'){
                                                         $( "#uploadBank").prop('checked', true);
                                                         $(".upBank").show();
                                                       }
                                                       if($('#openCloseUpCibil').val()=='33'){
                                                         $( "#uploadCibil").prop('checked', true);
                                                         $(".upCibil").show();
                                                       }
                                                       if($('#openClosePanCard').val()=='44'){
                                                         $( "#uploadKyc").prop('checked', true);
                                                         $(".upKyc").show();
                                                       }
                                                       if($('#openClosePromBank').val()=='221'){
                                                         $( "#f2uploadBank").prop('checked', true);
                                                         $(".f2upBank").show();
                                                       }
                                                       if($('#openClosePromFin').val()=='222'){
                                                         $( "#f2uploadFinancil").prop('checked', true);
                                                         $(".f2upfinancial").show();
                                                       }
                                                       if($('#openClosePromKyc').val()=='223'){
                                                         $( "#f2uploadKyc").prop('checked', true);
                                                         $(".f2upKyc").show();
                                                       }

                                                       if($('#openCloseBizCor').val()=='321'){
                                                         $( "#f3uploadCorporate").prop('checked', true);
                                                         $(".f3upCorporate").show();
                                                       }
                                                       if($('#openCloseBizInvEq').val()=='322'){
                                                         $( "#f3uploadEquipment").prop('checked', true);
                                                         $(".f3upEquipment").show();
                                                       }
                                                       if($('#openCloseBizInvBill').val()=='323'){
                                                         $( "#f3uploadBill").prop('checked', true);
                                                         $(".f3upBill").show();
                                                       }

                                                       var cnt = 1;
                                                       $('#divTab_sub1').show();
                                                       $('#divTab_sub2').hide();
                                                       $('#divTab_sub3').hide();
                                                       $('#divTab_sub4').hide();
                                                       $('#saveDetails').hide();
                                                       $('#raise_query').hide();
                                                       $(lnkLoanDtls1).click(function () {
                                                        $('#divTab_sub1').show();
                                                        $('#currentSection').show();
                                                        cnt=1;
                                                        $('#divTab_sub2').hide();
                                                        $('#divTab_sub3').hide();
                                                        $('#divTab_sub4').hide();
                                                        $('#nextIn').show();
                                                        $('#backIn').hide();
                                                        $(this).addClass("active").siblings().removeClass("active");
                                                        $('#saveDetails').hide();
                                                        $('#raise_query').hide();
                                                      });
                                                       $(lnkLoanDtls2).click(function () {
                                                        $('#divTab_sub2').show();
                                                        $('#currentSection').show();
                                                        cnt=2;
                                                        $('#divTab_sub1').hide();
                                                        $('#divTab_sub3').hide();
                                                        $('#divTab_sub4').hide();
                                                        $('#backIn').show();
                                                        $(this).addClass("active").siblings().removeClass("active");
                                                        $('#saveDetails').hide();
                                                        $('#raise_query').hide();
                                                      });
                                                       $(lnkLoanDtls3).click(function () {
                                                        $('#divTab_sub3').show();
                                                        $('#currentSection').show();
                                                        cnt=3;
                                                        $('#divTab_sub1').hide();
                                                        $('#divTab_sub2').hide();
                                                        $('#divTab_sub4').hide();
                                                        $('#backIn').show();
                                                        $(this).addClass("active").siblings().removeClass("active");
                                                        $('#saveDetails').hide();
                                                        $('#raise_query').hide();
                                                      });
                                                       $(lnkLoanDtls4).click(function () {
                                                        $('#divTab_sub4').show();
                                                        cnt=4;
                                                        $('#divTab_sub1').hide();
                                                        $('#divTab_sub2').hide();
                                                        $('#divTab_sub3').hide();
                                                        $('#currentSection').show();
                                                        $('#nextIn').hide();
                                                        $('#backIn').show();
                                                        $(this).addClass("active").siblings().removeClass("active");
                                                        $('#saveDetails').show();
                                                        $('#raise_query').show();
                                                      });
                                                       /*---- end toggle function*/
                                                       if(cnt==1){
                                                        $('#backIn').hide();
                                                      }
                                                      $("#nextIn").click(function (){
                                                        var shareIfExist=$('#companySharePledged').val();
                                                        var displayNoneSec=$('#displayNoneSecurity').val();
                                                        // alert(shareIfExist);
                                                        if(cnt==1){
                                                          //alert(shareIfExist);
                                                          if($('#divTab_sub'+cnt).css('display') == 'block'){
                                                            if(validateForm('#divTab_sub'+cnt,'#promter')){
                                                              $('#divTab_sub'+cnt).hide();
                                                              $('#lnkLoanDtls'+cnt).removeClass('active');
                                                              cnt++;
                                                              $('#lnkLoanDtls'+cnt).removeClass('disabled');
                                                              $('#lnkLoanDtls'+cnt).addClass('active');
                                                              $('#divTab_sub'+cnt).show();
                                                              $('#currentSection').show();
                                                              $('#backIn').show();
                                                              $('#saveDetails').hide();
                                                              $('#raise_query').hide();
                                                            }
                                                          }
                                                        }
                                                        else if(cnt==2){
                                                          if($('#divTab_sub'+cnt).css('display') == 'block'){
                                                            if(validateForm('#divTab_sub'+cnt,'#promter')){
                                                              $('#divTab_sub'+cnt).hide();
                                                              $('#currentSection').hide();
                                                              $('#lnkLoanDtls'+cnt).removeClass('active');
                                                              cnt++;
                                                              $('#lnkLoanDtls'+cnt).removeClass('disabled');
                                                              $('#lnkLoanDtls'+cnt).addClass('active');
                                                              $('#divTab_sub'+cnt).show();
                                                              $('#currentSection').show();
                                                              $('#backIn').show();
                                                              /* $('#saveDetails').hide();
                                                              $('#raise_query').hide();*/
                                                              if(shareIfExist!=undefined || displayNoneSec==1){
                                                                $('#saveDetails').show();
                                                                $('#raise_query').show();
                                                                $('#nextIn').hide();
                                                                $('#lnkLoanDtls3').addClass('disabled');
                                                              }else{
                                                                $('#saveDetails').hide();
                                                                $('#raise_query').hide();
                                                              }
                                                            }
                                                          }
                                                        }
                                                        else if(cnt==3){
                                                          if($('#divTab_sub'+cnt).css('display') == 'block'){
                                                            if(validateForm('#divTab_sub'+cnt,'#promter')){
                                                              $('#divTab_sub'+cnt).hide();
                                                              $('#currentSection').show();
                                                              $('#lnkLoanDtls'+cnt).removeClass('active');
                                                              cnt++;
                                                              $('#lnkLoanDtls'+cnt).removeClass('disabled');
                                                              $('#lnkLoanDtls'+cnt).addClass('active');
                                                              $('#divTab_sub'+cnt).show();
                                                              $('#backIn').show();
                                                              $('#nextIn').hide();
                                                              $('#saveDetails').show();
                                                              $('#raise_query').show();
                                                            }
                                                          }
                                                        }
                                                        else if(cnt==4){
                                                          if($('#divTab_sub'+cnt).css('display') == 'block'){
                                                            if(validateForm('#divTab_sub'+cnt,'#promter')){
                                                              $('#divTab_sub'+cnt).hide();
                                                              //$('#currentSection').show();
                                                              $('#lnkLoanDtls'+cnt).removeClass('active');
                                                              cnt++;
                                                              $('#lnkLoanDtls'+cnt).removeClass('disabled');
                                                              $('#lnkLoanDtls'+cnt).addClass('active');
                                                              $('#divTab_sub'+cnt).show();
                                                              $('#saveDetails').show();
                                                              $('#raise_query').show();
                                                            }
                                                          }
                                                        }
                                                      });
$("#backIn").click(function (){
  $('#nextIn').show();
  $('#divTab_sub'+cnt).hide();
  $('#lnkLoanDtls'+cnt).removeClass('active');
  cnt--;
                                                        // alert(cnt);
                                                        if(cnt==1){
                                                          $('#backIn').hide();
                                                        }
                                                        $('#divTab_sub'+cnt).show();
                                                        $('#lnkLoanDtls'+cnt).addClass('active');
                                                        $('#lnkLoanDtls'+cnt).removeClass('disabled');
                                                        $('#saveDetails').hide();
                                                        $('#raise_query').hide();
                                                      });
$('#saveDetails').click(function (e){
  if(cnt==4){
    if(validateForm('#divTab_sub'+cnt,'#promter')){
      return true;
    }else{
      e.preventDefault();
    }
  }
});
$(".upload_details").filestyle({buttonName: "btn-primary"});
                                                      var add_tab1_kyc_count = 1; // Hidden Field Counter Variable
                                                      var add_equipmentbillcopy_count = 1;
                                                      var add_invoicecopy_count = 1;
                                                      var add_security_count = 1;
                                                      //=======================================================//
                                                      //----------Company - Financials Reports/Balance Sheets ----------//
                                                      var jArrayTemp = <?php echo json_encode($blplfile ); ?>;
                                                      var i = 1;
                                                      $.each( jArrayTemp, function( index, value ){
                                                        value = getFileName(value);
                                                        //console.log(value);
                                                        $('#fin_year_'+i).val(1);
                                                        $('#blplfile_' + i).next().children().first().val(value);
                                                        i++;
                                                        if(value !=''){
                                                          $('#lnkLoanDtls1').removeClass('disabled');
                                                        }
                                                      });
                                                      //----------Company - Bank Statement----------//
                                                      var existing_records = {{count($cmpnybankstmt_file)}};
                                                      var jArray= <?php echo json_encode($cmpnybankstmt_file ); ?>;
                                                      var i = 1;
                                                      $.each( jArray, function( index, value ){
                                                        $('#bnkst_' + i).show();
                                                        value = getFileName(value);
                                                        $('#'+index).next().children().first().val(value);
                                                        if(i==3){
                                                          $('#rem_tab1_kyc').show();
                                                          add_tab1_kyc_count = i;
                                                        }
                                                        $("#num_bank").val(i);
                                                        i++;
                                                      });
                                                      var a = $("#num_bank").val();
                                                      if(a > 1){
                                                        for (var j = 2; j <= a; j++) {
                                                          $('#bnkst_' + j).show();
                                                          if(j == 2){
                                                            $('#rem_tab1_kyc').show();
                                                          }
                                                          if (j == 3) {
                                                            $('#add_tab1_kyc').hide();
                                                          }
                                                          add_tab1_kyc_count = j;
                                                        }
                                                      }
                                                      $('#add_tab1_kyc').click(function () {
                                                        add_tab1_kyc_count = add_tab1_kyc_count + 1;
                                                        $('#num_bank').val(add_tab1_kyc_count);
                                                        $('#bnkst_' + add_tab1_kyc_count).show();
                                                        if (add_tab1_kyc_count == 3) {
                                                          $('#add_tab1_kyc').hide();
                                                        }
                                                        else {
                                                          $('#add_tab1_kyc').show();
                                                        }
                                                        if (add_tab1_kyc_count == 1) {
                                                          $('#rem_tab1_kyc').hide();
                                                        }
                                                        else {
                                                          $('#rem_tab1_kyc').show();
                                                        }
                                                      });
                                                      $('#rem_tab1_kyc').click(function () {
                                                        $('#bnkst_' + add_tab1_kyc_count).hide();
                                                        add_tab1_kyc_count = add_tab1_kyc_count - 1;
                                                        $('#num_bank').val(add_tab1_kyc_count);
                                                        if (add_tab1_kyc_count == 3) {
                                                          $('#add_tab1_kyc').hide();
                                                        }
                                                        else {
                                                          $('#add_tab1_kyc').show();
                                                        }
                                                        if (add_tab1_kyc_count == 1) {
                                                          $('#rem_tab1_kyc').hide();
                                                        }
                                                        else {
                                                          $('#rem_tab1_kyc').show();
                                                        }
                                                      });
                                                      //---------Company - CIBIL Report----------//
                                                      var temp = '{{$cibilreport_file}}';
                                                      temp = getFileName(temp);
                                                      $('#cibilreport_file').next().children().first().val(temp);
                                                      //-----Company - KYC Details------------//
                                                      var temp = '{{$pancard_file}}';
                                                      temp = getFileName(temp);
                                                      $('#pancard_file').next().children().first().val(temp);
                                                      if($('#pancard_file').next().children().first().val() !=''){
                                                        $('#pan_card_check1').val(1);
                                                      }else{
                                                        $('#pan_card_check1').val(0);
                                                      }
                                                      var temp = '{{$vatregistration_file}}';
                                                      temp = getFileName(temp);
                                                      $('#vatregistration_file').next().children().first().val(temp);

                                                      var temp = '{{$shopestablish_file_path}}';
                                                      temp = getFileName(temp);
                                                      $('#shopestablish_file_path').next().children().first().val(temp);

                                                      var temp = '{{$gurav}}';
                                                      temp = getFileName(temp);
                                                      $('#gurav').next().children().first().val(temp);

                                                      var temp = '{{$addressproof_company_file}}';
                                                      temp = getFileName(temp);
                                                      $('#addressproof_company_file').next().children().first().val(temp);
                                                      if($('#addressproof_company_file').next().children().first().val() !=''){
                                                        $('#addressproof_company_file_check').val(1);
                                                      }else{
                                                        $('#addressproof_company_file_check').val(0);
                                                      }
                                                      var temp = '{{$optional_file1}}';
                                                      temp = getFileName(temp);
                                                      $('#optional_file1').next().children().first().val(temp);
                                                      if($('#optional_file1').next().children().first().val()!=''){
                                                        $('#optional_file1_check').val(1);
                                                      }else{
                                                        $('#optional_file1_check').val(0);
                                                      }
                                                      var temp = '{{$optional_file2}}';
                                                      temp = getFileName(temp);
                                                      $('#optional_file2').next().children().first().val(temp);

                                                      var temp = '{{$optional_file2}}';
                                                      temp = getFileName(temp);
                                                      $('#optional_file2').next().children().first().val(temp);
                                                      //--------Promoter Kyc - Bank Statement-------//
                                                      var temp = '{{$bankstatement_file}}';
                                                      temp = getFileName(temp);
                                                      $('#bankstatement_file').next().children().first().val(temp);
                                                      //-----Promoter Kyc - Financials ----//
                                                      var temp = '{{$promoternetworth_file}}';
                                                      temp = getFileName(temp);
                                                      $('#promoternetworth_file').next().children().first().val(temp);
                                                      if($('#promoternetworth_file').next().children().first().val()!=''){
                                                        $('#networth_file_check').val(1);
                                                      }else{
                                                        $('#networth_file_check').val(0);
                                                      }
                                                      var temp = '{{$promoter_cibilreport_file}}';
                                                      temp = getFileName(temp);
                                                      $('#promoter_cibilreport_file').next().children().first().val(temp);
                                                      //--------Promoter Kyc - KYC Details--------//
                                                      var temp = '{{$promoter_proof_address_file}}';
                                                      temp = getFileName(temp);
                                                      $('#promoter_proof_address_file').next().children().first().val(temp);
                                                      if($('#promoter_proof_address_file').next().children().first().val() != ''){
                                                        $('#prom_kyc_addproof_file_path_check').val(1);
                                                        $('#lnkLoanDtls2').removeClass('disabled');
                                                      }else{
                                                        $('#prom_kyc_addproof_file_path_check').val(0);
                                                      }
                                                      var temp = '{{$visitingcard_file}}';
                                                      temp = getFileName(temp);
                                                      $('#visitingcard_file').next().children().first().val(temp);
                                                      if($('#visitingcard_file').next().children().first().val() !=''){
                                                        $('#visitingcard_file_check').val(1);
                                                      }else{
                                                        $('#visitingcard_file_check').val(0);
                                                      }
                                                      var temp = '{{$pan_promoter_file}}';
                                                      temp = getFileName(temp);
                                                      $('#pan_promoter_file').next().children().first().val(temp);
                                                      if($('#pan_promoter_file').next().children().first().val() !=''){
                                                        $('#pan_promoter_file_check').val(1);
                                                        $('#lnkLoanDtls3').removeClass('disabled');
                                                      }else{
                                                        $('#pan_promoter_file_check').val(0);
                                                      }
                                                      var temp = '{{$identity_proof_file}}';
                                                      temp = getFileName(temp);
                                                      $('#identityproof_file').next().children().first().val(temp);
                                                      if($('#identityproof_file').next().children().first().val() !=''){
                                                        $('#identity_proof_file_check').val(1);
                                                      }else{
                                                        $('#identity_proof_file_check').val(0);
                                                      }
                                                      //---------Business/Contracts------------//
                                                      var temp = '{{$corporate_file}}';
                                                      temp = getFileName(temp);
                                                      $('#corporate_file').next().children().first().val(temp);
                                                      var temp = '{{$ecommercesupply_file}}';
                                                      temp = getFileName(temp);
                                                      $('#ecommercesupply_file').next().children().first().val(temp);
                                                      //=============================================================//
                                                      var existing_equipmentbillcopy = {{count($equipmentPurchaseCopy)}};
                                                      var jArray = <?php echo json_encode($equipmentPurchaseCopy ); ?>;
                                                      for(var j=1; j <= existing_equipmentbillcopy; j++){
                                                        $('#EquipCopy_' + j).collapse('show');
                                                        jArray['business_invoice_equi'+ j +'_file_path'] = getFileName(jArray['business_invoice_equi'+ j +'_file_path']);
                                                        $('#equipementcopy_file_' + j).next().children().first().val(jArray['business_invoice_equi'+ j +'_file_path']);
                                                        if($('#equipementcopy_file_check_'+j).val()!=''){
                                                          $('#equipementcopy_file_check_'+j).val(1);
                                                          $('#lnkLoanDtls3').removeClass('disabled');
                                                        }
                                                        $('#equipementcopy_file_check_'+j).val(1);
                                                        add_equipmentbillcopy_count = j;
                                                        if(j==2){
                                                          $('#rem_equipmentbillcopy').show();
                                                        }
                                                        if(j==3){
                                                          $('#add_equipmentbillcopy').hide();
                                                        }
                                                      }
                                                      $('#add_equipmentbillcopy').click(function () {
                                                        add_equipmentbillcopy_count = add_equipmentbillcopy_count + 1;
                                                        $('#num_equi_purchase').val(add_equipmentbillcopy_count);
                                                        $('#EquipCopy_' + add_equipmentbillcopy_count).collapse('show');
                                                        if (add_equipmentbillcopy_count == 3) {
                                                          $('#add_equipmentbillcopy').hide();
                                                        }
                                                        else {
                                                          $('#add_equipmentbillcopy').show();
                                                        }
                                                        if (add_equipmentbillcopy_count == 1) {
                                                          $('#rem_equipmentbillcopy').hide();
                                                        }
                                                        else {
                                                          $('#rem_equipmentbillcopy').show();
                                                        }
                                                      });
                                                      $('#rem_equipmentbillcopy').click(function () {
                                                        $('#EquipCopy_' + add_equipmentbillcopy_count).collapse('hide');
                                                        add_equipmentbillcopy_count = add_equipmentbillcopy_count - 1;
                                                        $('#num_equi_purchase').val(add_equipmentbillcopy_count);
                                                        if (add_equipmentbillcopy_count == 3) {
                                                          $('#add_equipmentbillcopy').hide();
                                                        }
                                                        else {
                                                          $('#add_equipmentbillcopy').show();
                                                        }
                                                        if (add_equipmentbillcopy_count == 1) {
                                                          $('#rem_equipmentbillcopy').hide();
                                                        }
                                                        else {
                                                          $('#rem_equipmentbillcopy').show();
                                                        }
                                                      });
                                                      //==========================================//
                                                      var existingInvoiceCopy = {{count($invoiceCopy)}};
                                                      var jArray = <?php echo json_encode($invoiceCopy ); ?>;
                                                      console.log();
                                                      for(k = 1; k <= existingInvoiceCopy;k++){
                                                        $('#InvCopy_' + k).collapse('show');
                                                        jArray['business_invoice_bill'+ k +'_file_path'] = getFileName(jArray['business_invoice_bill'+ k +'_file_path']);
                                                        $('#invoicecopy_file_' + k).next().children().first().val(jArray['business_invoice_bill'+ k +'_file_path']);
                                                        if($('#invoicecopy_file_' + k).next().children().first().val()!=''){
                                                          $('#invoicecopy_file_check_' + k).val(1);
                                                          $('#lnkLoanDtls3').removeClass('disabled');
                                                        }
                                                        add_invoicecopy_count = k;
                                                        if(k==2){
                                                          $('#rem_invoicecopy').show();
                                                        }
                                                        if(k==5){
                                                          $('#add_invoicecopy').hide();
                                                        }
                                                      }
                                                      $('#add_invoicecopy').click(function () {
                                                        add_invoicecopy_count = add_invoicecopy_count + 1;
                                                        $('#num_invoice_detail').val(add_invoicecopy_count);
                                                        $('#InvCopy_' + add_invoicecopy_count).collapse('show');
                                                        if (add_invoicecopy_count == 5) {
                                                          $('#add_invoicecopy').hide();
                                                        }
                                                        else {
                                                          $('#add_invoicecopy').show();
                                                        }
                                                        if (add_invoicecopy_count == 1) {
                                                          $('#rem_invoicecopy').hide();
                                                        }
                                                        else {
                                                          $('#rem_invoicecopy').show();
                                                        }
                                                      });
                                                      $('#rem_invoicecopy').click(function () {
                                                        $('#InvCopy_' + add_invoicecopy_count).collapse("hide");
                                                        add_invoicecopy_count = add_invoicecopy_count - 1;
                                                        $('#num_invoice_detail').val(add_invoicecopy_count);
                                                        if (add_invoicecopy_count == 5) {
                                                          $('#add_invoicecopy').hide();
                                                        }
                                                        else {
                                                          $('#add_invoicecopy').show();
                                                        }
                                                        if (add_invoicecopy_count == 1) {
                                                          $('#rem_invoicecopy').hide();
                                                        }
                                                        else {
                                                          $('#rem_invoicecopy').show();
                                                        }
                                                      });
                                                      //==========================================//
                                                      var existingSecurityFiles = {{$existingSecurityFiles}};
                                                      var jArray1 = <?php echo json_encode($lastValuation ); ?>;
                                                      var jArray2 = <?php echo json_encode($titleSearch ); ?>;
                                                      var jArray3 = <?php echo json_encode($propertyTax ); ?>;
                                                      var jArray4 = <?php echo json_encode($occupation ); ?>;
                                                      var jArray5 = <?php echo json_encode($socityShare ); ?>;
                                                      var jArray6 = <?php echo json_encode($extractFile); ?>;
                                                      var jArray7 = <?php echo json_encode($lastSaledeed ); ?>;
                                                      var jArray8 = <?php echo json_encode($muncipalFile ); ?>;
                                                      var jArray9 = <?php echo json_encode($electricityBill ); ?>;
                                                      for(i=1;i<=existingSecurityFiles;i++) {
                                                        $('#security_doc_' + i).collapse('show');
                                                        add_security_count = i;
                                                        if(jArray1.length) {
                                                          jArray1[i - 1] = getFileName(jArray1[i - 1]);
                                                          $('#security_lastvaluation_file_' + i).next().children().first().val(jArray1[i - 1]);
                                                          if ($('#security_lastvaluation_file_' + i).next().children().first().val() != '') {
                                                            $('#last_pro_val_report_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#last_pro_val_report_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray2.length) {
                                                          jArray2[i - 1] = getFileName(jArray2[i - 1]);
                                                          $('#security_titlesearch_file_' + i).next().children().first().val(jArray2[i - 1]);
                                                          if ($('#security_titlesearch_file_' + i).next().children().first().val() != '') {
                                                            $('#pro_title_search_report_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#pro_title_search_report_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray3.length!=0) {
                                                          jArray3[i - 1] = getFileName(jArray3[i - 1]);
                                                          $('#security_propertytax_file_' + i).next().children().first().val(jArray3[i - 1]);
                                                          if ($('#security_propertytax_file_' + i).next().children().first().val() != '') {
                                                            $('#pro_tax_card_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#pro_tax_card_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray4.length!=0) {
                                                          jArray4[i - 1] = getFileName(jArray4[i - 1]);
                                                          $('#security_occupation_file_' + i).next().children().first().val(jArray4[i - 1]);
                                                          if ($('#security_occupation_file_' + i).next().children().first().val() != '') {
                                                            $('oc_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('oc_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray5.length!=0) {
                                                          jArray5[i - 1] = getFileName(jArray5[i - 1]);
                                                          $('#security_societyshare_file_' + i).next().children().first().val(jArray5[i - 1]);
                                                          if ($('#security_societyshare_file_' + i).next().children().first().val() != '') {
                                                            $('#society_share_cert_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#society_share_cert_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray6.length!=0) {
                                                          jArray6[i - 1] = getFileName(jArray6[i - 1]);
                                                          $('#security_712extract_file_' + i).next().children().first().val(jArray6[i - 1]);
                                                          if ($('#security_712extract_file_' + i).next().children().first().val() != '') {
                                                            $('#copy_7_12_extract_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#copy_7_12_extract_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray7.length!=0) {
                                                          jArray7[i - 1] = getFileName(jArray7[i - 1]);
                                                          $('#security_lastsaledeed_file_' + i).next().children().first().val(jArray7[i - 1]);
                                                          if ($('#security_lastsaledeed_file_' + i).next().children().first().val() != '') {
                                                            $('#copy_last_sales_pur_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#copy_last_sales_pur_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray8.length!=0) {
                                                          jArray8[i - 1] = getFileName(jArray8[i - 1]);
                                                          $('#muncipal_plan_' + i).next().children().first().val(jArray8[i - 1]);
                                                          if ($('#muncipal_plan_' + i).next().children().first().val() != '') {
                                                            $('#municipal_plan_count_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#municipal_plan_count_' + i).val(0);
                                                          }
                                                        }
                                                        if(jArray9.length!=0) {
                                                          jArray9[i - 1] = getFileName(jArray9[i - 1]);
                                                          $('#electricity_bill_' + i).next().children().first().val(jArray9[i - 1]);
                                                          if ($('#electricity_bill_' + i).next().children().first().val() != '') {
                                                            $('#electricity_bill_count_' + i).val(1);
                                                            $('#lnkLoanDtls4').removeClass('disabled');
                                                          } else {
                                                            $('#electricity_bill_count_' + i).val(0);
                                                          }
                                                        }
                                                        if(i==3) {
                                                          $('#add_security').hide();
                                                        }
                                                        if(i==2){
                                                          $('#rem_security').show();
                                                        }
                                                        $('#num_security_doc').val(i);
                                                      }
                                                      var a = $('#num_security_doc').val();
                                                      for(i=2;i<=a;i++){
                                                        $('#security_doc_' + i).collapse('show');
                                                        if(i==3){
                                                          $('#add_security').hide();
                                                        }
                                                        if(i==2){
                                                          $('#rem_security').show();
                                                        }
                                                        add_security_count = i;
                                                      }
                                                      $('#add_security').click(function () {
                                                        add_security_count = add_security_count + 1;
                                                        $('#num_security_doc').val(add_security_count);
                                                        $('#security_doc_' + add_security_count).collapse('show');
                                                        if (add_security_count == 3) {
                                                          $('#add_security').hide();
                                                        }
                                                        else {
                                                          $('#add_security').show();
                                                        }
                                                        if (add_security_count == 1) {
                                                          $('#rem_security').hide();
                                                        }
                                                        else {
                                                          $('#rem_security').show();
                                                        }
                                                      });
                                                      $('#rem_security').click(function () {
                                                        $('#security_doc_' + add_security_count).collapse('hide');
                                                        add_security_count = add_security_count - 1;
                                                        $('#num_security_doc').val(add_security_count);
                                                        if (add_security_count == 3) {
                                                          $('#add_security').hide();
                                                        }
                                                        else {
                                                          $('#add_security').show();
                                                        }
                                                        if (add_security_count == 1) {
                                                          $('#rem_security').hide();
                                                        }
                                                        else {
                                                          $('#rem_security').show();
                                                        }
                                                      });
                                                      //====================================================================//
                                                      $(lnkLoanDtls4).click(function () {
                                                        $('#li_sub1').removeClass("active");
                                                        $('#li_sub2').removeClass("active");
                                                        $('#li_sub3').removeClass("active");
                                                        $('#li_sub4').removeClass("active");
                                                        $('#divTab_sub4').show();
                                                        $('#divTab_sub1').hide();
                                                        $('#divTab_sub2').hide();
                                                        $('#divTab_sub3').hide();
                                                        $('#li_sub4').addClass("active");
                                                      });
                                                      $('#promoter_proof_address').select2({
                                                        allowClear: true,
                                                        placeholder: "Select Address Type"
                                                      });
                                                      $('#promoter_identity_proof').select2({
                                                        allowClear: true,
                                                        placeholder: "Select Identity Proof"
                                                      });
                                                      /*if(shareIfExist!=undefined){
                                                      $('#lnkLoanDtls3').addClass('disabled');
                                                    } */
                                                  });
function getFileName(value){
  var res = value.split("/");
  var newRes = res[(res.length)-1];
  var newRes = newRes.split("?");
  return newRes[(newRes.length)-2];
}
</script>
