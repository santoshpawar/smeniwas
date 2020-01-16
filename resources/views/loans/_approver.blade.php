<style>
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
  padding: 3px 0px 0px 11px !important;
}
.form-group.is-empty {
  width: 100%;
}
</style>
{{-- {!! isset($companySharePledged) ? "<div class='sharePop text-center'>Please provide information regarding  <strong>".$companySharePledged."</strong> who's share are being pledged</div>":""  !!}
@if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged) !!}
@endif
@if(isset($bscNscCode))
{!! Form::hidden('bscNscCode', $bscNscCode) !!}
@endif --}}
<div class="container-fluid">
 <div class="row">
   <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">proposal Approver <span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
   </div>
   <hr>
   <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div class="tab-pane active" id="CompanyBackground" style="">
            <div class="row" id="divTab_sub1" >
                <div class="tab-pane active" id="" style="padding-left: 20px;padding-right: 20px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="" class="form-group">
                                <div id="topcust" class="panel panel-success">
                                    <div class="panel-heading">Approval Status</div>
                                    <div class="panel-body">
                                        <div class="row" style="padding:5px;">
                                            <div class="col-md-4">
                                                {!! Form::hidden('id',null) !!}
                                                 {!! Form::label('security_yes', 'Approve proposal' ) !!} 
                                                  {!! Form::radio('loan_status','Y'  ,@$loan->praposalApproved == 'Y' ? 'checked' : '' ,  ['id' => 'loan_status_yes']) !!}
                                             <br>
                                              {!! Form::label('security_no', 'Reject proposal') !!} <span style="margin-right:12px "></span>
                                                {!! Form::radio('loan_status', 'N', @$loan->praposalRejected == 'N' ? 'checked' : '',  ['id' => 'loan_status_no']) !!}
                                            </div>

                                            <div class="col-md-8">
                                                {!! Form::label('remark','Your Remarks', ['class'=>'form-label']) !!}
                                                {!! Form::textarea('remark', @$loan->remark , array('class' => 'form-control','id'=>'remark', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:170px;')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-left:20px;">
                        <div id="currentSection">
                            {!! Form::button('Submit <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-success btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => '' )) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        @stop
