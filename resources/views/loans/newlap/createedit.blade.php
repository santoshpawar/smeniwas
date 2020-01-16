@extends('app')
@section('head-content')
@include('loans.newlap._formheader');
@endsection


@section('content')

    @if ($subViewType == "loans.newlap._existing_lenderdetails")
        {!! Form::model($existingLenders,['method' =>'POST','action' => $formaction] ) !!}
    @elseif($subViewType=='loans.newlap._upload_itreturn')
        {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'files'=>true] ) !!}
    @elseif($subViewType=='loans.newlap._upload_doc')
        {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'files'=>true] ) !!}
    @else
        {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
    @endif


    {!! Form::hidden('loanId', $loanId) !!}

    @include('loans.newlap._form_master',array('sub_view_type' => $subViewType));

    {!! Form::close() !!}

@endsection
@section('footer')

@endsection