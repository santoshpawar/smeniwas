<?php 
    $setDisable = '';
    $comYourSalestype = '';
    $existingCompanyDeailsCount = '';
    $maxCompanyDetails = '';
    $removeMandatory = '';
?>
<div class="col-md-10">
    <div class="tab-content tab-design">
        <div class="tab-pane active" id="CompanyBackground" style="">
            <div class="col-lg-12" style="padding-top: 15px;">
                <div id="radioBtns" class="panel panel-success">
                    <div class="panel-heading"><h3 class="panel-title">Select Type of Policy Cover</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8" style="padding-bottom:15px;">
                                <label class="radio-inline medium-text-14" style="margin-top:15px;">
                                    {!! Form::radio('damage_covered', '1',false , ['id' => 'goods','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                    <strong>Goods Damage</strong>
                                </label>
                                <label class="radio-inline medium-text-14" style="margin-top:15px;">
                                    {!! Form::radio('damage_covered', '0',false , ['id' => 'allrisk','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                    <strong>All Risk incl Damage and Consequential Loss (Revenue/Profit)</strong>
                                </label>                    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-success btn-cons sme_button','id'=>'nextInFireInsurance', 'value'=> 'NextIn')) !!}    
                            </div>
                        </div>
                    </div>
                </div>
                <div id="assets_to_be_insured_div" class="panel panel-success">
                    <div class="panel-heading"><h3 class="panel-title">Details of Assets to be Insured</h3></div>    
                    <div class="panel-body">
                        <div class="row" style="padding-bottom:15px;">
                            <div class="col-md-6">
                                <label for="assetsToBeInsured">Type of Assets</label>
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                {!! Form::select('assets_to_be_insured', $assetsToBeInsured, null, ['class' => 'form-control amount', 'style' => 'width:100%;', 'id' => 'assetToBeInsured','data-mandatory'=>'M',$setDisable]) !!}   
                            </div>
                        </div>

                        <!-- start of fi_assetTypeManufacturePlant -->
                        <div class="row">
                            <div id="fi_assetTypeManufacturePlant" class="panel panel-success">
                                <div class="panel-heading"><h3 class="panel-title">Details Of Manufacturing Plant</h3></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div id="manufacturingPlant">    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-md-12" style="padding-bottom:20px">
                                                        {!! Form::label('com_business_type', 'Description of Manufacturing Activity') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_desc_of_manf_act', null, array('class' => 'form-control', 'id'=>'desc_of_manf_act', 'placeholder'=>'Description','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom:20px">
                                                        {!! Form::label('amp_gross_book_val','Gross Book Value of Plant ( ') !!}
                                                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                        {!! Form::label(null,' In Lacs )') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_gross_book_val', null, array('class' => 'form-control', 'id'=>'plant_gross_book_val', 'placeholder'=>'Gross Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom:20px">
                                                        {!! Form::label('amp_net_book_val','Net Book Value of Plant ( ') !!}
                                                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                        {!! Form::label(null,' In Lacs )') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_net_book_val', null, array('class' => 'form-control', 'id'=>'plant_net_book_val', 'placeholder'=>'Net Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom:20px">
                                                        {!! Form::label('amp_turnover','Last Audited Turnover of Plant ( ') !!}
                                                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                        {!! Form::label(null,' In Lacs )') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_turnover', null, array('class' => 'form-control', 'id'=>'plant_turnover', 'placeholder'=>'NLast Audited Turnover of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom:20px">
                                                        {!! Form::label('amp_last_fin_year','Last Financial Year') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_last_fin_year', null, array('class' => 'form-control', 'id'=>'plant_last_fin_year', 'placeholder'=>'Last Financial Year','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom:20px">
                                                        {!! Form::label('amp_add_1','Address 1') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_add_1', null, array('class' => 'form-control', 'id'=>'plant_add_1', 'placeholder'=>'Address 1','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom:20px">
                                                        {!! Form::label('amp_add_2','Address 2') !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        {!! Form::text('amp_add_2', null, array('class' => 'form-control', 'id'=>'plant_add_2', 'placeholder'=>'Address 2','data-mandatory'=>'M' ,$setDisable)) !!}
                                                    </div>        
                                                </div>
                                            </div>
                                        </div>    
                                        
                                        {{--========Start DivSub 1==========================================================================--}}
                                        <div id="divTab_sub1" style="display:none">
                                            <div>
                                                <br>
                                                <?php
                                                    $counter = 0;
                                                ?>
                                                @foreach($bl_year as $blyear)
                                                    <div class="col-lg-4">
                                                        <div class="panel panel-success">
                                                            <!-- Default panel contents -->
                                                            <div class="panel-heading" style="text-align:center" name={{$blyear}}>{{$blyear}}<span>&nbsp;( <span class="fa fa-inr">&nbsp; </span>Lacs )</span></div>    

                                                            <div class="panel-body" style="padding:0px;">
                                                                <!-- Table -->
                                                                <table cellpadding="4" cellspacing="4" class="table borderless" style="margin-bottom: 0px;">
                                                                    <tr>
                                                                        <td style="padding: 5px;">
                                                                            <table class="table borderless" style="margin-bottom: 0px;">
                                                                                <tr>
                                                                                    <td>
                                                                                        <table class="table borderless">
                                                                                            <tr>
                                                                                                <td style="padding: 3px;">
                                                                                                    {!! Form::label('avg_annual_revenue', 'Average Annual Revenue') !!}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="padding: 3px;">
                                                                                                    {!! Form::text('fi_amt['.$counter.'][avg_annual_revenue]', null , array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="padding: 3px;">
                                                                                                    {!! Form::label('avg_profit', 'Average Profit') !!}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="padding: 3px;">
                                                                                                    {!! Form::text('fi_amt['.$counter.'][avg_profit]', null , array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}
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
                                                        </div>
                                                    </div>    
                                                <?php $counter++; ?>
                                                @endforeach    
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <!-- end of fi_assetTypeManufacturePlant -->

                        <!-- start of fi_assetTypeStock/Inventory -->
                        <div class="row">
                            <div class="col-lg-12">
                            <!-- <div id="fi_assetTypeStockInventory" class="panel panel-success"> -->
                                <!-- <div class="panel-heading"><h3 class="panel-title">Details Of Stock & Inventory</h3></div> -->
                                <!-- <div class="panel-body"> -->
                                    
                                    <!-- start inventorySectionDiv -->
                                    <div id="fi_assetTypeStockInventory" class="row">
                                        @for($inventoryIndex=0; $inventoryIndex < count($inventoryTypes) - 1; $inventoryIndex++)
                                            <?php
                                                
                                                $class = '';

                                                if ($inventoryIndex > 0) {

                                                    $class = 'collapse';
                                                } 
                                            ?>
                                            <div id="inventory_type_{{$inventoryIndex}}" class="panel panel-success {{$class}}">
                                                <div class="panel-heading"><h3 class="panel-title">Add Inventory Details</h3></div>
                                                <div class="panel-body">    
                                                    <div class="row">
                                                        <div class="col-md-12" style="padding-bottom:15px">
                                                            <label class="radio-inline">
                                                                {!! Form::radio('goods_type', '1',false , ['id' => 'raw_material','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                Raw Material
                                                            </label>
                                                            <label class="radio-inline">
                                                                {!! Form::radio('goods_type', '0',false , ['id' => 'finished_goods','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                Finished Goods
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6" style="padding-bottom:15px;">
                                                            {!! Form::label('inventory_type', 'Select Inventory Type') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!} 
                                                            {!! Form::select('inventory_type['.$inventoryIndex.'][type]', $inventoryTypes, null, ['class' => 'form-control amount', 'style' => 'width:100%;', 'id' => 'sel_inventory_type_'.$inventoryIndex,'data-mandatory'=>'M',$setDisable]) !!}              
                                                        </div>
                                                        <div class="col-md-6" id="agriCommStoreAt_{{$inventoryIndex}}">
                                                            {!! Form::label('inventory_stored_at', 'Store At') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!} 
                                                            {!! Form::select('inventory_stored_at', ['' => '', 'Company Owned Warehouse' => 'Company Owned Warehouse', 'Third Party Warehouse' => 'Third Party Warehouse', 'Collateral Managed' => 'Collateral Managed'], null, ['class' => 'form-control amount', 'style' => 'width: 100%;', 'id' => 'inventoryStoredAt_'.$inventoryIndex,'data-mandatory'=>'M',$setDisable]) !!}              
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        @for($formIndex=0; $formIndex < $maxAnotherTypes; $formIndex++)
                                                            <?php
                                                    
                                                                $optionClass = '';

                                                                if ($formIndex > 0) {

                                                                    $optionClass = 'collapse';
                                                                } 
                                                            ?>

                                                            <div id="invOptn_{{$inventoryIndex}}_{{$formIndex}}" class="panel panel-success {{$optionClass}}">
                                                                <div class="panel-heading"><h3 class="panel-title">Asset Briefs</h3></div> 
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8" style="padding-bottom:20px">
                                                                            {!! Form::label('asi_brief_asset_desc','Brief Asset Description') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('inventory['.$formIndex.'][brief_asset_desc]', null, array('class' => 'form-control', 'id'=>'inv_brief_asset_desc_'.$formIndex, 'placeholder'=>'Brief Asset Description','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-2" style="padding-bottom:20px">
                                                                            {!! Form::label('asi_sel_qty_in_type','Quantity in Type') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::select('inventory['.$formIndex.'][sel_qty_in_type]', ['' => '', 'number' => 'Numbers', 'weight' => 'Weight in Kgs'], null, array('class' => 'form-control', 'style' => 'width: 100%;', 'id'=>'inv_sel_qty_in_type_'.$formIndex, 'placeholder'=>'Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-2" style="padding-bottom:20px">
                                                                            {!! Form::label(null,null) !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('inventory['.$formIndex.'][txt_qty_in_type]', null, array('class' => 'form-control', 'style' =>'margin-top:7px', 'id'=>'inv_txt_qty_in_type_'.$formIndex, 'placeholder'=>'Enter Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-4" style="padding-bottom:20px">
                                                                            {!! Form::label('asi_estimated_value','Estimated Value ( ') !!}
                                                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                                            {!! Form::label(null,' In Lacs )') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('inventory['.$formIndex.'][estimated_value]', null, array('class' => 'form-control', 'id'=>'inv_estimated_value_'.$formIndex, 'placeholder'=>'Estimated Value','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-4" style="padding-bottom:20px">
                                                                            {!! Form::label('asi_year_of_manf','Year of Manufacturing/Production') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('inventory['.$formIndex.'][year_of_manf]', null, array('class' => 'form-control', 'id'=>'inv_year_of_manf_'.$formIndex, 'placeholder'=>'Year of Manufacturing/Production','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                        <div class="col-md-4" style="padding-bottom:20px">
                                                                            {!! Form::label('asi_manufacturer','Manufacturer') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                            {!! Form::text('inventory['.$formIndex.'][manufacturer]', null, array('class' => 'form-control', 'id'=>'inv_manufacturer_'.$formIndex, 'placeholder'=>'Manufacturer','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                        </div>
                                                                    </div>    
                                                                </div>   
                                                            </div>


                                                        @endfor
                                                        {!! Form::hidden('IBCS', 0, array('id' => 'IBCS_'.$inventoryIndex)) !!}
                                                        {!! Form::hidden('inventory_brief_counter_storage', 0, array('id' => 'inventory_brief_counter_storage_'.$inventoryIndex)) !!}
                                                        {!! Form::hidden('inventory_brief_no_of_opened_containers', 1, array('id' => 'inventory_brief_no_of_opened_containers_'.$inventoryIndex)) !!}
                                                        <div class="form-group" style="padding-left: 20px;">
                                                            {!! Form::button('Add Asset Brief', ['class'=>'btn btn-primary add_promo_button', 'id'=>'inventory_add_brief_'.$inventoryIndex, 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                                            {!! Form::button('Remove Asset Brief', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'inventory_rem_brief_'.$inventoryIndex, 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                                        </div>  
                                                    </div>


                                                </div>
                                            </div> 
                                        @endfor
                                        {!! Form::hidden('inv_type_counter_storage', 0, array('id' => 'inv_type_counter_storage')) !!}
                                        {!! Form::hidden('inv_type_no_of_opened_containers', 1, array('id' => 'inv_type_no_of_opened_containers')) !!}
                                        <div class="form-group" style="padding-left: 20px;">
                                            {!! Form::button('Add Inventory', ['class'=>'btn btn-primary add_promo_button', 'id'=>'inv_type_add', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                            {!! Form::button('Remove Inventory', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'inv_type_rem', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                        </div>
                                    </div>
                                    <!-- /. end inventorySectionDiv -->


                                    
                                <!-- </div> -->
                            <!-- </div> -->
                            </div>
                        </div>
                        <!-- end of fi_assetTypeStock/Inventory -->

                        <!-- start of fi_assetTypeOffice -->
                        <div class="row">
                            <div id="fi_assetTypeOffice" class="panel panel-success">
                                <div class="panel-heading"><h3 class="panel-title">Details Of Office</h3></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6" style="padding-bottom:20px">
                                            {!! Form::label('ao_office_goods_val','Value of Office Goods ( ') !!}
                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                            {!! Form::label(null,' In Lacs )') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::text('ao_office_goods_val', null, array('class' => 'form-control', 'id'=>'office_goods_val', 'placeholder'=>'Value of Office Goods','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-6" style="padding-bottom:20px">
                                            {!! Form::label('ao_insurance_cover_req','Insurance Cover Required ( ') !!}
                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                            {!! Form::label(null,' In Lacs )') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::text('ao_insurance_cover_req', null, array('class' => 'form-control', 'id'=>'insurance_cover_req', 'placeholder'=>'Insurance Cover Required','data-mandatory'=>'M' ,$setDisable)) !!}   
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ao_address_1','Address 1') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::text('ao_address_1', null, array('class' => 'form-control', 'id'=>'address_1', 'placeholder'=>'Address 1','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ao_address_2','Address 2') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::text('ao_address_2', null, array('class' => 'form-control', 'id'=>'address_2', 'placeholder'=>'Address 2','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ao_address_3','Address 3') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::text('ao_address_3', null, array('class' => 'form-control', 'id'=>'address_3', 'placeholder'=>'Address 3','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ao_city','City') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::select('ao_city', $cities, null, array('class' => 'form-control', 'style' => 'width:100%;', 'id'=>'city', 'placeholder'=>'City','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ao_state','State') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::select('ao_state', $states, null, array('class' => 'form-control', 'style' => 'width:100%;', 'id'=>'state', 'placeholder'=>'State','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ao_pincode','Pincode') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                            {!! Form::text('ao_pincode', null, array('class' => 'form-control', 'id'=>'pincode', 'placeholder'=>'Pincode','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <!-- end of fi_assetTypeOffice -->

                        <div class="row">
                            <!-- start of fi_assetTypeEquipment -->
                            <div id="fi_assetTypeEquipment" class="panel panel-success">
                                <div class="panel-heading"><h3 class="panel-title">Details Of Equipments</h3></div>
                                <div class="panel-body">
                                    <div class="row">
                                        @for($formIndex=0; $formIndex < $maxAnotherTypes; $formIndex++)

                                            <?php
                                                    
                                                $optionClass = '';

                                                if ($formIndex > 0) {

                                                    $optionClass = 'collapse';
                                                } 
                                            ?>
                                            <div id="equipOptn_{{$formIndex}}" class="panel panel-success {{$optionClass}}">
                                                <div class="panel-heading">Equipment Brief</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-8" style="padding-bottom:20px">
                                                            {!! Form::label('aeq_brief_asset_desc','Brief Asset Description') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                            {!! Form::text('equipment['.$formIndex.'][brief_asset_desc]', null, array('class' => 'form-control', 'id'=>'equip_brief_asset_desc_'.$formIndex, 'placeholder'=>'Brief Asset Description','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        </div>
                                                        <div class="col-md-2" style="padding-bottom:20px">
                                                            {!! Form::label('aeq_sel_qty_in_type','Quantity in Type') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                            {!! Form::select('equipment['.$formIndex.'][sel_qty_in_type]', ['' => '', 'number' => 'Numbers', 'weight' => 'Weight in Kgs'], null, array('class' => 'form-control', 'style' => 'width: 100%;', 'id'=>'equip_sel_qty_in_type_'.$formIndex, 'placeholder'=>'Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        </div>
                                                        <div class="col-md-2" style="padding-bottom:20px">
                                                            {!! Form::label(null,null) !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                            {!! Form::text('equipment['.$formIndex.'][txt_qty_in_type]', null, array('class' => 'form-control', 'style' =>'margin-top:7px', 'id'=>'equip_txt_qty_in_type_'.$formIndex, 'placeholder'=>'Enter Quantity','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        </div>
                                                        <div class="col-md-4" style="padding-bottom:20px">
                                                            {!! Form::label('aeq_estimated_value','Estimated Value ( ') !!}
                                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                            {!! Form::label(null,' In Lacs )') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                            {!! Form::text('equipment['.$formIndex.'][estimated_value]', null, array('class' => 'form-control', 'id'=>'equip_estimated_value_'.$formIndex, 'placeholder'=>'Estimated Value','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        </div>
                                                        <div class="col-md-4" style="padding-bottom:20px">
                                                            {!! Form::label('aeq_year_of_manf','Year of Manufacturing/Production') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                            {!! Form::text('equipment['.$formIndex.'][year_of_manf]', null, array('class' => 'form-control', 'id'=>'equip_year_of_manf_'.$formIndex, 'placeholder'=>'Year of Manufacturing/Production','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        </div>
                                                        <div class="col-md-4" style="padding-bottom:20px">
                                                            {!! Form::label('aeq_manufacturer','Manufacturer') !!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                            {!! Form::text('equipment['.$formIndex.'][manufacturer]', null, array('class' => 'form-control', 'id'=>'equip_manufacturer_'.$formIndex, 'placeholder'=>'Manufacturer','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                        {!! Form::hidden('counter_storage', 0, array('id' => 'counter_storage')) !!}
                                        {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
                                        <div class="form-group" style="padding-left: 20px;">
                                            {!! Form::button('Add Equipment Brief', ['class'=>'btn btn-primary add_promo_button', 'id'=>'equip_add_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                            {!! Form::button('Remove Equipment Brief', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'equip_rem_another_type', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                        </div>
                                    </div>    
                                </div>                                        
                            </div>
                            <!-- end of fi_assetTypeEquipment -->                            
                        </div>
                    </div>
                </div>
                <!-- extra div -->                

                        
                                    
            </div>



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

        
        $('#city').select2({
            allowClear: true,
            placeholder: "Select City"
        });

        $('#state').select2({
            allowClear: true,
            placeholder: "Select State"
        });
        

        $('#assetToBeInsured').select2({
            allowClear: true,
            placeholder: "Select Assets"
        });

        

        $('#inventoryStoredAt').select2({
            allowClear: true,
            placeholder: "Select Inventory Stored At"
        });

        //hide asset to be insured select
        // $('#goods').change(function(){
        //     $('#assetsToBeInsuredContainer').show();
        //     $('#divTab_sub1').hide();
        // });

        // $('#allrisk').change(function(){
        //     $('#assetsToBeInsuredContainer').show();
        //     if($('#assetToBeInsured').val() == 'MP'){
        //        $('#divTab_sub1').show(); 
        //     }
        // });

        //hide manufacturing options
        $('#fi_assetTypeManufacturePlant').hide();
        $('#fi_assetTypeStockInventory').hide();
        $('#fi_assetTypeOffice').hide();
        $('#fi_assetTypeEquipment').hide();
        $('#inventoryOptions').show(); 
        $('#equipmentOptions').show(); 

        $('#assetToBeInsured').change(function(){
            if ($(this).val() == 'MP') {
                
                if ($('#allrisk').is(':checked')) {
                    $('#divTab_sub1').show();   
                }
                $('#fi_assetTypeManufacturePlant').show();
                $('#fi_assetTypeStockInventory').hide();
                $('#fi_assetTypeOffice').hide(); 
                $('#fi_assetTypeEquipment').hide(); 

            } else if ($(this).val() == 'STIN') {
                
                $('#fi_assetTypeStockInventory').show();
                $('#fi_assetTypeManufacturePlant').hide();
                $('#fi_assetTypeOffice').hide();
                $('#fi_assetTypeEquipment').hide();

            } else if ($(this).val() == 'OO') {
                
                $('#fi_assetTypeOffice').show();
                $('#fi_assetTypeManufacturePlant').hide();
                $('#fi_assetTypeStockInventory').hide();
                $('#fi_assetTypeEquipment').hide();

            } else if ($(this).val() == 'EQ') {

                $('#fi_assetTypeEquipment').show();
                $('#fi_assetTypeManufacturePlant').hide();
                $('#fi_assetTypeStockInventory').hide();
                $('#fi_assetTypeOffice').hide();

            } else {

                $('#fi_assetTypeManufacturePlant').hide();
                $('#fi_assetTypeStockInventory').hide();
                $('#fi_assetTypeOffice').hide();
                $('#fi_assetTypeEquipment').hide();
            }
        });


        var equip_counter = 0; // Hidden Field inventory Counter Variable
        var equip_existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        var equip_add_button = jQuery("#equip_add_another_type");
        var equip_delete_button = jQuery("#equip_rem_another_type");
        var equip_no_of_opened_containers = $("#no_of_opened_containers").val();

        for (var i = 0; i < equip_existing_records; i++) {
            $("#equipOptn_" + i).collapse("show");
            counter = i;
            $("#equip_counter_storage").val(i);
        }

        var a = $("#equip_counter_storage").val();
        if (a > 0) {
            for (var i = 1; i <= a; i++) {
                $("#equipOptn_" + i).collapse("show");
                if (i == 4) {
                    equip_add_button.hide();
                }
                equip_counter = i;
            }
        }

        if (equip_counter == 0) {
            $(equip_delete_button).hide();
        }

        $(equip_add_button).click(function(e){
            e.preventDefault();
            equip_counter++;
            $("#equip_counter_storage").val(equip_counter);
            equip_existing_records++;
            $("#equipOptn_" + equip_counter).collapse("show");
            if (equip_counter == 3) {
                $(this).hide();
            }
            if (equip_counter > 0) {
                $(equip_delete_button).show();
            }
        });

        $(equip_delete_button).click(function (e) {
            e.preventDefault();
            $("#equipOptn_" + equip_counter).collapse("hide");
            equip_counter--;
            $("#equip_counter_storage").val(equip_counter);
            equip_existing_records--;
            if (equip_counter == 0) {
                $(equip_delete_button).hide();
            }
            if (equip_counter < 3) {
                $(equip_add_button).show();
            }
        });


        /********* Inventory Selection Addition **********/
        var inventory_type_selection_counter = 0; // Hidden Field inventory Counter Variable
        var inventory_type_selection_existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        var innventory_type_selection_add_button = jQuery("#inv_type_add");
        var innventory_type_selection_delete_button = jQuery("#inv_type_rem");
        var innventory_type_selection_no_of_opened_containers = $("#inv_type_no_of_opened_containers").val();

        for (var i = 0; i < inventory_type_selection_existing_records; i++) {
            $("#inventory_type_" + i).collapse("show");
            inventory_type_selection_counter = i;
            $("#inv_type_counter_storage").val(i);
        }

        var a = $("#inv_type_counter_storage").val();
        if (a > 0) {
            for (var i = 1; i <= a; i++) {
                $("#inventory_type_" + i).collapse("show");
                if (i == 4) {
                    innventory_type_selection_add_button.hide();
                }
                inventory_type_selection_counter = i;
            }
        }

        if (inventory_type_selection_counter == 0) {
            $(innventory_type_selection_delete_button).hide();
        }

        $(innventory_type_selection_add_button).click(function(e){
            e.preventDefault();
            inventory_type_selection_counter++;
            $("#inv_type_counter_storage").val(inventory_type_selection_counter);
            inventory_type_selection_existing_records++;
            $("#inventory_type_" + inventory_type_selection_counter).collapse("show");
            if (inventory_type_selection_counter == 9) {
                $(this).hide();
            }
            if (inventory_type_selection_counter > 0) {
                $(innventory_type_selection_delete_button).show();
            }
        });

        $(innventory_type_selection_delete_button).click(function (e) {
            e.preventDefault();
            $("#inventory_type_" + inventory_type_selection_counter).collapse("hide");
            inventory_type_selection_counter--;
            $("#inv_type_counter_storage").val(inventory_type_selection_counter);
            inventory_type_selection_existing_records--;
            if (inventory_type_selection_counter == 0) {
                $(innventory_type_selection_delete_button).hide();
            }
            if (inventory_type_selection_counter < 9) {
                $(innventory_type_selection_add_button).show();
            }
        });


        // var inv_counter = 0; // Hidden Field inventory Counter Variable
        // var inv_existing_records = {{$existingAnotherTypeCount}}; // If any existing Record in database
        // var inv_add_button = jQuery("#inventory_add_brief");
        // var inv_delete_button = jQuery("#inventory_rem_brief");
        // var inventory_brief_no_of_opened_containers = $("#inventory_brief_no_of_opened_containers").val();

        // for (var i = 0; i < inv_existing_records; i++) {
        //     $("#invOptn_" + i).collapse("show");
        //     inv_counter = i;
        //     $("#inventory_brief_counter_storage").val(i);
        // }

        // var a = $("#inv_type_counter_storage").val();
        // var b = $("#inventory_brief_counter_storage").val();

        // console.log('inv_counter-----', inv_counter);
        // console.log('inv_existing_records-----', inv_existing_records);
        // console.log('inventory_brief_no_of_opened_containers-----', inventory_brief_no_of_opened_containers);
        // console.log('inv_type_counter_storage-----', a);
        // console.log('inventory_brief_counter_storage-----', b);

        // if (a > 0 && b > 0) {

        //     for (var i = 1; i <= a; i++) {

        //         for (var j = 1; j <= b; j++) {
        //             $("#invOptn_" + i + "_" + j).collapse("show");
        //             if (j == 4) {
        //                 inv_add_button.hide();
        //             }
        //             inv_counter = j;
        //         }
        //     }
        // }

        // if (inv_counter == 0) {
        //     $(inv_delete_button).hide();
        // }

        // $(inv_add_button).click(function(e){
        //     e.preventDefault();
        //     inv_counter++;
        //     $("#inventory_brief_counter_storage").val(inv_counter);
        //     inv_existing_records++;
        //     $("#invOptn_" + inventory_type_selection_counter + "_" + inv_counter).collapse("show");
        //     if (inv_counter == 3) {
        //         $(this).hide();
        //     }
        //     if (inv_counter > 0) {
        //         $(inv_delete_button).show();
        //     }
        // });

        // $(inv_delete_button).click(function (e) {
        //     e.preventDefault();
        //     $("#invOptn_" + inventory_type_selection_counter + "_" + inv_counter).collapse("hide");
        //     inv_counter--;
        //     $("#inventory_brief_counter_storage").val(inv_counter);
        //     inv_existing_records--;
        //     if (inv_counter == 0) {
        //         $(inv_delete_button).hide();
        //     }
        //     if (inv_counter < 3) {
        //         $(inv_add_button).show();
        //     }
        // });

    });

    @for ($recordNum = 0; $recordNum < 4; $recordNum++)
        $('#sel_qty_in_type_{{{$recordNum}}}').select2({
            allowClear: true,
            placeholder: "Select Address Proof Type"
        });
    @endfor

    

    @for ($recordNum = 0; $recordNum < count($inventoryTypes) - 1; $recordNum++)
        $('#sel_inventory_type_{{{$recordNum}}}').select2({
            allowClear: true,
            placeholder: "Select Inventory Type"
        });

        $('#inventoryStoredAt_{{{$recordNum}}}').select2({
            allowClear: true,
            placeholder: "Select Option"
        });

        $('#agriCommStoreAt_{{{$recordNum}}}').hide();

        $('#sel_inventory_type_{{{$recordNum}}}').change(function(){
            if ($(this).val() == 'AC') {
               $('#agriCommStoreAt_{{{$recordNum}}}').show(); 
            } else {
               $('#agriCommStoreAt_{{{$recordNum}}}').hide();  
            }
        });

        if ($('#IBCS_{{$recordNum}}').val() == 0) {
            $('#inventory_rem_brief_{{$recordNum}}').hide();
        }

        
        $('#inventory_add_brief_{{$recordNum}}').click(function (e) {
            e.preventDefault();
            var briefCounter = $('#IBCS_{{$recordNum}}').val();
            briefCounter++;            
            $('#IBCS_{{$recordNum}}').val(briefCounter);
            // //inv_existing_records++;
            $("#invOptn_{{$recordNum}}_" + briefCounter).collapse("show");
            if (briefCounter == 3) {
                $(this).hide();
            }
            if (briefCounter > 0) {
                $('#inventory_rem_brief_{{$recordNum}}').show();
            }
        });

        $('#inventory_rem_brief_{{$recordNum}}').click(function (e) {
            e.preventDefault();
            var briefCounter = $('#IBCS_{{$recordNum}}').val();
            $("#invOptn_{{$recordNum}}_" + briefCounter).collapse("hide");
            briefCounter--;
             $('#IBCS_{{$recordNum}}').val(briefCounter);
            //inv_existing_records--;
            if (briefCounter == 0) {
                $(this).hide();
            }
            if (briefCounter < 3) {
                $('#inventory_add_brief_{{$recordNum}}').show();
            }
        });

        



    @endfor    

    $('#assets_to_be_insured_div').hide();

    $('#nextInFireInsurance').click(function () {
        var selected = $("input:radio[name=damage_covered]:checked");
        //console.log(selected.val());
        if (selected.val() != undefined && selected.val() != 'undefined') {
            $('#radioBtns').hide();
            $('#assets_to_be_insured_div').show(); 
        }
    })

</script>
@stop