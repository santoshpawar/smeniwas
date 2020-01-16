<div class="col-md-10" id="divTab_sub">
    <div class="tab-content tab-design">
        <div class="tab-pane active" id="" style="padding-left: 20px;padding-right: 20px;">
            <div class="row">
                <div class="col-md-12">
                    <div id="" class="form-group">
                        <div id="topcust" class="panel panel-success">
                            <div class="panel-heading">Bank Approval Status</div>
                            <div class="panel-body">
                                <div class="row" style="padding:5px;">
                                    <div class="col-md-4">
                                        {!! Form::hidden('id',null) !!}
                                        {!! Form::label('loan_status','Bank Approval Status') !!}
                                        {!! Form::radio('loan_status', $bankApprovalStatus_1, null, ['id' => 'security_yes']) !!}
                                        {!! Form::label('security_yes', 'Approve' ) !!}
                                        {!! Form::radio('loan_status', $bankApprovalStatus_2, null, ['id' => 'security_no']) !!}
                                        {!! Form::label('security_no', 'Reject') !!}
                                    </div>
                                    <div class="col-md-8">
                                        {!! Form::label('remarks','Your Remarks', ['class'=>'form-label']) !!}
                                        {!! Form::textarea('remarks', null, array('class' => 'form-control','id'=>'remarks', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:170px;')) !!}
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
