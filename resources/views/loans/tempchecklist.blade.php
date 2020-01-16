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
@if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged, array('id' => 'companySharePledged')) !!}
@endif
@if(isset($displayNoneSecurity))
{!! Form::hidden('displayNoneSecurity', $displayNoneSecurity, array('id' => 'displayNoneSecurity')) !!}
@endif
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

{{--             <div class="tab-content">
              <div class="tab-pane active" id="CompanyBackground">
                <div class="row">
                    <div class="span9">
                      <!-- Start Kyc Details Of company--> 
                     <div class="tab-pane active" id="CompanyBackground" style="">
                          {!! Form::hidden('id',null) !!}
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group"> --}}

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
    <tr>
    <td>{!! Form::label('moa','MOA', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_applicable1','yes'  ,@$loanadminchecklist->moa_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_applicable1','no' ,@$loanadminchecklist->moa_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_document1','yes'  ,@$loanadminchecklist->moa_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_document1','no' ,@$loanadminchecklist->moa_document1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_document1_no']) !!}
             No
           </label>

        </td>

           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_discrepancies1','yes'  ,@$loanadminchecklist->moa_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_discrepancies1','no' ,@$loanadminchecklist->moa_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_discrepancies1_no']) !!}
             No
           </label>


        {!! Form::textarea('moa_remark1',@$loanadminchecklist->moa_remark1 == 'no' , array('class' => 'form-control','id'=>'moa_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
    
        </td>

   {{--         <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('moa_attachment1','yes'  ,@$loanadminchecklist->moa_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'moa_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('moa_attachment1','no' ,@$loanadminchecklist->moa_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'moa_attachment1_no']) !!}
             No
           </label>
        </td> --}}
      </tr>
      <tr>

        <td>{!! Form::label('pan','PAN', ['class'=>'form-label']) !!}</td>
            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_applicable1','yes'  ,@$loanadminchecklist->pan_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_applicable1','no' ,@$loanadminchecklist->pan_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_document1','yes'  ,@$loanadminchecklist->pan_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_document1','no' ,@$loanadminchecklist->pan_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_discrepancies1','yes'  ,@$loanadminchecklist->pan_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_discrepancies1','no' ,@$loanadminchecklist->pan_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('pan_remark1',@$loanadminchecklist->pan_remark1 == 'no' , array('class' => 'form-control','id'=>'pan_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan_attachment1','yes'  ,@$loanadminchecklist->pan_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan_attachment1','no' ,@$loanadminchecklist->pan_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'pan_attachment1_no']) !!}
             No
           </label>
        </td>
 --}}
   </tr>

         <tr>

        <td>{!! Form::label('cor','COR', ['class'=>'form-label']) !!}</td>
            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_applicable1','yes'  ,@$loanadminchecklist->cor_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_applicable1','no' ,@$loanadminchecklist->cor_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_document1','yes'  ,@$loanadminchecklist->cor_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_document1','no' ,@$loanadminchecklist->cor_document1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_discrepancies1','yes'  ,@$loanadminchecklist->cor_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_discrepancies1','no' ,@$loanadminchecklist->cor_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('cor_remark1',@$loanadminchecklist->cor_remark1 == 'no' , array('class' => 'form-control','id'=>'cor_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

  {{--          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cor_attachment1','yes'  ,@$loanadminchecklist->cor_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'cor_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cor_attachment1','no' ,@$loanadminchecklist->cor_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'cor_attachment1_no']) !!}
             No
           </label>
        </td> --}}
   </tr>
<tr>
  <td>{!! Form::label('shopcertificate','SHOP CERTIFICATE', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_applicable1','yes'  ,@$loanadminchecklist->shopcertificate_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_applicable1','no' ,@$loanadminchecklist->shopcertificate_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_document1','yes'  ,@$loanadminchecklist->shopcertificate_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_document1','no' ,@$loanadminchecklist->shopcertificate_document1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_document1_no']) !!}
             No
           </label>

        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_discrepancies1','yes'  ,@$loanadminchecklist->shopcertificate_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_discrepancies1','no' ,@$loanadminchecklist->shopcertificate_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('shopcertificate_remark1',@$loanadminchecklist->shopcertificate_remark1 == 'no' , array('class' => 'form-control','id'=>'shopcertificate_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>
{{-- 
           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('shopcertificate_attachment1','yes'  ,@$loanadminchecklist->shopcertificate_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'shopcertificate_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('shopcertificate_attachment1','no' ,@$loanadminchecklist->shopcertificate_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'shopcertificate_attachment1_no']) !!}
             No
           </label>
        </td> --}}


</tr>

<tr>
  <td>{!! Form::label('gstcertificate','GST CERTIFICATE', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('gstcertificate_applicable1','yes'  ,@$loanadminchecklist->gstcertificate_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'gstcertificate_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('gstcertificate_applicable1','no' ,@$loanadminchecklist->gstcertificate_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'gstcertificate_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('gstcertificate_document1','yes'  ,@$loanadminchecklist->gstcertificate_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'gstcertificate_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('gstcertificate_document1','no' ,@$loanadminchecklist->gstcertificate_document1 == 'no' ? 'checked' : '' ,  ['id' => 'gstcertificate_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('gstcertificate_discrepancies1','yes'  ,@$loanadminchecklist->gstcertificate_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'gstcertificate_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('gstcertificate_discrepancies1','no' ,@$loanadminchecklist->gstcertificate_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'gstcertificate_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('gstcertificate_remark1',@$loanadminchecklist->gstcertificate_remark1 == 'no' , array('class' => 'form-control','id'=>'gstcertificate_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>


</tr>


<tr>
  <td>{!! Form::label('ghumastalicence','GHUMASTA LICENCE', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_applicable1','yes'  ,@$loanadminchecklist->ghumastalicence_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_applicable1','no' ,@$loanadminchecklist->ghumastalicence_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_document1','yes'  ,@$loanadminchecklist->ghumastalicence_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_document1','no' ,@$loanadminchecklist->ghumastalicence_document1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_discrepancies1','yes'  ,@$loanadminchecklist->ghumastalicence_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_discrepancies1','no' ,@$loanadminchecklist->ghumastalicence_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('ghumastalicence_remark1',@$loanadminchecklist->ghumastalicence_remark1 == 'no' , array('class' => 'form-control','id'=>'ghumastalicence_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

 {{--           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('ghumastalicence_attachment1','yes'  ,@$loanadminchecklist->ghumastalicence_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'ghumastalicence_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('ghumastalicence_attachment1','no' ,@$loanadminchecklist->ghumastalicence_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'ghumastalicence_attachment1_no']) !!}
             No
           </label>
        </td>
 --}}
</tr>

<tr>
  <td>{!! Form::label('rentagreement','RENT AGREEMENT', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_applicable1','yes'  ,@$loanadminchecklist->rentagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_applicable1','no' ,@$loanadminchecklist->rentagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_document1','yes'  ,@$loanadminchecklist->rentagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_document1','no' ,@$loanadminchecklist->rentagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_discrepancies1','yes'  ,@$loanadminchecklist->rentagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_discrepancies1','no' ,@$loanadminchecklist->rentagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('rentagreement_remark1',@$loanadminchecklist->rentagreement_remark1 == 'no' , array('class' => 'form-control','id'=>'rentagreement_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}

        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('rentagreement_attachment1','yes'  ,@$loanadminchecklist->rentagreement_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'rentagreement_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('rentagreement_attachment1','no' ,@$loanadminchecklist->rentagreement_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'rentagreement_attachment1_no']) !!}
             No
           </label>
        </td> --}}

</tr>

<tr>
  <td>{!! Form::label('udyogadhar','UDYOG AADHAR', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_applicable1','yes'  ,@$loanadminchecklist->udyogadhar_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_applicable1','no' ,@$loanadminchecklist->udyogadhar_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_document1','yes'  ,@$loanadminchecklist->udyogadhar_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_document1','no' ,@$loanadminchecklist->udyogadhar_document1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_discrepancies1','yes'  ,@$loanadminchecklist->udyogadhar_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_discrepancies1','no' ,@$loanadminchecklist->udyogadhar_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('udyogadhar_remark1',@$loanadminchecklist->udyogadhar_remark1 == 'no' , array('class' => 'form-control','id'=>'udyogadhar_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('udyogadhar_attachment1','yes'  ,@$loanadminchecklist->udyogadhar_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'udyogadhar_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('udyogadhar_attachment1','no' ,@$loanadminchecklist->udyogadhar_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'udyogadhar_attachment1_no']) !!}
             No
           </label>
        </td> --}}

</tr>

<tr>
  <td>{!! Form::label('electricitybill','ELECTRICITY BILL', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_applicable1','yes'  ,@$loanadminchecklist->electricitybill_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_applicable1','no' ,@$loanadminchecklist->electricitybill_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_document1','yes'  ,@$loanadminchecklist->electricitybill_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_document1','no' ,@$loanadminchecklist->electricitybill_document1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_discrepancies1','yes'  ,@$loanadminchecklist->electricitybill_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_discrepancies1','no' ,@$loanadminchecklist->electricitybill_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('electricitybill_remark1',@$loanadminchecklist->electricitybill_remark1 == 'no' , array('class' => 'form-control','id'=>'electricitybill_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('electricitybill_attachment1','yes'  ,@$loanadminchecklist->electricitybill_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'electricitybill_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('electricitybill_attachment1','no' ,@$loanadminchecklist->electricitybill_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'electricitybill_attachment1_no']) !!}
             No
           </label>
        </td>
 --}}

</tr>

<tr>
  <td>{!! Form::label('cibilofentity','CIBIL OF ENTITY', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_applicable1','yes'  ,@$loanadminchecklist->cibilofentity_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_applicable1','no' ,@$loanadminchecklist->cibilofentity_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_document1','yes'  ,@$loanadminchecklist->cibilofentity_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_document1','no' ,@$loanadminchecklist->cibilofentity_document1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_discrepancies1','yes'  ,@$loanadminchecklist->cibilofentity_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_discrepancies1','no' ,@$loanadminchecklist->cibilofentity_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('cibilofentity_remark1',@$loanadminchecklist->cibilofentity_remark1 == 'no' , array('class' => 'form-control','id'=>'cibilofentity_remark1', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}


  
        </td>
{{-- 
           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofentity_attachment1','yes'  ,@$loanadminchecklist->cibilofentity_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofentity_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofentity_attachment1','no' ,@$loanadminchecklist->cibilofentity_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofentity_attachment1_no']) !!}
             No
           </label>
        </td> --}}

</tr>

<tr>
  <td>{!! Form::label('other1','OTHER', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other1_applicable1','yes'  ,@$loanadminchecklist->other1_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other1_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other1_applicable1','no' ,@$loanadminchecklist->other1_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other1_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other1_document1','yes'  ,@$loanadminchecklist->other1_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other1_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other1_document1','no' ,@$loanadminchecklist->other1_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other1_document1_no']) !!}
             No
           </label>
        </td>




   <td colspan="2">
        {!! Form::textarea('other1_remarks',@$loanadminchecklist->other1_remarks == 'no' , array('class' => 'form-control','id'=>'other1_remarks', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
    </td>

</tr>
                 

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
<!-- End Kyc Details Of company-->  
                    </div>
                </div>

      {{--           <div class="row">
          <div class="col-md-12" style="margin-left:20px;">
            <div id="currentSection">

             <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
             <a href="{{ URL::previous() }}" class="btn btn-default">Next</a>

             <button class="btn btn-info" type="submit">Submit</button>
           </div>
         </div>
       </div> --}}

       <div class="center-align" style="margin:0px 25px;"></div>

<div class="row">
  <div class="col-md-12" style="margin-left:20px;">
    <div id="currentSection">
      {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
   @if($user->isSME() || $user->isCA() || $user->isAnalyst() || $user->isLoanAdmin())
        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
        @else
        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;','disabled=disabled' )) !!}
        @endif
      @if($user->isSME() || $user->isBankUser())
      {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
      @endif
      {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
    </div>
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
              {!! Form::checkbox('pan2_applicable1','yes'  ,@$loanadminchecklist->pan2_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_applicable1','no' ,@$loanadminchecklist->pan2_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan2_document1','yes'  ,@$loanadminchecklist->pan2_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_document1','no' ,@$loanadminchecklist->pan2_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan2_discrepancies1','yes'  ,@$loanadminchecklist->pan2_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_discrepancies1','no' ,@$loanadminchecklist->pan2_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('pan2_remark2',@$loanadminchecklist->pan2_remark2 == 'no' , array('class' => 'form-control','id'=>'pan2_remark2', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

   {{--         <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pan2_attachment1','yes'  ,@$loanadminchecklist->pan2_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'pan2_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pan2_attachment1','no' ,@$loanadminchecklist->pan2_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'pan2_attachment1_no']) !!}
             No
           </label>
        </td> --}}
                    
    </tr>

    <tr>
      <td>{!! Form::label('addressproof','Address Proof', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_applicable1','yes'  ,@$loanadminchecklist->addressproof_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_applicable1','no' ,@$loanadminchecklist->addressproof_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_document1','yes'  ,@$loanadminchecklist->addressproof_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_document1','no' ,@$loanadminchecklist->addressproof_document1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_discrepancies1','yes'  ,@$loanadminchecklist->addressproof_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_discrepancies1','no' ,@$loanadminchecklist->addressproof_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('addressproof_remark2',@$loanadminchecklist->addressproof_remark2 == 'no' , array('class' => 'form-control','id'=>'addressproof_remark2', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}


        </td>
{{-- 
           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('addressproof_attachment1','yes'  ,@$loanadminchecklist->addressproof_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('addressproof_attachment1','no' ,@$loanadminchecklist->addressproof_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'addressproof_attachment1_no']) !!}
             No
           </label>
        </td>
       --}}

      
    </tr>

     <tr>
      <td>{!! Form::label('networthcertificate','Networth Certificate', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_applicable1','yes'  ,@$loanadminchecklist->networthcertificate_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_applicable1','no' ,@$loanadminchecklist->networthcertificate_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_document1','yes'  ,@$loanadminchecklist->networthcertificate_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_document1','no' ,@$loanadminchecklist->networthcertificate_document1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_discrepancies1','yes'  ,@$loanadminchecklist->networthcertificate_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_discrepancies1','no' ,@$loanadminchecklist->networthcertificate_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('networthcertificate_remark2',@$loanadminchecklist->networthcertificate_remark2 == 'no' , array('class' => 'form-control','id'=>'networthcertificate_remark2', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}


        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('networthcertificate_attachment1','yes'  ,@$loanadminchecklist->networthcertificate_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'networthcertificate_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('networthcertificate_attachment1','no' ,@$loanadminchecklist->networthcertificate_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'networthcertificate_attachment1_no']) !!}
             No
           </label>
        </td> --}}
      
      
    </tr>

     <tr>
      <td>{!! Form::label('cibilofpromoter','CIBIL Of Promoter', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_applicable1','yes'  ,@$loanadminchecklist->cibilofpromoter_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_applicable1','no' ,@$loanadminchecklist->cibilofpromoter_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_document1','yes'  ,@$loanadminchecklist->cibilofpromoter_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_document1','no' ,@$loanadminchecklist->cibilofpromoter_document1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_discrepancies1','yes'  ,@$loanadminchecklist->cibilofpromoter_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_discrepancies1','no' ,@$loanadminchecklist->cibilofpromoter_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('cibilofpromoter_remark2',@$loanadminchecklist->cibilofpromoter_remark2 == 'no' , array('class' => 'form-control','id'=>'cibilofpromoter_remark2', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}



        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('cibilofpromoter_attachment1','yes'  ,@$loanadminchecklist->cibilofpromoter_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('cibilofpromoter_attachment1','no' ,@$loanadminchecklist->cibilofpromoter_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'cibilofpromoter_attachment1_no']) !!}
             No
           </label>
        </td> --}}
      
      
    </tr>

     <tr>
      <td>{!! Form::label('other2','Others', ['class'=>'form-label']) !!}</td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other2_applicable1','yes'  ,@$loanadminchecklist->other2_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other2_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other2_applicable1','no' ,@$loanadminchecklist->other2_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other2_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other2_document1','yes'  ,@$loanadminchecklist->other2_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other2_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other2_document1','no' ,@$loanadminchecklist->other2_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other2_document1_no']) !!}
             No
           </label>
        </td>

 


   <td colspan="2">
        {!! Form::textarea('other2_remarks',@$loanadminchecklist->other2_remarks == 'no' , array('class' => 'form-control','id'=>'other2_remarks', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
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
                <div class="row">
          <div class="col-md-12" style="margin-left:20px;">
            <div id="currentSection">

             <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
             <a href="{{ URL::previous() }}" class="btn btn-default">Next</a>
           </div>
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
              {!! Form::checkbox('acceptedtermsheet_applicable1','yes'  ,@$loanadminchecklist->acceptedtermsheet_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_applicable1','no' ,@$loanadminchecklist->acceptedtermsheet_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('acceptedtermsheet_document1','yes'  ,@$loanadminchecklist->acceptedtermsheet_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_document1','no' ,@$loanadminchecklist->acceptedtermsheet_document1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('acceptedtermsheet_discrepancies1','yes'  ,@$loanadminchecklist->acceptedtermsheet_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_discrepancies1','no' ,@$loanadminchecklist->acceptedtermsheet_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('acceptedtermsheet_remark3',@$loanadminchecklist->acceptedtermsheet_remark3 == 'no' , array('class' => 'form-control','id'=>'acceptedtermsheet_remark3', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

   {{--         <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('acceptedtermsheet_attachment1','yes'  ,@$loanadminchecklist->acceptedtermsheet_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('acceptedtermsheet_attachment1','no' ,@$loanadminchecklist->acceptedtermsheet_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet_attachment1_no']) !!}
             No
           </label>
        </td> --}}
    </tr>

    <tr>
      <td>{!! Form::label('loanagreement','Loan Agreement', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_applicable1','yes'  ,@$loanadminchecklist->loanagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_applicable1','no' ,@$loanadminchecklist->loanagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_document1','yes'  ,@$loanadminchecklist->loanagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_document1','no' ,@$loanadminchecklist->loanagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_discrepancies1','yes'  ,@$loanadminchecklist->loanagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_discrepancies1','no' ,@$loanadminchecklist->loanagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_discrepancies1_no']) !!}
             No
           </label>

             {!! Form::textarea('loanagreement_remark3',@$loanadminchecklist->loanagreement_remark3 == 'no' , array('class' => 'form-control','id'=>'loanagreement_remark3', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

 {{--           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('loanagreement_attachment1','yes'  ,@$loanadminchecklist->loanagreement_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('loanagreement_attachment1','no' ,@$loanadminchecklist->loanagreement_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement_attachment1_no']) !!}
             No
           </label>
        </td> --}}
    </tr>

    
    <tr>
      <td>{!! Form::label('personalguarantee','Personal Guarantee', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_applicable1','yes'  ,@$loanadminchecklist->personalguarantee_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_applicable1','no' ,@$loanadminchecklist->personalguarantee_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_document1','yes'  ,@$loanadminchecklist->personalguarantee_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_document1','no' ,@$loanadminchecklist->personalguarantee_document1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_document1_no']) !!}
             No
           </label>
        </td>


           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_discrepancies1','yes'  ,@$loanadminchecklist->personalguarantee_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_discrepancies1','no' ,@$loanadminchecklist->personalguarantee_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_discrepancies1_no']) !!}
             No
           </label>

           {!! Form::textarea('personalguarantee_remark3',@$loanadminchecklist->personalguarantee_remark3 == 'no' , array('class' => 'form-control','id'=>'personalguarantee_remark3', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('personalguarantee_attachment1','yes'  ,@$loanadminchecklist->personalguarantee_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('personalguarantee_attachment1','no' ,@$loanadminchecklist->personalguarantee_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee_attachment1_no']) !!}
             No
           </label>
        </td> --}}
    </tr>

    
    <tr>
      <td>{!! Form::label('signatureverification','Signature Verification', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_applicable1','yes'  ,@$loanadminchecklist->signatureverification_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_applicable1','no' ,@$loanadminchecklist->signatureverification_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_document1','yes'  ,@$loanadminchecklist->signatureverification_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_document1','no' ,@$loanadminchecklist->signatureverification_document1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_discrepancies1','yes'  ,@$loanadminchecklist->signatureverification_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_discrepancies1','no' ,@$loanadminchecklist->signatureverification_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_discrepancies1_no']) !!}
             No
           </label>
            {!! Form::textarea('signatureverification_remark3',@$loanadminchecklist->signatureverification_remark3 == 'no' , array('class' => 'form-control','id'=>'signatureverification_remark3', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('signatureverification_attachment1','yes'  ,@$loanadminchecklist->signatureverification_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'signatureverification_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('signatureverification_attachment1','no' ,@$loanadminchecklist->signatureverification_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'signatureverification_attachment1_no']) !!}
             No
           </label>
        </td> --}}
    </tr>


    <tr>
        <td>{!! Form::label('dpn','DPN', ['class'=>'form-label']) !!}</td>
        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_applicable1','yes'  ,@$loanadminchecklist->dpn_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_applicable1','no' ,@$loanadminchecklist->dpn_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_document1','yes'  ,@$loanadminchecklist->dpn_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_document1','no' ,@$loanadminchecklist->dpn_document1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_document1_no']) !!}
             No
           </label>
        </td>

 

           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_discrepancies1','yes'  ,@$loanadminchecklist->dpn_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_discrepancies1','no' ,@$loanadminchecklist->dpn_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_discrepancies1_no']) !!}
             No
           </label>

           {!! Form::textarea('dpn_remark3',@$loanadminchecklist->dpn_remark3 == 'no' , array('class' => 'form-control','id'=>'dpn_remark3', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('dpn_attachment1','yes'  ,@$loanadminchecklist->dpn_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'dpn_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('dpn_attachment1','no' ,@$loanadminchecklist->dpn_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'dpn_attachment1_no']) !!}
             No
           </label>
        </td> --}}
    </tr>
    <tr>
  <td>{!! Form::label('boardresolve','BOARD RESOLUTION', ['class'=>'form-label']) !!}</td>
          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_applicable1','yes'  ,@$loanadminchecklist->boardresolve_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_applicable1','no' ,@$loanadminchecklist->boardresolve_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_document1','yes'  ,@$loanadminchecklist->boardresolve_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_document1','no' ,@$loanadminchecklist->boardresolve_document1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_discrepancies1','yes'  ,@$loanadminchecklist->boardresolve_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_discrepancies1','no' ,@$loanadminchecklist->boardresolve_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_discrepancies1_no']) !!}
             No
           </label>
             {!! Form::textarea('boardresolve_remark3',@$loanadminchecklist->boardresolve_remark3 == 'no' , array('class' => 'form-control','id'=>'boardresolve_remark3', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}

        </td>

 {{--           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('boardresolve_attachment1','yes'  ,@$loanadminchecklist->boardresolve_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'boardresolve_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('boardresolve_attachment1','no' ,@$loanadminchecklist->boardresolve_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'boardresolve_attachment1_no']) !!}
             No
           </label>
        </td> --}}


</tr>



  <tr>
    <td>{!! Form::label('other3','Others', ['class'=>'form-label']) !!}</td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other3_applicable1','yes'  ,@$loanadminchecklist->other3_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other3_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other3_applicable1','no' ,@$loanadminchecklist->other3_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other3_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other3_document1','yes'  ,@$loanadminchecklist->other3_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other3_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other3_document1','no' ,@$loanadminchecklist->other3_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other3_document1_no']) !!}
             No
           </label>
        </td>




   <td colspan="2">
        {!! Form::textarea('other3_remarks',@$loanadminchecklist->other3_remarks == 'no' , array('class' => 'form-control','id'=>'other3_remarks', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
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
                <div class="row">
          <div class="col-md-12" style="margin-left:20px;">
            <div id="currentSection">

             <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
             <a href="{{ URL::previous() }}" class="btn btn-default">Next</a>
           </div>
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
              {!! Form::checkbox('mortgagedocument_applicable1','yes'  ,@$loanadminchecklist->mortgagedocument_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_applicable1','no' ,@$loanadminchecklist->mortgagedocument_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('mortgagedocument_document1','yes'  ,@$loanadminchecklist->mortgagedocument_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_document1','no' ,@$loanadminchecklist->mortgagedocument_document1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('mortgagedocument_discrepancies1','yes'  ,@$loanadminchecklist->mortgagedocument_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_discrepancies1','no' ,@$loanadminchecklist->mortgagedocument_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_discrepancies1_no']) !!}
             No
           </label>

           {!! Form::textarea('mortgagedocument_remark4',@$loanadminchecklist->mortgagedocument_remark4 == 'no' , array('class' => 'form-control','id'=>'mortgagedocument_remark4', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}

        </td>

  {{--          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('mortgagedocument_attachment1','yes'  ,@$loanadminchecklist->mortgagedocument_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('mortgagedocument_attachment1','no' ,@$loanadminchecklist->mortgagedocument_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument_attachment1_no']) !!}
             No
           </label>
        </td> --}}
  </tr>

   <tr>
      <td>{!! Form::label('hypothicationagreement','Hypothication Agreement', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_applicable1','yes'  ,@$loanadminchecklist->hypothicationagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_applicable1','no' ,@$loanadminchecklist->hypothicationagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_document1','yes'  ,@$loanadminchecklist->hypothicationagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_document1','no' ,@$loanadminchecklist->hypothicationagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_discrepancies1','yes'  ,@$loanadminchecklist->hypothicationagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_discrepancies1','no' ,@$loanadminchecklist->hypothicationagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_discrepancies1_no']) !!}
             No
           </label>
           {!! Form::textarea('hypothicationagreement_remark4',@$loanadminchecklist->hypothicationagreement_remark4 == 'no' , array('class' => 'form-control','id'=>'hypothicationagreement_remark4', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('hypothicationagreement_attachment1','yes'  ,@$loanadminchecklist->hypothicationagreement_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('hypothicationagreement_attachment1','no' ,@$loanadminchecklist->hypothicationagreement_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement_attachment1_no']) !!}
             No
           </label>
        </td>  --}}          
  </tr>

   <tr>
      <td>{!! Form::label('escrowagreement','Escrow Agreement', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_applicable1','yes'  ,@$loanadminchecklist->escrowagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_applicable1','no' ,@$loanadminchecklist->escrowagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_document1','yes'  ,@$loanadminchecklist->escrowagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_document1','no' ,@$loanadminchecklist->escrowagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_document1_no']) !!}
             No
           </label>
        </td>

           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_discrepancies1','yes'  ,@$loanadminchecklist->escrowagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_discrepancies1','no' ,@$loanadminchecklist->escrowagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_discrepancies1_no']) !!}
             No
           </label>
           {!! Form::textarea('escrowagreement_remark4',@$loanadminchecklist->escrowagreement_remark4 == 'no' , array('class' => 'form-control','id'=>'escrowagreement_remark4', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('escrowagreement_attachment1','yes'  ,@$loanadminchecklist->escrowagreement_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('escrowagreement_attachment1','no' ,@$loanadminchecklist->escrowagreement_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement_attachment1_no']) !!}
             No
           </label>
        </td>  --}}                 
  </tr>

   <tr>
      <td>{!! Form::label('nachagreement','NACH Agreement', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_applicable1','yes'  ,@$loanadminchecklist->nachagreement_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_applicable1','no' ,@$loanadminchecklist->nachagreement_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_document1','yes'  ,@$loanadminchecklist->nachagreement_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_document1','no' ,@$loanadminchecklist->nachagreement_document1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_discrepancies1','yes'  ,@$loanadminchecklist->nachagreement_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_discrepancies1','no' ,@$loanadminchecklist->nachagreement_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_discrepancies1_no']) !!}
             No
           </label>
           {!! Form::textarea('nachagreement_remark4',@$loanadminchecklist->nachagreement_remark4 == 'no' , array('class' => 'form-control','id'=>'nachagreement_remark4', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

{{--            <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('nachagreement_attachment1','yes'  ,@$loanadminchecklist->nachagreement_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('nachagreement_attachment1','no' ,@$loanadminchecklist->nachagreement_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement_attachment1_no']) !!}
             No
           </label>
        </td> --}}
  </tr>

   <tr>
      <td>{!! Form::label('pdc','PDCs', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_applicable1','yes'  ,@$loanadminchecklist->pdc_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_applicable1','no' ,@$loanadminchecklist->pdc_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_document1','yes'  ,@$loanadminchecklist->pdc_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_document1','no' ,@$loanadminchecklist->pdc_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_discrepancies1','yes'  ,@$loanadminchecklist->pdc_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_discrepancies1','no' ,@$loanadminchecklist->pdc_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_discrepancies1_no']) !!}
             No
           </label>
           {!! Form::textarea('pdc_remark4',@$loanadminchecklist->pdc_remark4 == 'no' , array('class' => 'form-control','id'=>'pdc_remark4', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

   {{--         <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdc_attachment1','yes'  ,@$loanadminchecklist->pdc_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdc_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdc_attachment1','no' ,@$loanadminchecklist->pdc_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'pdc_attachment1_no']) !!}
             No
           </label>
        </td>  --}}                 
  </tr>

   

   <tr>
      <td>{!! Form::label('pdccoveringletter','PDC Covering Letter', ['class'=>'form-label']) !!}</td>

        <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_applicable1','yes'  ,@$loanadminchecklist->pdccoveringletter_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_applicable1','no' ,@$loanadminchecklist->pdccoveringletter_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_document1','yes'  ,@$loanadminchecklist->pdccoveringletter_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_document1','no' ,@$loanadminchecklist->pdccoveringletter_document1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_document1_no']) !!}
             No
           </label>
        </td>



           <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_discrepancies1','yes'  ,@$loanadminchecklist->pdccoveringletter_discrepancies1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_discrepancies1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_discrepancies1','no' ,@$loanadminchecklist->pdccoveringletter_discrepancies1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_discrepancies1_no']) !!}
             No
           </label>

           {!! Form::textarea('pdccoveringletter_remark4',@$loanadminchecklist->pdccoveringletter_remark4 == 'no' , array('class' => 'form-control','id'=>'pdccoveringletter_remark4', 'placeholder'=>'' ,'data-mandatory'=>'M', 'style' => 'height:30px;')) !!}
        </td>

  {{--          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('pdccoveringletter_attachment1','yes'  ,@$loanadminchecklist->pdccoveringletter_attachment1 == 'yes' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_attachment1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('pdccoveringletter_attachment1','no' ,@$loanadminchecklist->pdccoveringletter_attachment1 == 'no' ? 'checked' : '' ,  ['id' => 'pdccoveringletter_attachment1_no']) !!}
             No
           </label>
        </td>  --}}          
  </tr>

   <tr>
      <td>{!! Form::label('other4','Others', ['class'=>'form-label']) !!}</td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other4_applicable1','yes'  ,@$loanadminchecklist->other4_applicable1 == 'yes' ? 'checked' : '' ,  ['id' => 'other4_applicable1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other4_applicable1','no' ,@$loanadminchecklist->other4_applicable1 == 'no' ? 'checked' : '' ,  ['id' => 'other4_applicable1_no']) !!}
             No
           </label>
        </td>

          <td>
           <label class="checkbox-inline">
              {!! Form::checkbox('other4_document1','yes'  ,@$loanadminchecklist->other4_document1 == 'yes' ? 'checked' : '' ,  ['id' => 'other4_document1_yes']) !!}
              Yes
            </label>

            
            <label class="checkbox-inline">
             {!! Form::checkbox('other4_document1','no' ,@$loanadminchecklist->other4_document1 == 'no' ? 'checked' : '' ,  ['id' => 'other4_document1_no']) !!}
             No
           </label>
        </td>

 


   <td colspan="2">
        {!! Form::textarea('other4_remarks',@$loanadminchecklist->other4_remarks == 'no' , array('class' => 'form-control','id'=>'other4_remarks', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
    </td>
  </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
<!--End Security Documents-->
       <div class="row">
          <div class="col-md-12" style="margin-left:20px;">
            <div id="currentSection">

             <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
             <a href="{{ URL::previous() }}" class="btn btn-default">Next</a>
           </div>
         </div>
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
  @stop