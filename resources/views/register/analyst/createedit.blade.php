
@extends('app_header')
@section('head-content')
<?php $user = Auth::user(); ?>

@section('content')
<div class="wrapper">
  @include('home.home_sidebar')
  <div class="main-panel">
    @include('loans.dashboardNavbar')


    <div class="content">
        <div class="clearfix_responsive"></div>
        <div class="container-fluid">


          @if(Auth::guest())
          {!! Form::open(['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal']) !!}
          @else
          @if ($subViewType == "register.analyst._form_analyst_register")
          {!! Form::model($userProfile,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
          @endif
          @endif

          @include('register.analyst._form_analystregister_master',array('sub_view_type' => $subViewType));

          {!! Form::close() !!}



      </div>

  </div>

  <script type="text/template" data-grid="standard" data-template="no_filters">
    <i>There are no filters applied.</i>
</script>

<script type="text/javascript">
  $('.tip').tooltip();
</script>
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function() {
    $('#smeGrid').DataTable();
} );
</script>

</div>


</div>
</div>
@endsection

  <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('css/jquery-ui.css') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js_new/jquery.validate.js') }}"></script>