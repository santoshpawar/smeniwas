
<div class="col-md-12" style="margin-left: -25px; margin-top: -90px;">
    <div class="container">
        <div role="tabpanel">
            <div id="divTC-Div1">
                <div class="row">
                    <div class="panel panel-success">
                        <div class="panel-heading" ><label>Admin Registration Details</label></div><br>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::hidden('id',null) !!}
                                    {!! Form::label('admin_name','Name', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('admin_name',$admin_name,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('admin_email','Email Id. ', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('admin_email',$admin_email,['class' => 'form-control']) !!}
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
                </div>
            </div>
        </div>
    </div>
</div>


@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sme.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
@endsection

