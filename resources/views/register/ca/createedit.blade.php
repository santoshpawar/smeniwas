@extends('app_header')
@section('head-content')
{{--@include('register.ca._formheader');--}}
    <script type="text/javascript" src="{{ asset('/js/jquery-ui.js') }}"></script>
    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
@endsection
hiiiiiiiiiiiiii
@section('content')
    @if(Auth::guest())
        {!! Form::open(['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal']) !!}
    @else
        @if ($subViewType == "register.ca._form_ca_register")
            {{--{!! Form::model(Sentinel::getUser(),['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}--}}
            {!! Form::model($userProfile,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
        @elseif($subViewType == "register.ca._form_ca_registration_details")
            {!! Form::model(Auth::user()->userProfile,['method' =>'POST','action' => $formaction, 'files'=>true, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal']) !!}
        @else
            {!! Form::model(Auth::user()->userProfile,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
        @endif
    @endif

    @include('register.ca._form_caregister_master',array('sub_view_type' => $subViewType));

    {!! Form::close() !!}
    <script type="text/javascript">

        $("#lnkFirmDtls").click(function (e) {
            e.preventDefault();
            window.location.href = window.location.origin+'/register/ca/firm';
        });

        $("#lnkPropertyDtls").click(function (e) {
            e.preventDefault();
            window.location.href = window.location.origin+'/register/ca/details';
        });
        $("#lnkRegistrationDtls").click(function (e) {
            e.preventDefault();
            window.location.href = window.location.origin+'/register/ca/registration';
        });
        $("#lnkLoanDtls").click(function (e) {
            e.preventDefault();
            window.location.href = window.location.origin+'/register/ca';
        });


        $(document).ready(function(){
            //called when key is pressed in textbox
            $(".amount").keypress(function(e){
                if ((e.which != 8 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57))
                {
                    //display error message
                    $(this).css("border", "1px solid red");
                    return false;
                }
                else
                {
                    $(this).css("border", "");
                    var points = 0;
                    var ws_text = $(this).val().split('.');
                    points = ws_text[1];
                    points = points.length;
                    if (points >= 1)
                    {
                        $(this).css("border", "1px solid red");
                        alert("One decimal places only allowed");
                        $(this).css("border", "");
                        return false;
                    }
                    $(this).css("border", "");
                }
            });
        });


    </script>



@endsection