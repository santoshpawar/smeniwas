@extends('app_header')
@section('head-content')
    <script type="text/javascript" src="{{ asset('/js/jquery-ui.js') }}"></script>
    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if(Auth::guest())
        {!! Form::open(['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal']) !!}
    @else
        @if ($subViewType == "register.broker._form_broker_register")
            {!! Form::model($userProfile,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
        @endif
    @endif

    @include('register.broker._form_broker_register_master',array('sub_view_type' => $subViewType));

    {!! Form::close() !!}

@endsection