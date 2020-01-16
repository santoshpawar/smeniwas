@extends('app')

@section('content')

    @if ($subViewType == "loans.lap._existing_lenderdetails")
        {!! Form::model($existingLenders,['method' =>'POST','action' => $formaction] ) !!}
    @elseif($subViewType=='loans.lap._upload_itreturn')
        {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'files'=>true] ) !!}
    @else
        {!! Form::model($loan,['method' =>'POST','action' => $formaction] ) !!}
    @endif

    {!! Form::hidden('loanId', $loanId) !!}
    @include('loans.lap._form_master',array('sub_view_type' => $subViewType));

    {!! Form::close() !!}

@endsection