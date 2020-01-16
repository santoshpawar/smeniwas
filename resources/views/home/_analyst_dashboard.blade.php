<?php $user = Auth::user(); ?>
<style type="text/css" media="screen">
td.Application.Submitted {
    background: #F0AD4E
}

td.Application.Forwarded.to.Bank {
    background: #5BC0DE;
}

td.Rejected {
    background: #7d7373;
}

td.Rejected a {
    color: white;
}

td.Approved {
    background: #5CB85C;
}

td.Document.Upload.Pending {
    background: #D9534F
}
</style>






@section('content')
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{ asset('/images/sidebar-1.jpg') }}">
        <div class="logo">
            <a href="/home"><img style="background-color: white;height: 77px;width:219px" src="{{ asset('/images/smeLogo.png') }}"></a>
        </div>
        <div class="sidebar-wrapper">
            <div id="tab" class="btn-group leftside_tab" role="group">
                <ul class="nav">
                    <li>
                        <a href="#" class="btn btn-large btn-success btn-space lefttabbtn " role="button"><i class="material-icons">dashboard</i>Dashboard<div class="ripple-container"></div></a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-large btn-success btn-space lefttabbtn" role="button"><i class="material-icons ">person</i>Background<div class="ripple-container"></div></a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">content_paste</i>Promoter Details</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">library_books</i>Business Financials</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">security</i>Security Details</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">file_upload</i>Upload Documents</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-panel">
        @include('loans.dashboardNavbar')
        <div class="content">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header card-chart" data-background-color="green">
                  <h2 class="text-center">  <a href=" {{URL::to('home/praposal')}}">Create Loan Proposal</a></h2>
                  <hr>
                  <h2 class="text-center">  <a href="{{URL::to('home/loanapplication')}}">Loan Application</a></h2>
              </div>
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
