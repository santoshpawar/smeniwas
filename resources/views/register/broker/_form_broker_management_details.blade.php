<div id="divTC-Div5">

    <div class="form-group">
        {!! Form::label('owner_name','Proprietors name*') !!}
        {!! Form::text('owner_name',null,['class' => 'form-control']) !!}

        {!! Form::label('owner_email','Email ID*') !!}
        {!! Form::text('owner_email',null,['class' => 'form-control']) !!}


    </div>
    <div class="form-group">
        {!! Form::label('owner_pan','PAN of Proprietor*') !!}
        {!! Form::text('owner_pan',null,['class' => 'form-control']) !!}

        {!! Form::label('owner_mobile','Mobile No*') !!}
        {!! Form::text('owner_mobile',null,['class' => 'form-control']) !!}


    </div>
    <div class="form-group">
        {!! Form::label('landline','Landline No.*') !!}
        {!! Form::text('owner_std_code',null,['class' => 'form-control']) !!}
        {!! Form::text('owner_landline',null,['class' => 'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::label(null,'(All * marked fields are mandatory)') !!}
    </div>
    <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-12">
        {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn btn',
        'onclick' => 'window.location.href="/register/broker/broker-details"')) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>

</div>