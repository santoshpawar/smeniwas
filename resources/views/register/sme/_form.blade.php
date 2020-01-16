<div>
    <div class="containerWrapper spacingTB">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="Index.html">Home</a></li>
                <li class="current">Register</li>
            </ul>
        </div>
    </div>
    <div class="containerWrapper">
        <div class="container">
            <div>
                <div id="divMenuNavg">
                    <div id="divTabs">
                        <ul class="tabs" style="padding-top: 5px;">
                            <li id="divTab-Div1" class="current"><a id="lnkLoanDtls" class="current" href="#"><span class="text">Registration</span></a> </li>
                            <li id="divTab-Div2" class="current"><a id="lnkLoanDtls" class="current" href="#"><span class="text">SME Details</span></a> </li>
                            <li id="divTab-Div3"><a id="lnkAppDtls" href="#"><span class="text">Promoter/Owner Details</span></a></li>
                            <li id="divTab-Div4"><a id="lnkFinancial" href="#"><span class="text">PAN/TAN Other Details</span></a> </li>
                            <li id="divTab-Div5" class="last"><a id="lnkBanking" href="#"><span class="text">Subsidiary Details </span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="leftSection">
                    <div id="divTabsContent">
                        <div class="form">
                            <div class="fieldSection">
                                <div class="alert alert-danger">
                                    @if ($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                            </div>
                            {!! Form::hidden('divTab-Div1-show',array_flatten($divTabs)[0], array('id' => 'divTab-Div1-show')) !!}
                            {!! Form::hidden('divTab-Div2-show',array_flatten($divTabs)[1], array('id' => 'divTab-Div2-show')) !!}
                            {!! Form::hidden('divTab-Div3-show',array_flatten($divTabs)[2], array('id' => 'divTab-Div3-show')) !!}
                            {!! Form::hidden('divTab-Div4-show',array_flatten($divTabs)[3], array('id' => 'divTab-Div4-show')) !!}
                            {!! Form::hidden('divTab-Div5-show',array_flatten($divTabs)[4], array('id' => 'divTab-Div5-show')) !!}

                            @if (array_flatten($divTabs)[0] == "1")
                              <div id="divTC-Div1">
                            @else
                              <div id="divTC-Div1" style="display: none;">
                            @endif

                                  <div class="form-group">
                                      {!! Form::label('username','User ID (PAN of Company) *') !!}
                                      {!! Form::text('username',null,['class' => 'form-control']) !!}

                                      {!! Form::label('email','Email *') !!}
                                      {!! Form::email('email',null,['class' => 'form-control']) !!}

                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('password','Password *') !!}
                                      {!! Form::password('password',null,['class' => 'form-control']) !!}

                                      {!! Form::label('password_confirmation','Confirm Password *') !!}
                                      {!! Form::password('password_confirmation',null,['class' => 'form-control']) !!}
                                  </div>

                                  <div class="form-group">
                                      {!! Form::submit('Save & Continue', ['class' => 'inputBtn']) !!}
                                  </div>
                              </div>

                            @if (array_flatten($divTabs)[1] == "1")
                             <div id="divTC-Div2">
                            @else
                             <div id="divTC-Div2" style="display: none;">
                            @endif
                              <div class="form-group">
                               {!! Form::label('entity_type','Type of Entity *') !!}
                               {!! Form::select('entity_type',$entityTypes,['class' => 'form-control']) !!}

                               {!! Form::label('business_nature','Nature of Business *') !!}
                               {!! Form::select('business_nature',$businessNature,['class' => 'form-control']) !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label('industry_type','Type of Industry *') !!}
                                {!! Form::select('industry_type',$industryType,['class' => 'form-control']) !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label('business_details','Brief Details of Business *') !!}
                                {!! Form::textarea('business_details',null,['class' => 'form-control']) !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label(null,'Registered Address *') !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label('address1','Address 1 *') !!}
                                {!! Form::text('address1',null,['class' => 'form-control']) !!}

                                {!! Form::label('address2','Address 2') !!}
                                {!! Form::text('address2',null,['class' => 'form-control']) !!}

                                {!! Form::label('address3','Address 3') !!}
                                {!! Form::text('address3',null,['class' => 'form-control']) !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label('city','City *') !!}
                                {!! Form::text('city',null,['class' => 'form-control']) !!}


                                {!! Form::label('state','State *') !!}
                                {!! Form::select('state',$states,['class' => 'form-control']) !!}

                                {!! Form::label('pincode','Pincode *') !!}
                                {!! Form::text('pincode',null,['class' => 'form-control']) !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label(null,'Contact Details of Company *') !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label('mobile','Mobile No. *') !!}
                                {!! Form::text('mobile',null,['class' => 'form-control']) !!}

                                {!! Form::label('landline','Landline No. *') !!}
                                {!! Form::text('landline_std',null,['class' => 'form-control']) !!}
                                {!! Form::text('landline',null,['class' => 'form-control']) !!}
                              </div>

                              <div class="form-group">
                                {!! Form::label(null,'Operating Address') !!}

                                {!! Form::checkbox('operating_address') !!}
                                {!! Form::label('operating_address','Same as Above') !!}
                              </div>

                              <div class="form-group">
                               {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn', 'onclick' => 'showTab("Div1");')) !!}
                               {!! Form::submit('Save & Continue', ['class' => 'inputBtn']) !!}
                              </div>
                            </div>

                             @if (array_flatten($divTabs)[2] == "1")
                                <div id="divTC-Div3">
                             @else
                                <div id="divTC-Div3" style="display: none;">
                             @endif

                             <div class="form-group">
                                {!! Form::label('promoter_name','Main Promoter/Owner name *') !!}
                                {!! Form::text('promoter_name',null,['class' => 'form-control']) !!}
                             </div>
                             <div class="form-group">
                                {!! Form::label('promoter_pan','Main Promoter/Owner PAN *') !!}
                                {!! Form::text('promoter_pan',null,['class' => 'form-control']) !!}
                             </div>

                             <div class="form-group">
                                {!! Form::label('promoter_email','Main Promoter Email Id *') !!}
                                {!! Form::email('promoter_email',null,['class' => 'form-control']) !!}
                             </div>
                             <div class="form-group">
                                {!! Form::label('promoter_contact','Main Promoter/Owner Contact No *') !!}
                                {!! Form::text('promoter_contact',null,['class' => 'form-control']) !!}
                             </div>
                             <div class="form-group">
                                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn', 'onclick' => 'showTab("Div2");')) !!}
                                {!! Form::submit('Save & Continue', ['class' => 'inputBtn']) !!}
                             </div>
                            </div>

                            @if (array_flatten($divTabs)[3] == "1")
                                <div id="divTC-Div4">
                            @else
                                <div id="divTC-Div4" style="display: none;">
                            @endif

                            <div class="form-group">
                                {!! Form::label('incorporation_date','Date of Incorporation *') !!}
                                {!! Form::input('date','incorporation_date',null,['class' => 'form-control']) !!}

                                {!! Form::label('tan','TAN *') !!}
                                {!! Form::text('tan',null,['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('service_tax_number','Service Tax Number *') !!}
                                {!! Form::text('service_tax_number',null,['class' => 'form-control']) !!}

                                {!! Form::label('vat_number','VAT Number *') !!}
                                {!! Form::text('vat_number',null,['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('turnover_201415','FY 2014-2015 *') !!}
                                {!! Form::text('turnover_201415',null,['class' => 'form-control']) !!}

                                {!! Form::label('turnover_201314','FY 2013-2014 *') !!}
                                {!! Form::text('turnover_201314',null,['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('turnover_201213','FY 2012-2013 *') !!}
                                {!! Form::text('turnover_201213',null,['class' => 'form-control']) !!}

                                {!! Form::label('turnover_201112','FY 2011-2012 *') !!}
                                {!! Form::text('turnover_201112',null,['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('gross_fixed_assets','Total value of Gross Fixed Assets
                                    as on date ( in Lacs) *') !!}
                                {!! Form::text('gross_fixed_assets',null,['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('gross_equipment','Gross value of Plant & Machinery /
                                    Equipment as on date ( in Lacs) *') !!}
                                {!! Form::text('gross_equipment',null,['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn', 'onclick' => 'showTab("Div3");')) !!}
                                {!! Form::submit('Save & Continue', ['class' => 'inputBtn']) !!}
                            </div>
                           </div>

                          @if (array_flatten($divTabs)[4] == "1")
                           <div id="divTC-Div5">
                          @else
                           <div id="divTC-Div5" style="display: none;">
                          @endif
                             <br />
                             <br />
                            <div class="form-group">
                                {!! Form::label('subsidiary_company','Do you have any Subsidiary/Associate company? *') !!}
                                {!! Form::select('subsidiary_company',['yes' => 'Yes', 'no' => 'No'],['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn', 'onclick' => 'showTab("Div4");')) !!}
                                {!! Form::submit('Save & Continue', ['class' => 'inputBtn']) !!}
                            </div>
                           </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rightSection">
                    <div class="box">
                        <div class="middle">
                            <h2>
                                Need Help?</h2>
                            <ul class="needHelp">
                                <li><span class="icon tel"></span><span class="text">Telephone (toll free) <span
                                                class="number">1-800-103-7690<br>
                                <span>Monday-Saturday : 10am to 6pm</span></span> </span></li>
                                <li><span class="icon email"></span><span class="text">E-mail <a class="mail" href="mailto:contact@smeniwas.com">
                                            contact@smeniwas.com</a> </span></li>
                            </ul>
                        </div>
                        <div class="bottom">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>