<?php
$categoryCounter = 1;
$dimensionCounter = 1;
/*echo "<pre>";
print_r($ratingModel);
echo "</pre>";
echo $ratingModel->expectedSale;*/
?>

{!! Form::hidden('ratings_id', isset($ratingModel)?$ratingModel->id:null)!!}
{!! Form::hidden('loan_id', $loanId)!!}
{!! Form::hidden('model_type', Config::get('constants.CONST_ANALYST_MODEL_TYPE_COLLATERAL'))!!}
{!! Form::hidden('status', 1)!!}
<div class="card">
   <div class="card-header" data-background-color="green">
     <h4 class="title">Collatral Model :  Property 2   <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h4>

     <span></span>  {{--    <p class="category">Apply new loan</p> --}}
 </div>
 <div class="card-content">
    <div class="col-md-12">
        <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
            {{--Div to maintain margins--}}
            <div style="margin:5px 35px 5px 35px;">
                {{-- <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('borrower_name','Borrower Name') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('borrower_name', isset($userProfile)? $userProfile->name_of_firm : '&nbsp;') !!}
                    </div>
                </div> --}}

                <div class="row">

                   <div class="col-md-3">
                    
                </div> 
                <div class="col-md-4">

                     {!! Form::label('value_of_property ',' Value of Property (Rs. in Lacs)' ,['class'=>'form-label']) !!}
        
                    {!! Form::label(null,'', ['style' => '  color: red;']) !!}
                    @if(isset($ratingModel->valueOfProperty))
                    {!! Form::text('valueOfProperty', $ratingModel->valueOfProperty , array('class' => 'form-control amount ltl', 'id'=>'valueOfProperty','placeholder'=>'Value of Property',$setDisable)) !!}    
                    @else
                    {!! Form::text('valueOfProperty', null , array('class' => 'form-control amount ltl', 'id'=>'valueOfProperty','data-mandatory'=>'M','placeholder'=>'Value of Property', $setDisable)) !!}    
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('developer_funding','Assesment for Developer funding') !!}
                </div>

                <div class="col-md-6">
                    {!! Form::radio('developer_funding_type', 1, isset($ratingModel)?(($ratingModel->developer_funding_type==1?true:false)):false, ['id' => 'developer_funding_type_yes', $setDisable]) !!}
                    {!! Form::label('developer_funding_type_yes_label', 'Yes') !!}
                    {!! Form::radio('developer_funding_type', 0, isset($ratingModel)?(($ratingModel->developer_funding_type==0?true:false)):true, ['id' => 'developer_funding_type_no', $setDisable]) !!}
                    {!! Form::label('developer_funding_type_no_label', 'No') !!}
                </div>
            </div>
            {{--Main Content Starts here --}}
            <div class="row">
                {{--Header Row--}}
                <div class="row" style="padding-top:5px;">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-9">

                            </div>
                            <div class="col-border col-md-3">
                                {!! Form::label('category_weight','Weightages', ['class'=>'control-label']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-border col-md-2">
                                {!! Form::label('applicable','Applicable', ['class'=>'control-label']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('points','Final Weight', ['class'=>'control-label']) !!}
                            </div>
                            <div class="col-border col-md-5">
                                {!! Form::label('measure_value','Value/Factor', ['class'=>'control-label']) !!}
                            </div>
                            <div class="col-border col-md-2">
                                {!! Form::label('applicable_points','Score', ['class'=>'control-label']) !!}
                            </div>
                        </div>

                    </div>
                </div>

                @foreach($analystModelsCategoriesList as $category)
                {{--Category Row --}}
                <div class="row" style="padding-top:5px;background-color:#B8CCE4;">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-10">
                                <span><B>{{$category->label}}</B></span>
                            </div>
                            <div class="col-border col-md-2">
                                <B><span id = "category_weight_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;">{{$category->weight}}</span></B>
                                {!! Form::hidden('category['.$categoryCounter.'][category_weight]', $category->weight)!!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <B><span id = "category_points_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span></B>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-2">
                                        <B><span id = "category_calculated_measure_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span></B>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @foreach($category->dimensions as $dimension)
                {{--Dimension Row --}}
                <div class="row" style="padding-top:5px;">
                    <?php
                    $categoryStyle = "";
                    if(!isset($dimension->parent_dimension_id) || $dimension->dimension_type == 2){
                        $categoryStyle = "style=background-color:#BFBFBF;";
                    }

                    ?>
                    <div class="col-md-6" {{ $categoryStyle }}>
                        <div class="row">
                            <div class="col-md-10">
                                {!! Form::label('dimension_label',$dimension->label, ['class'=>'control-label']) !!}
                            </div>
                            <div class="col-border col-md-2">
                                {!! Form::label('dimension_weight',$dimension->weight, ['class'=>'control-label']) !!}
                                {!! Form::hidden('category['.$categoryCounter.'][dimension][weight]', $dimension->weight)!!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if(!$dimension->isParent())
                        <div class="row">
                            {!! Form::hidden('analyst_model_rating_details['.$dimensionCounter.'][id]', $dimension->selected_rating_details_id) !!}
                            {!! Form::hidden('analyst_model_rating_details['.$dimensionCounter.'][dimension_id]', $dimension->id) !!}
                            {!! Form::hidden('analyst_model_rating_details['.$dimensionCounter.'][ratings_id]', isset($ratingModel)?$ratingModel->id:null) !!}
                            {!! Form::hidden('analyst_model_rating_details['.$dimensionCounter.'][status]', 1) !!}

                            <div class="col-md-3">
                                {!! Form::select('analyst_model_rating_details['.$dimensionCounter.'][is_applicable]', $yesNoOptions, $dimension->is_applicable, ['id' => 'applicable_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;', $setDisable]) !!}
                            </div>
                            <div class="col-md-2">
                                <span id = "final_weight_{{$dimensionCounter}}" class = "form-control-static" style = "width: 100%;"></span>
{{--
                                            {!! Form::label('final_weight', ($category->weight * ($dimension->weight / 100)), ['class'=>'control-label']) !!}
                                            --}}
                                        </div>
                                        <div class="col-md-5">
                                            {!! Form::select('analyst_model_rating_details['.$dimensionCounter.'][measure_id]', $dimension->measures->lists('label', 'id')->all(), $dimension->selected_measure_id, ['id' => 'measureValue_'.$dimensionCounter, 'class' => 'form-control', 'style' => 'width: 100%;', $setDisable]) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <span id = "calculated_measure_{{$dimensionCounter}}" class = "form-control-static" style = "width: 100%;"></span>
                                            {!! Form::hidden('analyst_model_rating_details['.$dimensionCounter.'][calculated_measure]', null, ['id' => 'calculated_measure_field_'.$dimensionCounter])!!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <?php $dimensionCounter += 1; ?>
                            @endforeach

                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                </div>
                            </div>
                            <?php $categoryCounter += 1; ?>
                            @endforeach

                            {{-- Grand Total Row --}}

                            <div class="row" style="padding-top:5px;background-color:#B8CCE4;">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {!! Form::label('grand_total_label','Total Score', ['class'=>'control-label']) !!}
                                        </div>
                                        <div class="col-border col-md-2">
                                            <B><span id = "grand_total_weight_label" class = "control-label" style = "width: 100%;"></span></B>
                                            {!! Form::hidden('grand_total_weight', '', ['id' => 'grand_total_weight_field'])!!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">

                                                </div>
                                                <div class="col-md-2">
                                                    <B><span id = "grand_total_points_label" class = "control-label" style = "width: 100%;"></span></B>
                                                    {!! Form::hidden('grand_total_points', '', ['id' => 'grand_total_points_field']) !!}
                                                </div>
                                                <div class="col-md-5">
                                                </div>
                                                <div class="col-md-2">
                                                    <B><span id = "grand_total_calculated_measure_label" class = "form-control-static" style = "width: 100%;"></span></B>
                                                    {!! Form::hidden('final_score', isset($ratingModel)?$ratingModel->final_score:null, ['id' => 'grand_total_calculated_measure_field']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <BR>
                            </div>
                            {{-- Defects Row --}}
                            <div class="row" style="padding-top:5px;">
                                <div class="col-md-2">
                                    {!! Form::label('any_defect_label','Any Defect', ['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::radio('has_defect', 1, isset($ratingModel)?(($ratingModel->has_defect==1?true:false)):false, ['id' => 'any_defect_yes', $setDisable]) !!}
                                    {!! Form::label('has_defect_label_yes', 'Yes', ['class'=>'control-label']) !!}
                                    {!! Form::radio('has_defect', 0, isset($ratingModel)?(($ratingModel->has_defect==0?true:false)):true, ['id' => 'any_defect_no', $setDisable]) !!}
                                    {!! Form::label('has_defect_label_no', 'No', ['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-8 collapse" id="defectTypeDiv">
                                    <div class="row">
                                        <div class="col-md-4">
                                            {!! Form::label('defect_type_label','Type of Defect', ['class'=>'control-label']) !!}
                                        </div>
                                        <div class="col-md-8">
                                            {!! Form::select('defect_type_id', $defectTypes->lists('name', 'id')->all(), isset($ratingModel)?$ratingModel->defect_type_id:null, ['id' => 'defect_type', 'class' => 'form-control', $setDisable]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <br>
                            </div>
                            <div class="row" style="padding-top:5px;background-color:#B8CCE4;">
                                <div class="col-md-2">
                                    {!! Form::label('final_haircut','Final Haircut', ['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-2">
                                    <B><span id = "final_haircut_label" class = "control-label"></span></B>
                                    {!! Form::hidden('final_haircut', '', ['id' => 'final_haircut']) !!}

                                </div>
                                <div class="col-md-7">&nbsp;</div>
                            </div>

                            <div class="row" style="padding-top:5px;background-color:#B8CCE4;">
                                <div class="col-md-4">
                                    {!! Form::label('expectedSalelb','Expected Sale Value of property', ['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-4">
                                     <B><span id = "expectedSaleLabel" class = "control-label">{{ isset($ratingModel->expectedSale) ? $ratingModel->expectedSale : null }}</span></B>
                                    {!! Form::hidden('expectedSale', '', ['id' => 'expectedSale']) !!}

                                </div>
                                <div class="col-md-7">&nbsp;</div>
                            </div>
                        </div>
                    </div>
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
                     <div class="col-md-12"  >
                    @if(Auth::user()->isSMENiwasEmployee())
                    {!! Form::button('Calculate  Expected Sale', ['class' => 'btn btn-success btn-cons sme_button','onclick'=>'calculateSale()'  ]) !!}
                    {{--  {!! Form::button('Reject The Proposal', ['id' => 'rejectButton','class' => 'btn btn-success btn-cons sme_button']) !!} --}}
                    @endif
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::button('<i class="fa fa-reply"></i> First Property', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div11', '$loanType','$endUseList', $amount, $loanTenure, $loanId); return false;", 'value'=> 'Back', 'style' => 'margin-top:3px;' )) !!}
                        @if(Auth::user()->isSMENiwasEmployee())
                        {!! Form::button('Add Property', ['class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save', 'type'=>'submit','style' => 'margin-top:3px;' ]) !!}
                        {{--  {!! Form::button('Reject The Proposal', ['id' => 'rejectButton','class' => 'btn btn-success btn-cons sme_button']) !!} --}}
                         {!! Form::button('Submit to Bank', ['class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save', 'type'=>'submit','style' => 'margin-top:3px;' ]) !!}
                         {!! Form::button('Reject The Proposal', ['id' => 'rejectButton','class' => 'btn btn-success btn-cons sme_button']) !!}
                       
                        @endif

                    </div>
                </div>
            </div>

            <script type="text/javascript">
                var roundingPrecision = 1;
                var defectTypeOptionValues = <?php echo json_encode($defectTypes->lists('value', 'id')->all()); ?>;

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

                    return applicablePoints;
                }

                Measure.prototype.getCategoryWeightedAverage = function() {
                    if(this.dimension.calculatePoints()) {
                        return this.dimension.getCategoryWeightedAverage();
                    }else{
                        return 0;
                    }
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
                    if(this.parentDimensionId != null && Number(this.parentDimensionId) > 0){
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

                Dimension.prototype.getParentDimension = function(){
                    var parentDimension = null;
                    if(this.isChild()){
                        for(var dimensionsIndex=0; dimensionsIndex < this.category.dimensionsList.length; dimensionsIndex++){
                            var dimension = this.category.dimensionsList[dimensionsIndex];
                            if(dimension.id == this.parentDimensionId){
                                parentDimension = dimension;
                                break;
                            }
                        }
                    }

                    return parentDimension;
                }

                Dimension.prototype.matches = function(anotherDimension) {
           // console.log(this.label + " - " + anotherDimension.label + " ,this.isChild - " + this.isChild() + ", anotherDimension.isChild() - " + anotherDimension.isChild() + ", id - " + this.id + ", anotherDimension id - " + anotherDimension.id + " ,anotherDimension.parent - " + anotherDimension.getParentDimensionId() + " ,anotherDimension.isHybrid() - " + anotherDimension.isHybrid());

           if(this.isChild()){
            if(this.parentDimensionId == anotherDimension.parentDimensionId && this.calculatePoints()){
                return true;
            }else{
                return false;
            }
        }

        if(anotherDimension.isHybrid() || anotherDimension.isChild()){
            return false;
        }

        if(anotherDimension.calculatePoints() || anotherDimension.isParent()) {
            return true;
        }else {
            return false;
        }
    }

    Dimension.prototype.recalculate = function(measureId) {
        if(this.measureIdToMeasureMap[measureId] != null){
            var measure = this.measureIdToMeasureMap[measureId];
                //console.log("measureId: "+measureId+" Found Measure: " + measure.measure);
                var recalculatedPoints = measure.recalculate();
                this.calculatedPoints = recalculatedPoints;
                var roundedCalculatedPoints = recalculatedPoints.round(roundingPrecision);

                var finalWeight = measure.getCategoryWeightedAverage().round(roundingPrecision);
                var calculatedFinalWeight = "#final_weight_"+this.dimensionNum;
                var calculatedMeasureFieldName = "#calculated_measure_field_"+this.dimensionNum;
                var calculatedMeasureSelectName = "#calculated_measure_"+this.dimensionNum;
                $( calculatedFinalWeight).text(finalWeight);
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

                if(targetDimension.matches(dimension) && (dimension.isParent() || dimension.calculatePoints())) {
                    applicablePointsSum += dimension.getPoints();
                    //console.log("Weighted Average for " + dimension.label + " - " + dimension.getPoints() + " - " + applicablePointsSum);
                }
            }

            if(targetDimension.isChild()){
                weightedAverage = (100 / applicablePointsSum * (targetDimension.weight/100)) * this.getWeightedAverage(targetDimension.getParentDimension());
               // console.log("Weighted Average: " + targetDimension.label + " weightedAvg: " + weightedAverage + " - " + this.getWeightedAverage(targetDimension.getParentDimension()));
           }else{
            weightedAverage = (dimensionPoint/applicablePointsSum)*100;
        }
        if(isNaN(weightedAverage)){
            weightedAverage = 0;
        }
            //console.log("Weighted Average for " + targetDimension.label + " - " + weightedAverage + " dimensionPoint: " + dimensionPoint+ " applicablePointsSum: " + applicablePointsSum);
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
                if(!dimension.isParent() && dimension.calculatePoints()) {
                    var recalculatedPoints = dimension.getCalculatedPoints();
                    tempTotalCategoryCalculatedPoints += recalculatedPoints;
                    tempTotalCategoryWeight += dimension.getWeight();
                    tempTotalCategoryPoints += this.getWeightedAverage(dimension);
                    //console.log(dimension.label + " WA - " + dimension.getCalculatedPoints() + " - " + tempTotalCategoryPoints);
                }
            }

            this.totalCategoryWeight = Math.round(tempTotalCategoryWeight);
            this.totalCategoryPoints = Math.round(tempTotalCategoryPoints);
            this.totalCategoryCalculatedPoints = tempTotalCategoryCalculatedPoints.round(roundingPrecision);
           // console.log("category: "+ this.label + ", recalculated category total points: " + tempTotalCategoryCalculatedPoints);
        /*
            $("#category_weight_label_bottom_"+this.categoryNum).text(this.totalCategoryWeight);
            $("#category_weight_field_"+this.categoryNum).val(this.totalCategoryWeight);

            $("#category_points_label_top_"+this.categoryNum).text(this.totalCategoryPoints);
            $("#category_points_label_bottom_"+this.categoryNum).text(this.totalCategoryPoints);
            $("#category_points_field_"+this.categoryNum).val(this.totalCategoryPoints);

            $("#category_calculated_measure_label_top_"+this.categoryNum).text(this.totalCategoryCalculatedPoints);

            $("#category_calculated_measure_label_bottom_"+this.categoryNum).text(this.totalCategoryCalculatedPoints);
            $("#category_calculated_measure_field_"+this.categoryNum).val(this.totalCategoryCalculatedPoints);
            */

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

            if($("#any_defect_yes").is(":checked")){
                $("#defectTypeDiv").show();
            }

            if($("#any_defect_no").is(":checked")){
                $("#defectTypeDiv").hide();
            }

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
            }

            var grandTotalCalculatedPoints = grandTotalCalculatedPoints.round(roundingPrecision);

                // body...

                $("#grand_total_points_label").text(grandTotalPoints);
                $("#grand_total_points_field").val(grandTotalPoints);

                $("#grand_total_calculated_measure_label").text(grandTotalCalculatedPoints);
                $("#grand_total_calculated_measure_field").val(grandTotalCalculatedPoints);

                var isAnyDefectYes = $("#any_defect_yes").is(":checked");
                var defectTypeChosenId = $("#defect_type").val();
                var defectType = Number(defectTypeOptionValues[defectTypeChosenId]);
                var finalHaircut = 0;
                if(isAnyDefectYes){
                    finalHaircut = (100 - (grandTotalCalculatedPoints * (1 - defectType)));
                }else{
                    finalHaircut = (100 - grandTotalCalculatedPoints);
                }
                finalHaircut = finalHaircut.round(2);

                $("#final_haircut_label").text(finalHaircut);
                $("#final_haircut").val(finalHaircut);
                
            }


            $('#valueOfProperty').keyup(function() {
                var valueOfProperty=$(this).val();
                var grandTotal=$('#grand_total_calculated_measure_field').val();
                var finalVal=((valueOfProperty * grandTotal) /100);
                $("#expectedSale").text(finalVal);
                $("#expectedSaleLabel").text(finalVal);
            });
            function calculateSale(){
                var valueOfProperty=$('#valueOfProperty').val();
                var grandTotal=$('#grand_total_calculated_measure_field').val();
                var finalVal=((valueOfProperty * grandTotal) /100);
                $("#expectedSale").val(finalVal);
                $("#expectedSaleLabel").text(finalVal);
            }
            $( document ).ready(function() {

              <?php
              $categoryCounter = 1;
              $dimensionCounter = 1;
              $measureCounter = 1;
              ?>
              var creditModel = new CreditModel();
              @foreach($analystModelsCategoriesList as $category)
              var category{{$categoryCounter}} = new Category({{ $categoryCounter }}, {{ $category->id }}, "{{ (isset($category->type) && strlen($category->type) > 0)? $category->type:null }}", "{!! $category->label !!}", {{ $category->weight }});
              @foreach($category->dimensions as $dimension)
              var dimension{{$dimensionCounter}} = new Dimension({{$dimensionCounter}}, category{{$categoryCounter}}, {{$dimension->id}}, {{$dimension->category_id}}, {{ $dimension->parent_dimension_id or 'null'}}, "{{$dimension->label}}", {{$dimension->weight}}, {{$dimension->is_applicable}}, {{$dimension->dimension_type}});
              category{{$categoryCounter}}.addDimension(dimension{{$dimensionCounter}});
              @foreach($dimension->measures as $measure)
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

            $("#developer_funding_type_yes").click(function(){
                $("#applicable_7").val(1);
                $("#applicable_8").val(0);
                $("#applicable_9").val(0);
                recalculate(7,  $( "#measureValue_7").val());
                recalculate(8,  $( "#measureValue_8").val());
                recalculate(9,  $( "#measureValue_9").val());

            });

            $("#developer_funding_type_no").click(function(){
                $("#applicable_7").val(0);
                $("#applicable_8").val(1);
                $("#applicable_9").val(1);
                recalculate(7,  $( "#measureValue_7").val());
                recalculate(8,  $( "#measureValue_8").val());
                recalculate(9,  $( "#measureValue_9").val());
            });

            $( "#any_defect_yes").change(function() {
                creditModel.recalculateAll();
            });
            $( "#any_defect_no").change(function() {
                creditModel.recalculateAll();
            });

            $( "#defect_type").change(function() {
                creditModel.recalculateAll();
            });

            $( "#rejectButton").click(function() {
               $("#rejectReasonDiv").collapse("show");
           });

            @if( count($errors) > 0)
            $("#rejectReasonDiv").collapse("show");
            @endif
        });
            window.onload = function () {
                if (! localStorage.justOnce) {
                    localStorage.setItem("justOnce", "true");
                    window.location.reload();
                }
            }
        </script>
