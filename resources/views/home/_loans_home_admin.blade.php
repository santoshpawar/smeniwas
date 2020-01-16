<?php $user = Auth::user(); ?>

  @include('admin.sidebarMenu')

    <div class="main-panel">
      @include('loans.dashboardNavbar')
      <div class="content">
        <section>
          <div class="panel-body">
            <table id="adminGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Loan Application Id</th>
                  <th>Type</th>
                  <th>Loan Amount</th>
                  <th>Loan Tenure</th>
                  <th>Company Name</th>
                  <th>Status</th>
                  <th>Download PDF</th>
                  @if(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isAdmin()))
                    <th>Action</th>
                  @else
                    <th></th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($loans as $loan)
                  <?php $labelValue = App\Helpers\FormatHelper::formatLoanType($loan->type);
                  $statusValue = App\Helpers\FormatHelper::calculateAndFormatStatus($loan, $user);
                  $queryFromSMENiwas = App\Models\Loan\LoansStatus::where('loan_id','=',$loan->id)->get()->first();
                  $loanID = $loan->id;
                  ?>
                  <tr>
                    <td><a href="{{URL::to('loans/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/' . $loan->id)}}">{!! isset($loan->getUserProfile) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
                    <td>{!! $labelValue !!}</td>
                    <td>{!! $loan->loan_amount !!} Lacs</td>
                    <td>{!! $loan->loan_tenure !!} Yr</td>
                    <td><?php isset($loan->getUserProfile)?print_r($loan->getUserProfile->name_of_firm):"" ?></td>
                    <td>
                      @if($statusValue == 'Rejected')
                        <a class="tooltips" href="#">{!! $statusValue !!}<span>{!! $queryFromSMENiwas->remark !!}</span></a>
                      @else
                        {!! $statusValue !!}
                      @endif
                    </td>
                    <td>
                      @if($statusValue == 'Application Form Pending')
                        <a href = "{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}" style="pointer-events: none;cursor: default;">Download PDF</a>
                      @else
                        <a href = "{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}">Download PDF</a>
                      @endif
                    </td>
                    @if( ($user->isAdmin() && $statusValue == 'Application Form Pending') && ($isDiscardApplication && isset($isDiscardApplication)) )
                      <td><a class="btn" id="discard_application" onclick="discardApplication('{{$statusValue}}','{{$loan->id}}')">Discard current application</a></td>
                    @else
                      <td></td>
                    @endif
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </section>

        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript">
        $('.tip').tooltip();
        </script>
        <script src="{{ URL::asset('js/moment.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
        {{--<script>--}}
        {{--// Code to make the ul visible--}}
        {{--$('.dropdown-toggle').dropdown();--}}
        {{--// Code added by rahul to change the color of the dropdown under export and filter--}}
        {{--$("button.btn.btn-default.dropdown-toggle").next().children().css({'background-color':'#FFF'});--}}
        {{--$("button.btn.btn-default.dropdown-toggle").next().children().children().css({'color':'#000'});--}}
        {{--$(function () {--}}
        {{--// Setup DataGrid--}}
        {{--var grid = $.datagrid('standard', '.table', '#pagination', '.applied-filters',--}}
        {{--{--}}
        {{--throttle: 20,--}}
        {{--loader: '.loader',--}}
        {{--callback: function (obj) {--}}
        {{--// Select the correct value on the per page dropdown--}}
        {{--$('[data-per-page]').val(obj.opt.throttle);--}}
        {{--// Disable the export button if no results--}}
        {{--$('button[name="export"]').prop('disabled', (obj.pagination.filtered === 0) ? true : false);--}}
        {{--}--}}
        {{--});--}}
        {{--$('[data-per-page]').on('change', function () {--}}
        {{--grid.setThrottle($(this).val());--}}
        {{--grid.refresh();--}}
        {{--});--}}
        {{--});--}}
        {{--</script>--}}
        <script type="text/javascript">
        $(document).ready(function () {
          var oTable;
          $('#adminGrid').dataTable({
            "sDom": "<'row'<'col-sm-12'<'col-sm-6'<'col-sm-3'l><'col-sm-3'T><'col-sm-3'<'#filterSecond'>>><'col-sm-6'f>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-4'><'col-sm-4'p>>",
            "oTableTools": {
              "aButtons": [
                {
                  "sExtends":    "collection",
                  "sButtonText": "Export <i class='fa fa-download'></i> ",
                  "aButtons":    [ "copy","print","csv", "xls", "pdf" ]
                }
              ],
              "sSwfPath": "{{{URL::asset("/js_new/swf/copy_csv_xls_pdf.swf")}}}"
            },
            "iDisplayLength": 20,
            "oLanguage": {
              "sLengthMenu": 'Per Page <select class="form-control input-sm">'+
              '<option value="5">5</option>'+
              '<option value="10">10</option>'+
              '<option value="20">20</option>'+
              '<option value="30">30</option>'+
              '<option value="40">40</option>'+
              '<option value="50">50</option>'+
              '<option value="100">100</option>'+
              '<option value="200">200</option>'+
              '</select>'
            }
          });
          var filterSecond = $("#filterSecond").html('<strong>Filter</strong> : <select id="filters" class="form-control"><option value="">Filter</option> <option value="Application Form Pending">Application Form Pending</option> <option value="Document Upload Pending">Document Upload Pending</option> <option value="Application Submitted">Application Submitted</option> <option value="Application Forwarded to Bank">Application Forwarded to Bank</option><option value="Query Received from Bank">Query Received from Bank</option></select>');
          $(".DTTT_container").css(("margin-top"),5);
          $(".col-sm-3").css(("width"),'initial');
          oTable = $('#adminGrid').dataTable();
          $('#filters').change( function() {
            oTable.fnFilter( $(this).val() );
          });
        });
        </script>
      @endsection
      <script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
  <script src="{{ URL::asset('js_new/jquery.validate.js') }}"></script>
     

      {{-- Old data bellow --}}

      {{--<div class="container-fluid">--}}
      {{--<div class="row">--}}
      {{--<div class="col-md-12">--}}
      {{--<div class="container-fluid main-container">--}}
      {{--<div class="col-md-12 content">--}}
      {{--<div class="row">--}}
      {{--Export button--}}
      {{--<div class="col-md-4">--}}
      {{--<div class="btn-group">--}}
      {{--<button name="export" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="margin:0 !important">--}}
      {{--Export <span class="caret"></span>--}}
      {{--</button>--}}
      {{--<ul class="dropdown-menu" role="menu">--}}
      {{--<li><a href="#" data-grid="standard" data-download="csv">Export to CSV</a></li>--}}
      {{--<li><a href="#" data-grid="standard" data-download="json">Export to JSON</a></li>--}}
      {{--<li><a href="#" data-grid="standard" data-download="pdf">Export to PDF</a></li>--}}
      {{--</ul>--}}
      {{--</div>--}}
      {{--<label for="male" style="margin-left: 257px; font-weight: normal;">Per Page</label>--}}
      {{--</div>--}}
      {{-- Results per page --}}
      {{--<div class="col-md-2">--}}
      {{--<div class="form-group">--}}
      {{--<select data-per-page class="form-control">--}}
      {{--<option>Per Page</option>--}}
      {{--<option value="5">5</option>--}}
      {{--<option value="10">10</option>--}}
      {{--<option value="20">20</option>--}}
      {{--<option value="30">30</option>--}}
      {{--<option value="40">40</option>--}}
      {{--<option value="50">50</option>--}}
      {{--<option value="100">100</option>--}}
      {{--<option value="200">200</option>--}}
      {{--</select>--}}
      {{--</div>--}}
      {{--</div>--}}
      {{--<div class="col-md-5">--}}
      {{--<form data-search data-grid="standard" class="form-inline" role="form">--}}
      {{--<div class="form-group">--}}
      {{--<select name="column" class="form-control">--}}
      {{--<option value="all">All</option>--}}
      {{--<option value="loan_application_id">Application Id</option>--}}
      {{--<option value="type">Type</option>--}}
      {{--<option value="status">Status</option>--}}
      {{--</select>--}}
      {{--</div>--}}
      {{--<div class="form-group">--}}
      {{--<input type="text" class="form-control" placeholder="Search for...">--}}
      {{--<span class="input-group-btn">--}}
      {{--<button class="btn btn-default" type="button" style="margin:0 !important">Go!</button>--}}
      {{--</span>--}}
      {{--</div>--}}
      {{--</form>--}}
      {{--</div>--}}
      {{--</div>--}}
      {{--<div class="row">--}}
      {{--<div class="applied-filters" data-grid="standard"></div>--}}
      {{--</div>--}}
      {{--<div class="spacer10"></div>--}}
      {{--<div class="clearfix"></div>--}}
      {{--<div class="table-responsive">--}}
      {{--<table class="table table-striped table-bordered table-hover"--}}
      {{--data-source="{{ URL::to('home/ca-source') }}"--}}
      {{--data-grid="standard">--}}
      {{--<thead>--}}
      {{--<tr>--}}
      {{--<th class="sortable col-md-3" data-grid="standard" data-sort="name_of_firm">Name Of Firm</th>--}}
      {{--<th class="sortable col-md-1" data-grid="standard" data-sort="owner_name">Name</th>--}}
      {{--<th class="sortable col-md-1" data-grid="standard" data-sort="address">Address</th>--}}
      {{--<th class="sortable col-md-2" data-grid="standard" data-sort="owner_purpose_of_loan">Purpose Of Loan</th>--}}
      {{--<th class="sortable col-md-1" data-grid="standard" data-sort="owner_entity_type">Entity Type</th>--}}
      {{--<th class="sortable col-md-1" data-grid="standard" data-sort="latest_turnover">Turnover</th>--}}
      {{--<th class="sortable col-md-1" data-grid="standard" data-sort="required_amount">Req. Loan</th>--}}
      {{--<th class="sortable col-md-1" data-grid="standard" data-sort="">View Loan</th>--}}
      {{--</tr>--}}
      {{--</thead>--}}
      {{--<tbody></tbody>--}}
      {{--</table>--}}
      {{--<div class="clearfix"></div>--}}
      {{--<div id="pagination" data-grid="standard"></div>--}}
      {{--</div>--}}
      {{--</div>--}}
      {{--</div>--}}
      {{--</div>--}}
      {{--</div>--}}
      {{--</div>--}}
