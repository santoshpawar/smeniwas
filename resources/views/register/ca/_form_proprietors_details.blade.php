<div id="divTC-Div5">

    <div class="form-group {{ $errors->has('owner_name') ? 'has-error' : '' }}">
        {!! Form::label('owner_name','Advisors name*') !!}
        {!! Form::text('owner_name',null,['class' => 'form-control']) !!}
        {!! $errors->first('owner_name','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('owner_email') ? 'has-error' : '' }}">
        {!! Form::label('owner_email','Advisors Email ID*') !!}
        {!! Form::text('owner_email',null,['class' => 'form-control']) !!}
        {!! $errors->first('owner_email','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('registration_no') ? 'has-error' : '' }}">
        {!! Form::label('owner_pan','Advisors PAN Number*') !!}
        {!! Form::text('owner_pan',null,['class' => 'form-control']) !!}
        {!! $errors->first('owner_pan','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('owner_mobile') ? 'has-error' : '' }}">
        {!! Form::label('owner_mobile','Advisors Mobile No*') !!}
        {!! Form::text('owner_mobile',null,['class' => 'form-control']) !!}
        {!! $errors->first('owner_mobile','<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('owner_landline') ? 'has-error' : '' }}">
        {!! Form::label('landline','Advisors Landline No.*') !!}
        {!! Form::text('owner_std_code',null,['class' => 'form-control']) !!}
        {!! Form::text('owner_landline',null,['class' => 'form-control']) !!}
        {!! $errors->first('owner_landline','<span class="help-block">:message</span>') !!}
    </div>

    {{--@foreach($bl_year as $blyear)--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label($blyear, $blyear) !!}--}}
            {{--{!! Form::text('turnover_201415',null,['class' => 'form-control']) !!}--}}
        {{--</div>--}}
    {{--@endforeach--}}

    <div class="form-group">
        {!! Form::label('latest_turnover','Latest Audited Turnover (In Lacs)') !!}
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
        {!! Form::label(null,'(All * marked fields are mandatory)') !!}
    </div>
    <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-12">
        {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn btn',
        'onclick' => 'window.location.href="/register/ca/firm"')) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>

</div>