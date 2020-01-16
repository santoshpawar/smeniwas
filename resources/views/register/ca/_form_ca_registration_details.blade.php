<div id="divTC-Div5">

    <div class="form-group">
        {!! Form::label(null,'CA Registration Number') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
    </div>
    <div class="form-group {{ $errors->has('registration_no') ? 'has-error' : '' }}">
        {!! Form::text('registration_no',null,['class' => 'form-control']) !!}
        {!! $errors->first('registration_no','<span class="help-block">:message</span>') !!}
    </div>


    <div class="form-group">
        {!! Form::label(null,'Incorporation / Registration Certificate') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
    </div>

    <div class="form-group {{ $errors->has('ca_certificate_file') ? 'has-error' : '' }}">
        {!! Form::file('ca_certificate_file', ['class' => 'form-control ca_certificate_file']) !!}
        {!! $errors->first('ca_certificate_file','<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Upload', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('notice', '(All ') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
    </div>
    <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-12">
        {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn',
        'onclick' => 'window.location.href="/register/ca/details"')) !!}
    </div>
</div>