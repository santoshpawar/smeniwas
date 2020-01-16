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
                                {!! Form::radio('ii_radio_btn', '1',false , ['id' => 'engineeringEquipment','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Engineering Equipment (Boiler etc)</strong>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('ii_radio_btn', '2',false , ['id' => 'electronicEquipment','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Electronic Equipment</strong>
                            </label>                    
                        </div>
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('ii_radio_btn', '3',false , ['id' => 'contractorsInsurance','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Contractors Insurance</strong>
                            </label>                    
                        </div>
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('ii_radio_btn', '4',false , ['id' => 'inventoryLoss','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Inventory Loss</strong>
                            </label>                    
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- start of engEquipment -->
            <div id="engEquipment">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="dynamic" class="form-group" style="margin-left: auto;">
                            <br>
                            @for($formIndex=0; $formIndex < $maxAnotherTypes; $formIndex++)

                                <?php $colorstyle = ""; ?>
                                @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )

                                <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                                @else
                                <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                                @endif

                                @if($formIndex == 0)
                                    <div id="engOptn_{{$formIndex}}" class="panel panel-success">
                                        <div class="panel-heading">Engineering Equipment Type</div>
                                @else
                                    <div id="engOptn_{{$formIndex}}" class="panel panel-success collapse">
                                        <div class="panel-heading">Engineering Equipment Type - {{($formIndex)}}</div>
                                @endif
               
                                        <div class="row">
                                            <br>
                                            <div class="col-lg-12">
                                                <div class="col-md-8" style="padding-bottom:20px">
                                                    {!! Form::label('ii_eng_equip_brief_asset_desc'.$formIndex,'Brief Asset Description') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('engineering['.$formIndex.'][brief_asset_desc]', null, array('class' => 'form-control', 'id'=>'eng_brief_asset_desc_'.$formIndex, 'placeholder'=>'Brief Asset Description','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-2" style="padding-bottom:20px">
                                                    {!! Form::label('ii_eng_equip_sel_qty_in_type'.$formIndex,'Quantity in Type') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::select('engineering['.$formIndex.'][sel_qty_in_type]', ['' => '', 'number' => 'Numbers', 'weight' => 'Weight in Kgs'], null, array('class' => 'form-control', 'style' => 'width: 100%;', 'id'=>'eng_sel_qty_in_type_'.$formIndex, 'placeholder'=>'Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-2" style="padding-bottom:20px">
                                                    {!! Form::label(null,null) !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('engineering['.$formIndex.'][txt_qty_in_type]', null, array('class' => 'form-control', 'style' =>'margin-top:7px', 'id'=>'eng_txt_qty_in_type_'.$formIndex, 'placeholder'=>'Enter Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_eng_equip_estimated_value'.$formIndex,'Estimated Value ( ') !!}
                                                    {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                    {!! Form::label(null,' In Lacs )') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('engineering['.$formIndex.'][estimated_value]', null, array('class' => 'form-control', 'id'=>'eng_estimated_value_'.$formIndex, 'placeholder'=>'Estimated Value','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_eng_equip_year_of_manf'.$formIndex,'Year of Manufacturing/Production') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('engineering['.$formIndex.'][year_of_manf]', null, array('class' => 'form-control', 'id'=>'eng_year_of_manf_'.$formIndex, 'placeholder'=>'Year of Manufacturing/Production','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_eng_equip_manufacturer'.$formIndex,'Manufacturer') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('engineering['.$formIndex.'][manufacturer]', null, array('class' => 'form-control', 'id'=>'eng_manufacturer_'.$formIndex, 'placeholder'=>'Manufacturer','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                            @endfor
                            {!! Form::hidden('eng_counter_storage', 0, array('id' => 'eng_counter_storage')) !!}
                            {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
                                    </div>
                            <div class="form-group" style="padding-left: 20px;">
                                {!! Form::button('Add Engineering Equipment Type', ['class'=>'btn btn-primary add_promo_button', 'id'=>'eng_add_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                {!! Form::button('Remove Engineering Equipment Type', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'eng_rem_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!-- end of engEquipment -->

            <!-- start of eleEquipment -->
            <div id="eleEquipment">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="dynamic" class="form-group" style="margin-left: auto;">
                            <br>
                            @for($formIndex=0; $formIndex < $maxAnotherTypes; $formIndex++)

                                <?php $colorstyle = ""; ?>
                                @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )

                                <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                                @else
                                <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                                @endif

                                @if($formIndex == 0)
                                    <div id="eleOptn_{{$formIndex}}" class="panel panel-success">
                                        <div class="panel-heading">Electronic Equipment Type</div>
                                @else
                                    <div id="eleOptn_{{$formIndex}}" class="panel panel-success collapse">
                                        <div class="panel-heading">Electronic Equipment Type - {{($formIndex)}}</div>
                                @endif
               
                                        <div class="row">
                                            <br>
                                            <div class="col-lg-12">
                                                <div class="col-md-8" style="padding-bottom:20px">
                                                    {!! Form::label('ii_ele_equip_brief_asset_desc'.$formIndex,'Brief Asset Description') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('electronic['.$formIndex.'][brief_asset_desc]', null, array('class' => 'form-control', 'id'=>'ele_brief_asset_desc_'.$formIndex, 'placeholder'=>'Brief Asset Description','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-2" style="padding-bottom:20px">
                                                    {!! Form::label('ii_ele_equip_sel_qty_in_type'.$formIndex,'Quantity in Type') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::select('electronic['.$formIndex.'][sel_qty_in_type]', ['' => '', 'number' => 'Numbers', 'weight' => 'Weight in Kgs'], null, array('class' => 'form-control', 'style' => 'width: 100%;', 'id'=>'ele_sel_qty_in_type_'.$formIndex, 'placeholder'=>'Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-2" style="padding-bottom:20px">
                                                    {!! Form::label(null,null) !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('electronic['.$formIndex.'][txt_qty_in_type]', null, array('class' => 'form-control', 'style' =>'margin-top:7px', 'id'=>'ele_txt_qty_in_type_'.$formIndex, 'placeholder'=>'Enter Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_ele_equip_estimated_value'.$formIndex,'Estimated Value ( ') !!}
                                                    {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                    {!! Form::label(null,' In Lacs )') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('electronic['.$formIndex.'][estimated_value]', null, array('class' => 'form-control', 'id'=>'ele_estimated_value_'.$formIndex, 'placeholder'=>'Estimated Value','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_ele_equip_year_of_manf'.$formIndex,'Year of Manufacturing/Production') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('electronic['.$formIndex.'][year_of_manf]', null, array('class' => 'form-control', 'id'=>'ele_year_of_manf_'.$formIndex, 'placeholder'=>'Year of Manufacturing/Production','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_ele_equip_manufacturer'.$formIndex,'Manufacturer') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('electronic['.$formIndex.'][manufacturer]', null, array('class' => 'form-control', 'id'=>'ele_manufacturer_'.$formIndex, 'placeholder'=>'Manufacturer','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                            @endfor
                            {!! Form::hidden('ele_counter_storage', 0, array('id' => 'ele_counter_storage')) !!}
                            {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
                                    
                            <div class="form-group" style="padding-left: 20px;">
                                {!! Form::button('Add Electronic Equipment Type', ['class'=>'btn btn-primary add_promo_button', 'id'=>'ele_add_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                {!! Form::button('Remove Electronic Equipment Type', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'ele_rem_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!-- end of eleEquipment -->

            <!-- start of conInsurance -->
            <div id="conInsurance">
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <div id="conOptn" class="panel panel-success">
                            <div class="panel-heading">Contractors Insurance </div>
                            <div class="row">
                                <br>
                                <div class="col-lg-12">
                                    <div class="col-md-4" style="padding-bottom:20px">
                                        {!! Form::label('ii_con_completed_val_of_contract','Completed Value of Contract ( ') !!}
                                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                        {!! Form::label(null,' In Lacs )') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::text('ii_con_completed_val_of_contract', null, array('class' => 'form-control', 'id'=>'com_val_of_contract', 'placeholder'=>'Completed Value of Contract','data-mandatory'=>'M' ,$setDisable)) !!}    
                                    </div>
                                    <div class="col-md-4" style="padding-bottom:20px">
                                        {!! Form::label('ii_exp_period_of_completion','Expected period of completion (in month)') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::text('ii_exp_period_of_completion', null, array('class' => 'form-control', 'id'=>'exp_period_of_completion', 'placeholder'=>'Expected period of completion','data-mandatory'=>'M' ,$setDisable)) !!}    
                                    </div>
                                    <div class="col-md-4" style="padding-bottom:20px">
                                        {!! Form::label('ii_no_of_workers_employed','No of workers employed') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::text('ii_no_of_workers_employed', null, array('class' => 'form-control', 'id'=>'no_of_workers_employed', 'placeholder'=>'No of workers employed','data-mandatory'=>'M' ,$setDisable)) !!}    
                                    </div>
                                    <div class="col-md-4" style="padding-bottom:20px">
                                        {!! Form::label('ii_type_of_project','Type of Project') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::select('ii_type_of_project', ['' => '', 'RES' => 'Real Estate - Residential', 'COM' => 'Real Estate - Commercial', 'FLY' => 'Bridge/Flyover', 'RD' => 'Road', 'CIV' => 'Industrial Civil', 'COMPL' => 'Industrial Complete Plan', 'PPLN' => 'Pipeline', 'TELC' => 'Telecommunications'], null, array('class' => 'form-control', 'id'=>'type_of_project', 'placeholder'=>'Type of Project','data-mandatory'=>'M' ,$setDisable)) !!}    
                                    </div>
                                    <div class="col-md-4" style="padding-bottom:20px">
                                        {!! Form::label('ii_nature_of_work','Nature of Work') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::select('ii_nature_of_work', ['' => '', 'TNK' => 'Turnkey', 'CON' => 'Contractor', 'SCON' => 'Sub Contractor'], null, array('class' => 'form-control', 'id'=>'nature_of_work', 'placeholder'=>'Nature of Work','data-mandatory'=>'M' ,$setDisable)) !!}    
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>    
            </div>
            <!-- end of conInsurance -->

            <!-- start of conInsurance -->
            <div id="invLoss">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="static" class="form-group" style="margin-left: auto;">
                            <br>
                            <div id="selInventoryBlock" class="panel panel-success">
                                <div class="panel-heading">Select Inventory</div>
                                <div class="row">
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="col-md-6" style="padding-bottom:20px">
                                            {!! Form::label('inventory_type', 'Inventory') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!} 
                                            {!! Form::select('inventory_type', $inventoryTypes, null, ['class' => 'form-control amount', 'id' => 'inventoryTypes','data-mandatory'=>'M',$setDisable]) !!}              
                                        </div>
                                        <div class="col-md-6" id="agriCommStoreAt" style="padding-bottom:20px">
                                            {!! Form::label('inventory_stored_at', 'Store At') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!} 
                                            {!! Form::select('inventory_stored_at', ['' => '', 'Company Owned Warehouse' => 'Company Owned Warehouse', 'Third Party Warehouse' => 'Third Party Warehouse', 'Collateral Managed' => 'Collateral Managed'], null, ['class' => 'form-control amount', 'style' => 'width: 100%;', 'id' => 'inventoryStoredAt','data-mandatory'=>'M',$setDisable]) !!}              
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="dynamic" class="form-group" style="margin-left: auto;">
                            <br>
                            @for($formIndex=0; $formIndex < $maxAnotherTypes; $formIndex++)

                                <?php $colorstyle = ""; ?>
                                @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )

                                <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                                @else
                                <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                                @endif

                                @if($formIndex == 0)
                                    <div id="invLossOptn_{{$formIndex}}" class="panel panel-success">
                                        <div class="panel-heading">Inventory Loss Type</div>
                                @else
                                    <div id="invLossOptn_{{$formIndex}}" class="panel panel-success collapse">
                                        <div class="panel-heading">Inventory Loss Type - {{($formIndex)}}</div>
                                @endif
               
                                        <div class="row">
                                            <br>
                                            <div class="col-lg-12">
                                                <div class="col-md-8" style="padding-bottom:20px">
                                                    {!! Form::label('ii_inv_loss_equip_brief_asset_desc'.$formIndex,'Brief Asset Description') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('inventory['.$formIndex.'][brief_asset_desc]', null, array('class' => 'form-control', 'id'=>'inv_loss_brief_asset_desc_'.$formIndex, 'placeholder'=>'Brief Asset Description','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-2" style="padding-bottom:20px">
                                                    {!! Form::label('ii_inv_loss_equip_sel_qty_in_type'.$formIndex,'Quantity in Type') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::select('inventory['.$formIndex.'][sel_qty_in_type]', ['' => '', 'number' => 'Numbers', 'weight' => 'Weight in Kgs'], null, array('class' => 'form-control', 'style' => 'width: 100%;', 'id'=>'inv_loss_sel_qty_in_type_'.$formIndex, 'placeholder'=>'Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-2" style="padding-bottom:20px">
                                                    {!! Form::label(null,null) !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('inventory['.$formIndex.'][txt_qty_in_type]', null, array('class' => 'form-control', 'style' =>'margin-top:7px', 'id'=>'inv_loss_txt_qty_in_type_'.$formIndex, 'placeholder'=>'Enter Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_inv_loss_equip_estimated_value'.$formIndex,'Estimated Value ( ') !!}
                                                    {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                    {!! Form::label(null,' In Lacs )') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('inventory['.$formIndex.'][estimated_value]', null, array('class' => 'form-control', 'id'=>'inv_loss_estimated_value_'.$formIndex, 'placeholder'=>'Estimated Value','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_inv_loss_equip_year_of_manf'.$formIndex,'Year of Manufacturing/Production') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('inventory['.$formIndex.'][year_of_manf]', null, array('class' => 'form-control', 'id'=>'inv_loss_year_of_manf_'.$formIndex, 'placeholder'=>'Year of Manufacturing/Production','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                                <div class="col-md-4" style="padding-bottom:20px">
                                                    {!! Form::label('ii_inv_loss_equip_manufacturer'.$formIndex,'Manufacturer') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::text('inventory['.$formIndex.'][manufacturer]', null, array('class' => 'form-control', 'id'=>'inv_loss_manufacturer_'.$formIndex, 'placeholder'=>'Manufacturer','data-mandatory'=>'M' ,$setDisable)) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                            @endfor
                            {!! Form::hidden('inv_loss_counter_storage', 0, array('id' => 'inv_loss_counter_storage')) !!}
                            {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
                                    
                            <div class="form-group" style="padding-left: 20px;">
                                {!! Form::button('Add Inventory Loss Type', ['class'=>'btn btn-primary add_promo_button', 'id'=>'inv_loss_add_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                {!! Form::button('Remove Inventory Loss Type', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'inv_loss_rem_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <!-- end of conInsurance -->

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
    $(document).ready(function() {

        $('#type_of_project').select2({
            allowClear: true,
            placeholder: "Select Project Type"
        });

        $('#nature_of_work').select2({
            allowClear: true,
            placeholder: "Select Work"
        });

        $('#inventoryTypes').select2({
            allowClear: true,
            placeholder: "Select Inventory Type"
        });

        $('#inventoryStoredAt').select2({
            allowClear: true,
            placeholder: "Select Inventory Stored At"
        });

        $('#agriCommStoreAt').hide();

        $('#inventoryTypes').change(function(){
            if ($(this).val() == 'AC') {
               $('#agriCommStoreAt').show(); 
            } else {
               $('#agriCommStoreAt').hide();  
            }
        });

        //hide asset to be insured select
        $('#engEquipment').hide();
        $('#eleEquipment').hide();
        $('#conInsurance').hide();
        $('#invLoss').hide();
        
        $('#engineeringEquipment').change(function(){
            $('#engEquipment').show();
            $('#eleEquipment').hide();
            $('#conInsurance').hide();
            $('#invLoss').hide();
        });

        $('#electronicEquipment').change(function(){
            $('#eleEquipment').show();
            $('#engEquipment').hide();
            $('#conInsurance').hide();
            $('#invLoss').hide();
        });

        $('#contractorsInsurance').change(function(){
            $('#conInsurance').show();
            $('#engEquipment').hide();
            $('#eleEquipment').hide();
            $('#invLoss').hide();
        });

        $('#inventoryLoss').change(function(){
            $('#invLoss').show();
            $('#engEquipment').hide();
            $('#eleEquipment').hide();
            $('#conInsurance').hide();
        });

        var eng_counter = 0; // Hidden Field inventory Counter Variable
        var eng_existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        var eng_add_button = jQuery("#eng_add_another_type");
        var eng_delete_button = jQuery("#eng_rem_another_type");
        var eng_no_of_opened_containers = $("#no_of_opened_containers").val();

        for (var i = 0; i < eng_existing_records; i++) {
            $("#engOptn_" + i).collapse("show");
            eng_counter = i;
            $("#eng_counter_storage").val(i);
        }

        var a = $("#eng_counter_storage").val();
        if (a > 0) {
            for (var i = 1; i <= a; i++) {
                $("#engOptn_" + i).collapse("show");
                if (i == 4) {
                    eng_add_button.hide();
                }
                eng_counter = i;
            }
        }

        if (eng_counter == 0) {
            $(eng_delete_button).hide();
        }

        $(eng_add_button).click(function(e){
            e.preventDefault();
            eng_counter++;
            $("#eng_counter_storage").val(eng_counter);
            eng_existing_records++;
            $("#engOptn_" + eng_counter).collapse("show");
            if (eng_counter == 3) {
                $(this).hide();
            }
            if (eng_counter > 0) {
                $(eng_delete_button).show();
            }
        });

        $(eng_delete_button).click(function (e) {
            e.preventDefault();
            $("#engOptn_" + eng_counter).collapse("hide");
            eng_counter--;
            $("#eng_counter_storage").val(eng_counter);
            eng_existing_records--;
            if (eng_counter == 0) {
                $(eng_delete_button).hide();
            }
            if (eng_counter < 3) {
                $(eng_add_button).show();
            }
        });

        var ele_counter = 0; // Hidden Field inventory Counter Variable
        var ele_existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        var ele_add_button = jQuery("#ele_add_another_type");
        var ele_delete_button = jQuery("#ele_rem_another_type");
        var ele_no_of_opened_containers = $("#no_of_opened_containers").val();

        for (var i = 0; i < ele_existing_records; i++) {
            $("#eleOptn_" + i).collapse("show");
            ele_counter = i;
            $("#ele_counter_storage").val(i);
        }

        var a = $("#ele_counter_storage").val();
        if (a > 0) {
            for (var i = 1; i <= a; i++) {
                $("#eleOptn_" + i).collapse("show");
                if (i == 4) {
                    ele_add_button.hide();
                }
                ele_counter = i;
            }
        }

        if (ele_counter == 0) {
            $(ele_delete_button).hide();
        }

        $(ele_add_button).click(function(e){
            e.preventDefault();
            ele_counter++;
            $("#ele_counter_storage").val(ele_counter);
            ele_existing_records++;
            $("#eleOptn_" + ele_counter).collapse("show");
            if (ele_counter == 3) {
                $(this).hide();
            }
            if (ele_counter > 0) {
                $(ele_delete_button).show();
            }
        });

        $(ele_delete_button).click(function (e) {
            e.preventDefault();
            $("#eleOptn_" + ele_counter).collapse("hide");
            ele_counter--;
            $("#ele_counter_storage").val(ele_counter);
            ele_existing_records--;
            if (ele_counter == 0) {
                $(ele_delete_button).hide();
            }
            if (ele_counter < 3) {
                $(ele_add_button).show();
            }
        });


        var inv_loss_counter = 0; // Hidden Field inventory Counter Variable
        var inv_loss_existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        var inv_loss_add_button = jQuery("#inv_loss_add_another_type");
        var inv_loss_delete_button = jQuery("#inv_loss_rem_another_type");
        var inv_loss_no_of_opened_containers = $("#no_of_opened_containers").val();

        for (var i = 0; i < inv_loss_existing_records; i++) {
            $("#invLossOptn_" + i).collapse("show");
            inv_loss_counter = i;
            $("#inv_loss_counter_storage").val(i);
        }

        var a = $("#inv_loss_counter_storage").val();
        if (a > 0) {
            for (var i = 1; i <= a; i++) {
                $("#invLossOptn_" + i).collapse("show");
                if (i == 4) {
                    inv_loss_add_button.hide();
                }
                inv_loss_counter = i;
            }
        }

        if (inv_loss_counter == 0) {
            $(inv_loss_delete_button).hide();
        }

        $(inv_loss_add_button).click(function(e){
            e.preventDefault();
            inv_loss_counter++;
            $("#inv_loss_counter_storage").val(inv_loss_counter);
            inv_loss_existing_records++;
            $("#invLossOptn_" + inv_loss_counter).collapse("show");
            if (inv_loss_counter == 3) {
                $(this).hide();
            }
            if (inv_loss_counter > 0) {
                $(inv_loss_delete_button).show();
            }
        });

        $(inv_loss_delete_button).click(function (e) {
            e.preventDefault();
            $("#invLossOptn_" + inv_loss_counter).collapse("hide");
            inv_loss_counter--;
            $("#inv_loss_counter_storage").val(inv_loss_counter);
            inv_loss_existing_records--;
            if (inv_loss_counter == 0) {
                $(inv_loss_delete_button).hide();
            }
            if (inv_loss_counter < 3) {
                $(inv_loss_add_button).show();
            }
        });
    });


    @for ($recordNum = 0; $recordNum < 4; $recordNum++)
        $('#eng_sel_qty_in_type_{{{$recordNum}}}').select2({
            allowClear: true,
            placeholder: "Select Quantity Type"
        });

        $('#ele_sel_qty_in_type_{{{$recordNum}}}').select2({
            allowClear: true,
            placeholder: "Select Quantity Type"
        });

        $('#inv_loss_sel_qty_in_type_{{{$recordNum}}}').select2({
            allowClear: true,
            placeholder: "Select Quantity Type"
        });
    @endfor
</script>
@stop