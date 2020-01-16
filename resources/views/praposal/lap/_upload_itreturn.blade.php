<div id="divTC-Div6">
    <div class="form-group">
        {!! Form::label(null,'Upload Latest IT Returns') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
    </div>
    <hr/>
    <div class="form-group">
        @if(isset($it_return_obj_1))
            {!! Form::label('it_return_1', $it_return_obj_1 , ['class' => 'form-control']) !!}
        @else
            {!! Form::file('it_return_1', ['class' => 'form-control it_return']) !!}
        @endif
    </div>
    <div class="form-group">
        @if(isset($it_return_obj_2))
            {!! Form::label('it_return_2', $it_return_obj_2 , ['class' => 'form-control']) !!}
        @else
            {!! Form::file('it_return_2', ['class' => 'form-control it_return']) !!}
        @endif
    </div>
    <div class="form-group">
        @if(isset($it_return_obj_3))
            {!! Form::label('it_return_3', $it_return_obj_3 , ['class' => 'form-control']) !!}
        @else
            {!! Form::file('it_return_3', ['class' => 'form-control it_return']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('notice', '(All ') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::label('notice', ' marked fields are mandatory)' ) !!}
    </div>
    <div class="form-group">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div5'); return false;", 'value'=> 'Back' )) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>
@section('footer')
    <script src="{{ URL::asset('js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".it_return").filestyle({buttonName: "btn-primary"});
    </script>
@endsection