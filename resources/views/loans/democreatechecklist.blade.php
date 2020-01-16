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
  padding: 5px 0px 5px 11px !important;
  font-weight: bold;
}
.form-group.is-empty {
  width: 100%;
}
</style>

<section>
<section>
<div class="container-fluid">
 <div class="row">
   <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">Checklist<span class="pull-right"> {{ @$userProfileFirm->name_of_firm }}</span></h4>
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
                      <br>
                      <table class="table"  border="solid">
                        <thead class="thead-dark">
                          <tr>
                            <th><strong>NAME</strong></th>
                            <th><strong>APPLICABLE</strong></th>
                            <th><strong>ORIGNAL RECEIVED</strong></th>
                            <th><strong>SCANNED COPY</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                            <th><strong>ATTACHMENT</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                          <td>{!! Form::label('moa','MOA') !!}</td>
                          <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>
                        <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>

                        <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>

                     <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>
                        <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>
                        {{-- <td>
                            <button onclick="myFunction()">Upload File</button>
                       </td> --}}

                     </tr>
                      <tr>
                          <td>{!! Form::label('cor','COR') !!}</td>
                          <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>
                        <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>

                        <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>

                     <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>
                        <td>
                          
                                  <lable class="custom-radio">
                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                
                                  {!! Form::label('is_collateral_property', 'Yes') !!}
                                 </lable>
          
                                 <lable class="custom-radio">
                                 {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','enabled' => 'enabled','class'=>'securityColl-input radio']) !!}
                                 {!! Form::label('is_collateral_property', 'No') !!}
                                 </lable>
                       </td>
                        {{-- <td>
                            <button onclick="myFunction()">Upload File</button>
                       </td> --}}

                     </tr>

                    <tr>
                      <td>PAN</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('pancompany1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'pancomp1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('pancompany1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'pancomp1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('pancompany2','yes'  ,@$praposalChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'pancompany2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('pancompany2','no' ,@$praposalChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'pancompany2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('pancompany3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'pancompany3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('pancompany3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'pancompany3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('pancompany4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'pancompany4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('pancompany4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'pancompany4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('pancompany5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'pancompany5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('pancompany5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'pancompany5_no']) !!}
                           No
                         </label>
                       </td>
                        
                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Shop Certificate</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('shopcert1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'shopcert1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('shopcert1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'shopcert1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('shopcert2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'shopcert2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('shopcert2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'shopcert2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('shopcert3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'shopcert3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('shopcert3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'shopcert3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('shopcert4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'shopcert4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('shopcert4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'shopcert4_no']) !!}
                           No
                         </label>
                       </td>
                       <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('shopcert5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'shopcert5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('shopcert5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'shopcert5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>GST Certificate</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('gstcert1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'gstcert1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('gstcert1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'gstcert1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('gstcert2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'gstcert2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('gstcert2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'gstcert2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('gstcert3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'gstcert3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('gstcert3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'gstcert3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('gstcert4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'gstcert4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('gstcert4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'gstcert4_no']) !!}
                           No
                         </label>
                       </td>
                          <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('gstcert5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'gstcert5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('gstcert5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'gstcert5_no']) !!}
                           No
                         </label>
                       </td>
                      
                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Board resolution</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres5_no']) !!}
                           No
                         </label>
                       </td>

                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Ghumasta Licence</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres5_no']) !!}
                           No
                         </label>
                       </td>

                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Rent Agreement</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres5_no']) !!}
                           No
                         </label>
                       </td>

                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Udyog Aadhar</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres5_no']) !!}
                           No
                         </label>
                       </td>

                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Electricity Bill</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres5_no']) !!}
                           No
                         </label>
                       </td>

                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>Cibil of Entity</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres5_no']) !!}
                           No
                         </label>
                       </td>

                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td height="50px;">Others</td>
                      <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                       <td colspan="2">
                         {!! Form::textarea('remark',@$createChecklist->threeYearsFinancials == 'no' , array('class' => 'form-control','id'=>'remark', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
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
                <div class="row">
          <div class="col-md-12" style="margin-left:20px;">
            <div id="currentSection">

             <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
             <a href="{{ URL::previous() }}" class="btn btn-default">Next</a>
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
                            <th><strong>ORIGNAL RECEIVED</strong></th>
                            <th><strong>SCANNED COPY</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                            <th><strong>ATTACHMENT</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                          <td> PAN</td>
                          <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('panofdirector1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'panofdirector1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('panofdirector1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'panofdirector1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('panofdirector2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'panofdirector2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('panofdirector2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'panofdirector2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('panofdirector3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'panofdirector1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('panofdirector3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'panofdirector1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('panofdirector4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'panofdirector4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('panofdirector4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'panofdirector4_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('panofdirector5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'panofdirector5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('panofdirector5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'panofdirector5_no']) !!}
                           No
                         </label>
                       </td>
                        <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->

                     </tr>
                     <tr>
                      <td> Address Proof</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('addressproof1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('addressproof1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'addressproof1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('addressproof2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('addressproof2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'addressproof2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('addressproof3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('addressproof3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'addressproof3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('addressproof4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('addressproof4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'addressproof4_no']) !!}
                           No
                         </label>
                       </td>
                         <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('addressproof5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'addressproof5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('addressproof5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'addressproof5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> Networth Certificate</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('networthcert1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'networthcert1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('networthcert1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'networthcert1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('networthcert2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'networthcert2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('networthcert2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'networthcert2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('networthcert3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'networthcert3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('networthcert3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'networthcert3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('networthcert4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'networthcert4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('networthcert4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'networthcert4_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('networthcert5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'networthcert5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('networthcert5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'networthcert5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>CIBIL of promoter </td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('cibil1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'cibil1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('cibil1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'cibil1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('cibil2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'cibil2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('cibil2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'cibil2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('cibil3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'cibil3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('cibil3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'cibil3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('cibil4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'cibil4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('cibil4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'cibil4_no']) !!}
                           No
                         </label>
                       </td>
                             <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('cibil5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'cibil5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('cibil5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'cibil5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                     <tr>
                      <td height="50px;">Others</td>
                      <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                       <td colspan="2">
                         {!! Form::textarea('remark',@$createChecklist->threeYearsFinancials == 'no' , array('class' => 'form-control','id'=>'remark', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
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
                            <th><strong>ORIGNAL RECEIVED</strong></th>
                            <th><strong>SCANNED COPY</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                            <th><strong>ATTACHMENT</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                          <td> Accepted Termsheet</td>
                          <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('acceptedtermsheet1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('acceptedtermsheet1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('acceptedtermsheet2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('acceptedtermsheet2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('acceptedtermsheet3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('acceptedtermsheet3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('acceptedtermsheet4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('acceptedtermsheet4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet4_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('acceptedtermsheet5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('acceptedtermsheet5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'acceptedtermsheet5_no']) !!}
                           No
                         </label>
                       </td>
                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->

                     </tr>
                     <tr>
                      <td> Loan Agreement</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('loanagreement1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('loanagreement1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('loanagreement2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('loanagreement2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('loanagreement3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('loanagreement3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('loanagreement4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('loanagreement4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement4_no']) !!}
                           No
                         </label>
                       </td>
                           <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('loanagreement5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'loanagreement5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('loanagreement5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'loanagreement5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> Personal Guarantee</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('personalguarantee1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('personalguarantee1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('personalguarantee2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('personalguarantee2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('personalguarantee3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('personalguarantee3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('personalguarantee4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('personalguarantee4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee4_no']) !!}
                           No
                         </label>
                       </td>
                                <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('personalguarantee5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'personalguarantee5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('personalguarantee5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'personalguarantee5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> Signature Verification</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('sign1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'sign1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('sign1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'sign1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('sign2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'sign2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('sign2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'sign2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('sign3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'sign3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('sign3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'sign3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('sign4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'sign4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('sign4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'sign4_no']) !!}
                           No
                         </label>
                       </td>
                              <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('sign5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'sign5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('sign5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'sign5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>DPN </td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('dop1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'dop1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('dop1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'dop1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('dop2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'dop2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('dop2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'dop2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('dop3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'dop3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('dop3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'dop3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('dop4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'dop4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('dop4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'dop4_no']) !!}
                           No
                         </label>
                       </td>
                                 <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('dop5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'dop5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('dop5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'dop5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                     <tr>
                      <td height="50px;">Others</td>
                      <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('boardres1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'boardres1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('boardres1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'boardres1_no']) !!}
                           No
                         </label>
                       </td>
                       <td colspan="2">
                         {!! Form::textarea('remark',@$createChecklist->threeYearsFinancials == 'no' , array('class' => 'form-control','id'=>'remark', 'placeholder'=>'Remarks' ,'data-mandatory'=>'M', 'style' => 'height:100px;')) !!}
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
                            <th><strong>APPLICABLE</strong></th>
                            <th><strong>ORIGNAL RECEIVED</strong></th>
                            <th><strong>SCANNED COPY</strong></th>
                            <th><strong>DISCREPANCIES</strong></th>
                            <th><strong>ATTACHMENT</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                          <td> Mortgage Document</td>
                          <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('mortgagedocument1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('mortgagedocument1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('mortgagedocument2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('mortgagedocument2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument2_no']) !!}
                           No
                         </label>
                       </td>
                              <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('mortgagedocument3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('mortgagedocument3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument3_no']) !!}
                           No
                         </label>
                       </td>
                              <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('mortgagedocument4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('mortgagedocument5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument4_no']) !!}
                           No
                         </label>
                       </td>
                              <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('mortgagedocument5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'mortgagedocument5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('mortgagedocument5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'mortgagedocument5_no']) !!}
                           No
                         </label>
                       </td>




                       <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->

                     </tr>
                     <tr>
                      <td> Hypothication Agreement</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('hypothicationagreement1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('hypothicationagreement1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('hypothicationagreement2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('hypothicationagreement2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement2']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('hypothicationagreement3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('hypothicationagreement3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('hypothicationagreement4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement4_no']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('hypothicationagreement4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement4_no']) !!}
                           No
                         </label>
                       </td>
                            <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('hypothicationagreement5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'hypothicationagreement5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('hypothicationagreement5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'hypothicationagreement5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> Escrow Agreement</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('escrowagreement1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('escrowagreement1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('escrowagreement2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('escrowagreement2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('escrowagreement3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('escrowagreement3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('escrowagreement4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('escrowagreement4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement4_no']) !!}
                           No
                         </label>
                       </td>
                               <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('escrowagreement5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'escrowagreement5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('escrowagreement5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'escrowagreement5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> NACH Agreement</td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('nachagreement1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('nachagreement1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('nachagreement2','yes'  ,@$praposalChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('nachagreement2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('nachagreement3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('nachagreement3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('nachagreement4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('nachagreement4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement4_no']) !!}
                           No
                         </label>
                       </td>
                                   <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('nachagreement5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'nachagreement5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('nachagreement5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'nachagreement5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                           <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> Interest PDCs </td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('interestPDC1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'interestPDC1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('interestPDC1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'interestPDC1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('interestPDC2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'interestPDC2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('interestPDC2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'interestPDC2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('interestPDC3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'interestPDC3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('interestPDC3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'interestPDC3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('interestPDC4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'interestPDC4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('interestPDC4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'interestPDC4_no']) !!}
                           No
                         </label>
                       </td>
                                 <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('interestPDC5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'interestPDC5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('interestPDC5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'interestPDC5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> Principal PDCs </td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('principalPDC1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'principalPDC1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('principalPDC1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'principalPDC1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('principalPDC2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'principalPDC2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('principalPDC2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'principalPDC2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('principalPDC3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'principalPDC3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('principalPDC3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'principalPDC3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('principalPDC4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'principalPDC4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('principalPDC4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'principalPDC4_no']) !!}
                           No
                         </label>
                       </td>
                                 <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('principalPDC5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'principalPDC5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('principalPDC5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'principalPDC5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td> UDCs </td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('udc1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'udc1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('udc1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'udc1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('udc2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'udc2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('udc2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'udc2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('udc3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'udc3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('udc3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'udc3_no']) !!}
                           No
                         </label>
                       </td>
                              <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('udc4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'udc4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('udc4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'udc4_no']) !!}
                           No
                         </label>
                       </td>
                              <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('udc5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'udc5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('udc5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'udc5_no']) !!}
                           No
                         </label>
                       </td>
              
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
                    </tr>
                    <tr>
                      <td>PDC Covering Letter </td><td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('PDC1','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'PDC1_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('PDC1','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'PDC1_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('PDC2','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'PDC2_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('PDC2','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'PDC2_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('PDC3','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'PDC3_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('PDC3','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'PDC3_no']) !!}
                           No
                         </label>
                       </td>
                        <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('PDC4','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'PDC4_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('PDC4','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'PDC4_no']) !!}
                           No
                         </label>
                       </td>
                                 <td>
                           <label class="checkbox-inline">
                            {!! Form::checkbox('PDC5','yes'  ,@$createChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'PDC5_yes']) !!}
                            Yes
                          </label>
                          <label class="checkbox-inline">
                           {!! Form::checkbox('PDC5','no' ,@$createChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'PDC5_no']) !!}
                           No
                         </label>
                       </td>
                      <!--<td>
                            <button onclick="myFunction()">Upload File</button>
                       </td>-->
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
  @stop