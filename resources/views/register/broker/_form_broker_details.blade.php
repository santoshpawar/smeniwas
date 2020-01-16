<div id="divTC-Div9">
    <div class="form-group">
        {!! Form::label('name','Name of Insurance Broker*') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}

        {!! Form::label('registration_no','IRDA Registration No.*') !!}
        {!! Form::text('registration_no',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label(null,'Contact Details of Broker *') !!}
    </div>
    <div class="form-group">
        {!! Form::label('mobile','Mobile No. *') !!}
        {!! Form::text('mobile',null,['class' => 'form-control']) !!}

        {!! Form::label('website','Website') !!}
        {!! Form::text('website',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('landline','Landline No. *') !!}
        {!! Form::text('std_code',null,['class' => 'form-control']) !!}
        {!! Form::text('landline',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label(null,'Registered Address *') !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[address1]','Address 1 *') !!}
        {!! Form::text('registeredAddress[address1]',null,['class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[address2]','Address 2 *') !!}
        {!! Form::text('registeredAddress[address2]',null,['class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[address3]','Address 3') !!}
        {!! Form::text('registeredAddress[address3]',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registeredAddress[city]','City *') !!}
        {!! Form::text('registeredAddress[city]',null,['class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[state]','State *') !!}
        {!! Form::select('registeredAddress[state]',$states,$chosenState,['id' => 'state', 'class' => 'form-control']) !!}

        {!! Form::label('registeredAddress[pincode]','Pincode *') !!}
        {!! Form::text('registeredAddress[pincode]',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label(null,'(All * marked fields are mandatory)') !!}
    </div>
    <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-12">
        {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'inputBtn btn',
        'onclick' => 'window.location.href="/register/broker"')) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>


</div>



@section('footer')
    <script>
        $(document).ready(function() {


            $('#state').select2({
                allowClear: true,
                placeholder: "Select State"
            });
        });

    </script>
@endsection