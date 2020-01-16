<?php
$categoryCounter = 1;
$dimensionCounter = 1;
if($user->isBankUser()){
         $setDisable='disabled';
}
if(isset($appRej)){
    $setDisable='disabled';
}
/*if($calculatedStatus=='4'){
     $setDisable='disabled';
}*/

?>

{!! Form::hidden('ratings_id', isset($ratingModel)?$ratingModel->id:null)!!}
{!! Form::hidden('loan_id', $loanId)!!}
{!! Form::hidden('model_type', Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT'))!!}
{!! Form::hidden('status', 1)!!}
 <div class="card">
   <div class="card-header" data-background-color="green">
     <h4 class="title">Liquidity Model <span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
     {{--    <p class="category">Apply new loan</p> --}}
   </div>
   <div class="card-content">
    <div class="col-md-12 input">
    <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
        {{--Div to maintain margins--}}
        <div id="credit_model" style="padding: 5px;">
            <div class="row">
                <div class="col-md-3 in">
                    {!! Form::label('borrower_name','Borrower Name') !!}
                </div>
                <div class="col-md-3 in">
                    {!! Form::label('borrower_name', isset($userProfile)? $userProfile->name_of_firm : '&nbsp;') !!}
                </div>
            </div>
            <table class="table table-bordered">
                <div class="row">
                    <div class="col-lg-5 col-sm-3 col-xs-2">
                    </div>
                    <div class="col-lg-7 col-sm-3 col-xs-3">
                     <tr>
                         <td>
                             <div class="col-border col-md-12 col-sm-6 col-xs-3 r-align">
                             </div>
                         </td>
                         <td>
                             <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::label('category_weight','% Weight', ['class'=>'control-label']) !!}
                             </div>
                         </td>
                         <td>
                             <div class="col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::label('points','Points', ['class'=>'control-label']) !!}
                             </div>
                         </td>
                         <td>
                             <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::label('applicable','Applicable', ['class'=>'control-label']) !!}
                             </div>
                         </td>
                         <td>
                             <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::label('measure_value','Value/Factor', ['class'=>'control-label']) !!}
                             </div>
                         </td>
                         <td>
                             <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::label('applicable_points','Applicable Points', ['class'=>'control-label']) !!}
                             </div>
                         </td>
                     </tr>
                 </div>
             </div>
             <?php
             ?>
             {{--Main Content Starts here --}}
             <div class="row">
                @foreach($liquidityModelsCategoriesList as $liquidityCategory)
                {{-- @php
                    {{dd($liquidityCategory)}}
                    @endphp --}}
                    <tr style="background-color:#B8CCE4;">
                        <td>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <span><B>{{$liquidityCategory->label}}</B></span>
                            </div>
                        </td>
                        <td>
                            <div class="col-border col-md-2 col-sm-2 col-xs-2">
                                <B><span id = "category_weight_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;">{{$liquidityCategory->weight}}</span></B>
                                {!! Form::hidden('category['.$categoryCounter.'][category_weight]', $liquidityCategory->weight)!!}
                            </div>
                        </td>
                        <td>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <B><span id = "category_points_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span></B>
                            </div>
                        </td>
                        <td>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            </div>
                        </td>
                        <td>
                           <div class="col-md-1 in col-sm-12 col-xs-12">
                           </div>
                       </td>
                       <td>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <B><span id = "category_calculated_measure_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span></B>
                       </div>
                   </td>
               </tr>
               @foreach($liquidityCategory->dimensions as $creditDimension)
               <tr>
                <?php
                $categoryStyle = "";
                if(!isset($creditDimension->parent_dimension_id) || $creditDimension->dimension_type == 2){
                    $categoryStyle = "style=background-color:#BFBFBF;";
                }
                ?>
                <td class="width">
                    <div class="col-md-12 col-sm-12 col-xs-12" {{ $categoryStyle }}>
                        <div class="row">
                            <div class="col-md-10 col-sm-5 col-xs-2">
                                {!! Form::label('dimension_label',$creditDimension->label, ['class'=>'control-label']) !!}
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 col-sm-12 col-xs-12" {{ $categoryStyle }}>
                        <div class="row">
                            <div class="col-border col-md-2">
                                {!! Form::label('dimension_weight',$creditDimension->weight, ['class'=>'control-label']) !!}
                                {!! Form::hidden('category['.$categoryCounter.'][dimension][weight]', $creditDimension->weight)!!}
                            </div>
                        </div>
                    </div>
                </td>
                @if(!$creditDimension->isParent())
                <td>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][id]', $creditDimension->selected_rating_details_id) !!}
                            {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][dimension_id]', $creditDimension->id) !!}
                            {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][ratings_id]', isset($ratingModel)?$ratingModel->id:null) !!}
                            {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][status]', 1) !!}
                            <div class="col-md-12 col-sm-6 col-xs-3">
                                {!! Form::label('points', ($liquidityCategory->weight * ($creditDimension->weight / 100)), ['class'=>'control-label']) !!}
                            </div>
                        </div>
                    </div>
                </td>
                @if(isset($creditDimension->selected_measure_id))
                <td style="width: 13%;">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                       @if($dimensionCounter=='16' || $dimensionCounter=='20' || $dimensionCounter=='21')
                        {!! Form::select('liquidity_model_rating_details['.$dimensionCounter.'][is_applicable_label]', $yesNoOptions, $creditDimension->is_applicable, ['id' => 'applicable_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;border: 2px solid #9cbd31;','disabled']) !!}
                       @else
                       {!! Form::select('liquidity_model_rating_details['.$dimensionCounter.'][is_applicable_label]', $yesNoOptions, $creditDimension->is_applicable, ['id' => 'applicable_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;', 'disabled']) !!}
                       @endif
                       {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][is_applicable]', $creditDimension->is_applicable) !!}
                   </div>
               </td>
               <td style="width: 22%;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                    @if($dimensionCounter=='16' || $dimensionCounter=='20' || $dimensionCounter=='21')
                      {!! Form::select('liquidity_model_rating_details['.$dimensionCounter.'][measure_id_label]', $creditDimension->measures->lists('label', 'id')->all(), $creditDimension->selected_measure_id, ['id' => 'measureValue_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;border: 2px solid #9cbd31;','disabled']) !!}
                       @else
                      {!! Form::select('liquidity_model_rating_details['.$dimensionCounter.'][measure_id_label]', $creditDimension->measures->lists('label', 'id')->all(), $creditDimension->selected_measure_id, ['id' => 'measureValue_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;', 'disabled']) !!}
                       @endif
                    {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][measure_id]', $creditDimension->selected_measure_id) !!}
                </div>
            </td>
            @else
            <td>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::select('liquidity_model_rating_details['.$dimensionCounter.'][is_applicable]', $yesNoOptions, $creditDimension->is_applicable, ['id' => 'applicable_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}
               </div>
           </td>
                                   {{--   @if($dimensionCounter=='15')
                                     {{ 'Loan Against Share' }} 
                                     {{ $creditDimension->measures->lists('label', 'id') }}
                                     {{ $creditDimension->measures->where('id', '67')->lists('id') }}
                                     @endif --}}
                                     <td>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                         {{-- Value Factor --}}  {!! Form::select('liquidity_model_rating_details['.$dimensionCounter.'][measure_id]', $creditDimension->measures->lists('label', 'id')->toArray(), $creditDimension->selected_measure_id, ['id' => 'measureValue_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}
                                     </div>
                                 </td>
                                 @endif
                                 <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <span id = "calculated_measure_{{$dimensionCounter}}" class = "form-control-static" style = "width: 100%;"></span>
                                        {!! Form::hidden('liquidity_model_rating_details['.$dimensionCounter.'][calculated_measure]', null, ['id' => 'calculated_measure_field_'.$dimensionCounter])!!}
                                    </div>
                                </td>
                                @endif
                            </tr>
                            <?php $dimensionCounter += 1; ?>
                            @endforeach
                            <tr style="background-color:#B8CCE4;">
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        {!! Form::label('category_label','Total Score - ' . $liquidityCategory->label, ['class'=>'control-label']) !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-border col-md-12 col-sm-6 col-xs-12">
                                        <B><span id = "category_weight_label_bottom_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span></B>
                                        {!! Form::hidden('category['.$categoryCounter.'][category_weight]', '', ['id' => 'category_weight_field_'.$categoryCounter])!!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <B><span id = "category_points_label_bottom_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span></B>
                                        {!! Form::hidden('category['.$categoryCounter.'][category_points]', '', ['id' => 'category_points_field_'.$categoryCounter])!!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <B><span id = "category_calculated_measure_label_bottom_{{$categoryCounter}}" class = "form-control-static" style = "width: 100%;"></span></B>
                                        {!! Form::hidden('category['.$categoryCounter.'][category_calculated_measure]', '', ['id' => 'category_calculated_measure_field_'.$categoryCounter])!!}
                                    </div>
                                </td>
                            </tr>
                            <?php $categoryCounter += 1; ?>
                            @endforeach
                            {{-- Grand Total Row --}}
                            <tr style="background-color:#B8CCE4;">
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        {!! Form::label('grand_total_label','Grand Total', ['class'=>'control-label']) !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-border col-md-12 col-sm-6 col-xs-12">
                                        <B><span id = "grand_total_weight_label" class = "control-label" style = "width: 100%;"></span></B>
                                        {!! Form::hidden('grand_total_weight', '', ['id' => 'grand_total_weight_field'])!!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <B><span id = "grand_total_points_label" class = "control-label" style = "width: 100%;"></span></B>
                                        {!! Form::hidden('grand_total_points', '', ['id' => 'grand_total_points_field']) !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <B><span id = "grand_total_calculated_measure_label" class = "form-control-static" style = "width: 100%;"></span></B>
                                        {!! Form::hidden('final_score', isset($ratingModel)?$ratingModel->final_score:null, ['id' => 'grand_total_calculated_measure_field']) !!}
                                    </div>
                                </td>
                            </tr>
                            {{-- Ratings Row --}}
                            <tr  style="background-color:#B8CCE4;">
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3">
                                        {!! Form::label('final_rating_text_label','Our Rating', ['class'=>'control-label']) !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3" align="right">
                                        &nbsp;
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3" align="right">
                                        &nbsp;
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3" align="right">
                                        &nbsp;
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3" align="right">
                                        &nbsp;
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 col-sm-6 col-xs-3">
                                        <B><span id = "final_rating_label" class = "control-label"></span></B>
                                        {!! Form::hidden('final_rating', isset($ratingModel)?$ratingModel->final_rating:null, ['id' => 'final_rating']) !!}
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </table>
                </div>
                <br>
                <div class="form-group collapse {{ $errors->has('remark') ? 'has-error' : '' }}" id="rejectReasonDiv">
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">Reason For Rejection</div>
                            <div class="panel-body">
                                <div class="row" style="padding:10px">
                                    <div class="col-md-12">
                                        {!! $errors->first('remark','<span class="help-block">:message</span>') !!}
                                        {!!Form::textarea('remark',null, ['class'=>'form-control', 'rows' => '3'] )!!}
                                        <div class="row" style="padding:10px">
                                            {!! Form::button('Submit', ['class' => 'btn btn-success btn-cons sme_button pull-right','name'=>'rejectProposal','value'=> 'RejectProposal', 'type'=>'submit']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 " style="margin-left:20px;">
                        {!! Form::button('<i class="fa fa-reply"></i> Back', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div9', '$loanType','$endUseList', $amount, $loanTenure, $loanId); return false;", 'value'=> 'Back', 'style' => 'margin-top:3px;margin-left:20px;' )) !!}
                        {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:2px;margin-left:20px;' )) !!}
                        @if($user->isSME() || $user->isBankUser())
                        {!! Form::button('<i class="fa fa-comments"></i> Raise Query', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:4px;margin-left:20px;' )) !!}
                        @endif
                        @if(Auth::user()->isAnalyst())
                        <?php
                        $validLoanHelper = new App\Helpers\validLoanUrlhelper();
                        $isCollateralVisible = $validLoanHelper->collateralModel($loanId);
                        ?>
                        @if(isset($isCollateralVisible) && $isCollateralVisible)
                        {!! Form::button('Save & Continue', ['class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save', 'type'=>'submit']) !!}
                        @else
                        {!! Form::button('Save', ['class' => 'btn btn-success btn-cons sme_button', 'name'=>'simpleSave', 'value'=> 'Save', 'type'=>'submit']) !!}
                        {!! Form::button('Submit To Bank', ['class' => 'btn btn-success btn-cons sme_button','name'=>'submitToBank', 'value'=> 'Save', 'type'=>'submit']) !!}
                        {!! Form::button('Reject The Proposal', ['id' => 'rejectButton','class' => 'btn btn-success btn-cons sme_button']) !!}
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
       
        <script type="text/javascript">
            Number.prototype.round = function(places){
                places = Math.pow(10, places);
                return Math.round(this * places)/places;
            }
            function Measure(dimension, id, dimensionId, label, measure){
                this.dimension = dimension;
                this.id = id;
                this.dimensionId = dimensionId;
                this.label = measure;
                this.measure = measure;
            }
            Measure.prototype.recalculate = function() {
                var applicablePoints = 0;
                if(this.dimension.calculatePoints()) {
                    applicablePoints = Number(this.measure * this.dimension.getCategoryWeightedAverage());
                }
            //console.log(this.dimension.label + " - measure: " + this.measure + ", average: " + this.dimension.getCategoryWeightedAverage() + " applicablePoints: " + applicablePoints);
            return applicablePoints;
        }
        function Dimension(dimensionNum, category, id, categoryId, parentDimensionId, label, weight, isApplicable, dimensionType){
            this.dimensionNum = dimensionNum;
            this.category = category;
            this.id = id;
            this.categoryId = categoryId;
            this.parentDimensionId = Number(parentDimensionId);
            this.label = label;
            this.weight = weight;
            this.isApplicable = isApplicable;
            if(dimensionType == 1) {
                this.isParentDimension = true;
            }else{
                this.isParentDimension = false;
            }
            if(dimensionType == 2){
                this.isHybridDimension = true;
            }else{
                this.isHybridDimension = false;
            }
            this.calculatedPoints = null;
            this.measuresList = [];
            this.measureIdToMeasureMap = [];
        }
        Dimension.prototype.calculatePoints = function() {
            var applicableSelectBoxName = "#applicable_"+this.dimensionNum;
            if($( applicableSelectBoxName) && $( applicableSelectBoxName).val() == 1){
                return true;
            }else{
                return false;
            }
        }
        Dimension.prototype.getDimensionNum = function() {
            return this.dimensionNum;
        }
        Dimension.prototype.isParent = function() {
            if(this.isParentDimension){
                return true;
            }else{
                return false;
            }
        }
        Dimension.prototype.isChild = function() {
            if(this.parentDimensionId != null){
                return true;
            }else{
                return false;
            }
        }
        Dimension.prototype.isHybrid = function() {
            if(this.isHybridDimension){
                return true;
            }else{
                return false;
            }
        }
        Dimension.prototype.getParentDimensionId = function() {
            return this.parentDimensionId;
        }
        Dimension.prototype.addMeasure = function(measure) {
            if(measure.dimensionId == this.id){
                this.measuresList.push(measure);
                this.measureIdToMeasureMap[measure.id] = measure;
            }
        }
        Dimension.prototype.getCategoryWeightedAverage = function() {
            return this.category.getWeightedAverage(this);
        }
        Dimension.prototype.getWeight = function() {
            return this.weight;
        }
        Dimension.prototype.getPoints = function() {
            return (this.category.weight * (this.weight / 100 ));
        }
        Dimension.prototype.getCalculatedPoints = function() {
            return this.calculatedPoints;
        }
        Dimension.prototype.getCategory = function() {
            return this.category;
        }
        Dimension.prototype.matches = function(anotherDimension) {
           // console.log(this.label + " - " + anotherDimension.label + " ,this.isChild - " + this.isChild() + ", anotherDimension.isChild() - " + anotherDimension.isChild() + ", id - " + this.id + ", this.parentId - " + this.getParentDimensionId() + " ,anotherDimension.parentId - " + anotherDimension.getParentDimensionId() + ", this.isParentId - " + this.isParent() + " ,anotherDimension.isParent - " + anotherDimension.isParent() + ", this.isHybrid(): " + this.isHybrid() +" ,anotherDimension.isHybrid() - " + anotherDimension.isHybrid());
           if(anotherDimension.isHybrid()){
            return false;
        }
        if(this.getParentDimensionId() > 0 && anotherDimension.getParentDimensionId() == 0
         && this.getCategory().hasHybridDimension()
         ){
            return false;
    }
    if(!this.isChild() || !this.isParent()){
        return true;
    }
    return false;
}
Dimension.prototype.recalculate = function(measureId) {
    if(this.measureIdToMeasureMap[measureId] != null){
        var measure = this.measureIdToMeasureMap[measureId];
                //console.log("measureId: "+measureId+" Found Measure: " + measure.measure);
                var recalculatedPoints = measure.recalculate();
                this.calculatedPoints = recalculatedPoints;
                var roundedCalculatedPoints = recalculatedPoints.round(2);
                var calculatedMeasureFieldName = "#calculated_measure_field_"+this.dimensionNum;
                var calculatedMeasureSelectName = "#calculated_measure_"+this.dimensionNum;
                $( calculatedMeasureSelectName).text(roundedCalculatedPoints);
                $( calculatedMeasureFieldName).val(roundedCalculatedPoints);
            }
        }
        function Category(categoryNum, id, type, label, weight){
            this.categoryNum = categoryNum;
            this.id = id;
            this.type = type;
            this.label = label;
            this.weight = weight;
            this.totalCategoryWeight = null;
            this.totalCategoryPoints = null;
            this.totalCategoryCalculatedPoints = null;
            this.dimensionsList = [];
        }
        Category.prototype.addDimension = function(dimension) {
            if(dimension.categoryId == this.id){
                this.dimensionsList.push(dimension);
            }
        }
        Category.prototype.getDimensionLength = function(){
            return this.dimensionsList.length;
        }
        Category.prototype.getDimension = function(position){
            return this.dimensionsList[position];
        }
        Category.prototype.getWeightedAverage = function(targetDimension){
            var dimensionPoint = targetDimension.getPoints();
            var weightedAverage = 0;
            var applicablePointsSum = 0;
            var nonApplicablePointsSum = 0;
            for(var dimensionsIndex=0; dimensionsIndex < this.dimensionsList.length; dimensionsIndex++){
                var dimension = this.dimensionsList[dimensionsIndex];
                if(targetDimension.matches(dimension)) {
                    if (dimension.calculatePoints()) {
                        applicablePointsSum += dimension.getPoints();
                        //console.log(dimension.label + " - points - " + dimension.getPoints() + " applicablePointsSum - " + applicablePointsSum);
                    } else if(!dimension.isParent()) {
                        nonApplicablePointsSum += dimension.getPoints();
                        //console.log(dimension.label + " - points - " + dimension.getPoints() + " nonApplicablePointsSum - " + nonApplicablePointsSum);
                    }
                }
            }
            if(applicablePointsSum != 0) {
                weightedAverage = (dimensionPoint + ((dimensionPoint / applicablePointsSum) * nonApplicablePointsSum));
            }else{
                weightedAverage = dimensionPoint;
            }
            if(isNaN(weightedAverage)){
                weightedAverage = 0;
            }
           // console.log("Weighted Average for " + targetDimension.label + " - " + weightedAverage + " dimensionPoint: " + dimensionPoint+ " applicablePointsSum: " + applicablePointsSum + " nonApplicablePointsSum: " + nonApplicablePointsSum);
           return weightedAverage;
       }
       Category.prototype.recalculateAll = function() {
        for(var dimensionsIndex=0; dimensionsIndex < this.dimensionsList.length; dimensionsIndex++){
            var dimension = this.dimensionsList[dimensionsIndex];
            var measureValueSelectFieldName = "#measureValue_"+dimension.getDimensionNum();
            var measureId =  $( measureValueSelectFieldName ).val();
            if(measureId != null && measureId != "" && measureId != undefined) {
                dimension.recalculate(measureId);
            }
        }
        this.recalculateCategoryTotals();
    }
    Category.prototype.recalculateCategoryTotals = function() {
        var tempTotalCategoryWeight = 0;
        var tempTotalCategoryPoints = 0;
        var tempTotalCategoryCalculatedPoints = 0;
        for(var dimensionsIndex=0; dimensionsIndex < this.dimensionsList.length; dimensionsIndex++){
            var dimension = this.dimensionsList[dimensionsIndex];
            if(!dimension.isParent()) {
                var recalculatedPoints = dimension.getCalculatedPoints();
                tempTotalCategoryCalculatedPoints += recalculatedPoints;
                tempTotalCategoryWeight += dimension.getWeight();
                tempTotalCategoryPoints += dimension.getPoints();
            }
        }
        if(this.label == 'Promoter Strength'){
            tempTotalCategoryWeight = 100;
        }
        this.totalCategoryWeight = Math.round(tempTotalCategoryWeight);
        this.totalCategoryPoints = Math.round(tempTotalCategoryPoints);
        if(this.hasHybridDimension()){
            this.totalCategoryPoints = this.weight;
        }
        this.totalCategoryCalculatedPoints = tempTotalCategoryCalculatedPoints.round(2);
        $("#category_weight_label_bottom_"+this.categoryNum).text(this.totalCategoryWeight);
        $("#category_weight_field_"+this.categoryNum).val(this.totalCategoryWeight);
        $("#category_points_label_top_"+this.categoryNum).text(this.totalCategoryPoints);
        $("#category_points_label_bottom_"+this.categoryNum).text(this.totalCategoryPoints);
        $("#category_points_field_"+this.categoryNum).val(this.totalCategoryPoints);
        $("#category_calculated_measure_label_top_"+this.categoryNum).text(this.totalCategoryCalculatedPoints);
        $("#category_calculated_measure_label_bottom_"+this.categoryNum).text(this.totalCategoryCalculatedPoints);
        $("#category_calculated_measure_field_"+this.categoryNum).val(this.totalCategoryCalculatedPoints);
    }
    Category.prototype.getCategoryWeight = function() {
        return this.totalCategoryWeight;
    }
    Category.prototype.getCategoryPoints = function() {
        return this.totalCategoryPoints;
    }
    Category.prototype.getCategoryCalculatedPoints = function() {
        return this.totalCategoryCalculatedPoints;
    }
    Category.prototype.hasHybridDimension = function() {
        var isHybrid = false;
        for(var dimensionsIndex=0; dimensionsIndex < this.dimensionsList.length; dimensionsIndex++){
            var dimension = this.dimensionsList[dimensionsIndex];
            if(dimension.isHybrid()){
                isHybrid = true;
                break;
            }
        }
        return isHybrid;
    }
    function CreditModel() {
        this.categoriesList = [];
        this.dimensionNumToDimensionsMap = [];
    }
    CreditModel.prototype.addCategory = function(category){
        if(category == null){
            return;
        }
        this.categoriesList.push(category);
        for(var dimensionsIndex=0; dimensionsIndex < category.getDimensionLength(); dimensionsIndex++){
            var dimension = category.getDimension(dimensionsIndex);
            this.dimensionNumToDimensionsMap[dimension.dimensionNum] = dimension;
        }
    }
    CreditModel.prototype.recalculate = function(dimensionNum, chosenMeasureId){
        var dimension = null;
        if(this.dimensionNumToDimensionsMap[dimensionNum] != null){
            dimension = this.dimensionNumToDimensionsMap[dimensionNum];
            dimension.recalculate(chosenMeasureId);
            dimension.getCategory().recalculateCategoryTotals();
            dimension.getCategory().recalculateAll();
            this.recalculateRating();
        }
    }
    CreditModel.prototype.recalculateAll = function(){
        for(var categoryIndex=0; categoryIndex < this.categoriesList.length; categoryIndex++){
            var category = this.categoriesList[categoryIndex];
            category.recalculateAll();
        }
        this.recalculateRating();
    }
    CreditModel.prototype.recalculateRating = function(){
        var grandTotalCalculatedPoints = 0;
        var grandTotalWeight = 0;
        var grandTotalPoints = 0;
        var rating = "";
        for(var categoryIndex=0; categoryIndex < this.categoriesList.length; categoryIndex++){
            var category = this.categoriesList[categoryIndex];
            grandTotalWeight += category.weight;
                //console.log(category.label + " - " + category.getCategoryWeight() + " - " + grandTotalWeight);
                grandTotalPoints += category.getCategoryPoints();
                grandTotalCalculatedPoints += category.getCategoryCalculatedPoints();
                //console.log(category.label + " - " + category.getCategoryPoints() + " - " + grandTotalPoints);
            }
            grandTotalCalculatedPoints = grandTotalCalculatedPoints.round(2);
            if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("AAA+",90)}}){
                rating = "AAA+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("AAA",87)}}){
                rating = "AAA";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("AAA-",85)}}){
                rating = "AAA-";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("AA+",82)}}){
                rating = "AA+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("AA",79)}}){
                rating = "AA";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("AA-",75)}}){
                rating = "AA-";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("A+",72)}}){
                rating = "A+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("A",69)}}){
                rating = "A";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("A-",65)}}){
                rating = "A-";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("BBB+",62)}}){
                rating = "BBB+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("BBB",59)}}){
                rating = "BBB";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("BBB-",55)}}){
                rating = "BBB-";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("BB+",52)}}){
                rating = "BB+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("BB",49)}}){
                rating = "BB";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("BB-",45)}}){
                rating = "BB-";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("B+",42)}}){
                rating = "B+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("B",39)}}){
                rating = "B";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("B-",35)}}){
                rating = "B-";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("C+",32)}}){
                rating = "C+";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("C",29)}}){
                rating = "C";
            }else if(grandTotalCalculatedPoints >= {{$liquidityRatingPointsList->get("C-",25)}}){
                rating = "C-";
            }else{
                rating = "D";
            }
            $("#grand_total_weight_label").text(grandTotalWeight);
            $("#grand_total_weight_field").val(grandTotalWeight);
            $("#grand_total_points_label").text(grandTotalPoints);
            $("#grand_total_points_field").val(grandTotalPoints);
            $("#grand_total_calculated_measure_label").text(grandTotalCalculatedPoints);
            $("#grand_total_calculated_measure_field").val(grandTotalCalculatedPoints);
            $("#final_rating_label").text(rating);
            $("#final_rating").val(rating);
        }
        jQuery(document).ready(function($){
            <?php
            $categoryCounter = 1;
            $dimensionCounter = 1;
            $measureCounter = 1;
            ?>
            var creditModel = new CreditModel();
            @foreach($liquidityModelsCategoriesList as $liquidityCategory)
            var category{{$categoryCounter}} = new Category({{ $categoryCounter }}, {{ $liquidityCategory->id }}, "{{ (isset($liquidityCategory->type) && strlen($liquidityCategory->type) > 0)? $liquidityCategory->type:null }}", "{!! $liquidityCategory->label !!}", {{ $liquidityCategory->weight }});
            @foreach($liquidityCategory->dimensions as $creditDimension)
            var dimension{{$dimensionCounter}} = new Dimension({{$dimensionCounter}}, category{{$categoryCounter}}, {{$creditDimension->id}}, {{$creditDimension->category_id}}, {{ $creditDimension->parent_dimension_id or 'null'}}, "{{$creditDimension->label}}", {{$creditDimension->weight}}, {{$creditDimension->is_applicable}}, {{$creditDimension->dimension_type}});
            category{{$categoryCounter}}.addDimension(dimension{{$dimensionCounter}});
            @foreach($creditDimension->measures as $measure)
            var measure{{$measureCounter}} = new Measure(dimension{{$dimensionCounter}}, {{$measure->id}}, {{$measure->dimension_id}}, "{!! $measure->label !!}", {{$measure->measure}});
            dimension{{$dimensionCounter}}.addMeasure(measure{{$measureCounter}});
            <?php $measureCounter += 1; ?>
            @endforeach
            $( "#applicable_{{$dimensionCounter}}").change(function() {
                recalculate({{$dimensionCounter}}, $( "#measureValue_{{$dimensionCounter}}").val());
            });
            $( "#measureValue_{{$dimensionCounter}}").change(function() {
                recalculate({{$dimensionCounter}}, $( "#measureValue_{{$dimensionCounter}}").val());
            });
            <?php $dimensionCounter += 1; ?>
            @endforeach
            creditModel.addCategory(category{{$categoryCounter}});
            <?php $categoryCounter += 1; ?>
            @endforeach
            function recalculate(dimensionNum, chosenMeasureId){
                creditModel.recalculate(dimensionNum, chosenMeasureId)
            }
            creditModel.recalculateAll();
        });
        $( "#rejectButton").click(function() {
            $("#rejectReasonDiv").collapse("show");
        });
        @if( count($errors) > 0)
        $("#rejectReasonDiv").collapse("show");
        @endif
    </script>
 