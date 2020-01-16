<div role="tabpanel" class="tab-pane active" id="registration">
    <div class="form-group">
        {!! Form::hidden('id',null) !!}
        {!! Form::label('username','User ID (PAN of Company) *', ['class' => '']) !!}
        {!! Form::text('username',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Email *', ['class' => '']) !!}
        {!! Form::email('email',null,['class' => 'form-control']) !!}
        {!! Form::label('password','Password *', ['class' => '']) !!}
        {!! Form::input('password', 'password',null,['class' => 'form-control']) !!}
    </div>
    {!! Form::label('password_confirmation','Confirm Password *', ['class' => '']) !!}
    {!! Form::input('password', 'password_confirmation',null,['class' => 'form-control']) !!}
    <div class="form-group">
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>