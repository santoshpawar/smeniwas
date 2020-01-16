                     <div class="panel panel-success ">
                        <div class="panel-heading"><label>Analyst Registration Details</label></div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::hidden('id',null) !!}
                            {!! Form::label('analyst_name','Name', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                            <div class="col-md-12">
                                {!! Form::text('analyst_name',$analyst_name,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('analyst_email','Email Id. ', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                            <div class="col-md-12">
                                {!! Form::text('analyst_email',$analyst_email,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: -5px;">
                        <div class="col-md-12" style="margin-left:20px;   margin-bottom: 10px;">
                            {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'location.href="../home"')) !!}
                            {!! Form::submit('Save ', ['class' => 'btn btn-success btn-cons sme_button']) !!}
                        </div>
                    </div>
                </div>
            </div>
         
 
 
 


 
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/sme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
 
