
<script src="{{ URL::asset('css/jquery-ui.css') }}"></script>

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
     
      <section>
        <div class="panel-body">
       
        </div>
      </section>
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

<script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
<script src="{{ URL::asset('js_new/jquery.validate.js') }}"></script>
