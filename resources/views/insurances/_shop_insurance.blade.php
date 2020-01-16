<?php 
    $setDisable = '';
    $comYourSalestype = '';
    $existingCompanyDeailsCount = '';
    $maxCompanyDetails = '';
    $removeMandatory = '';
?>
<div class="col-md-10">
    <div class="tab-content tab-design">
        <div class="tab-pane active" id="IndustrialInsurance" style="">
            <div id="radioGroup">
                <div class="row">    
                    <div class="col-lg-12" style="padding-top: 15px;">
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('si_radio_btn', '1',false , ['id' => 'building','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Building & Structure</strong>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('si_radio_btn', '2',false , ['id' => 'shop','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Shop Inventory</strong>
                            </label>                    
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- start of engEquipment -->
            <div id="building">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="dynamic" class="form-group" style="margin-left: auto;">
                            <br>
                            <div id="buildingptn" class="panel panel-success">
                                <div class="panel-heading">Shop Insurance</div>
                                <div>
                                    <!-- Table -->
                                    <table cellpadding="4" cellspacing="4" class="table borderless" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="padding: 5px;">
                                                <table class="table borderless" style="margin-bottom: 0px;">
                                                    <tr>
                                                        <td>
                                                            <table class="table borderless">
                                                                <tr>
                                                                    <td class="col-md-6" style="border-bottom:1px dashed #666666;">Type of Insurance</td>
                                                                    <td style="border-bottom:1px dashed #666666;">Amount <span>&nbsp;( <span class="fa fa-inr">&nbsp; </span>in Lacs )</span> of insurance Required</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('si_chkboxFire', 'fire',false , ['id' => 'chkboxFire','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('Fire', 'Fire', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtFire', null, array('class' => 'form-control', 'id'=>'txtFire', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('si_chkboxBurglary', 'burglary',false , ['id' => 'chkboxBurglary','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('Burglary', 'Burglary', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtBurglary', null, array('class' => 'form-control', 'id'=>'txtBurglary', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('si_chkboxFidelity', 'fidelity',false , ['id' => 'chkboxFidelity','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('Fidelity', 'Fidelity', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtFidelity', null, array('class' => 'form-control', 'id'=>'txtFidelity', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('si_chkboxCashInTransit', 'cashintransit',false , ['id' => 'chkboxCashInTransit','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('Cash-In-Transit', 'Cash-in-Transit', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtCashInTransit', null, array('class' => 'form-control', 'id'=>'txtCashInTransit', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!-- end of engEquipment -->

            <div class="center-align" style="margin:0px 25px;"></div>
            <div class="row">
                <div class="col-md-12" style="margin-left:20px;">
                    <div id="currentSection">
                        {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-success btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-success btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
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

@section('footer')

<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

<script>
        
</script>
@stop