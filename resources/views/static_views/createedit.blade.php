@extends('app_header')
@section('content')
    @if ($subViewType == "static_views.wwr")
        @include('static_views.wwr')
    @elseif($subViewType == 'static_views.whyus')
        @include('static_views.whyus') 
     @elseif($subViewType == 'static_views.successStories')
        @include('static_views.successStories')
    @elseif($subViewType == 'static_views.our_team')
        @include('static_views.our_team')
    @elseif($subViewType == 'static_views.team_members')
        @include('static_views.team_members')
    @elseif($subViewType == 'static_views.how_to_apply')
        @include('static_views.how_to_apply')
    @elseif($subViewType == 'static_views.info_required')
        @include('static_views.info_required');
    @elseif($subViewType == 'static_views.doc_required')
        @include('static_views.doc_required')
    @elseif($subViewType == 'static_views.contactus')
        {!! Form::model(['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
            @include('static_views.contactus')
        {!! Form::close() !!}
    @elseif($subViewType == 'static_views.track_application')
        @include('static_views.track_application')
    @elseif($subViewType == 'static_views.loan_products')
        @include('static_views.loan_products')
    @endif


@endsection