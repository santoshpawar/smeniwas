<?php $user = Auth::user(); ?>

@section('content')
<style type="text/css" media="screen">
td.Application.Submitted {
  background: #F0AD4E
}
td.Application.Forwarded.to.Bank {
  background:#5BC0DE;
}
td.Rejected{
  background:#7d7373;
}
td.Rejected a{
  color:white;
}
td.Approved {
  background:#5CB85C;
}
td.Document.Upload.Pending {
  background: #D9534F
}
</style>

<div class="wrapper">
  <div class="sidebar" data-color="purple" data-image="{{ asset('/images/sidebar-1.jpg') }}">
    <div class="logo">
     <a href="/home"><img style="background-color: white;height: 77px;width:219px" src="{{ asset('/images/smeLogo.png') }}"></a>
   </div>
   <div class="sidebar-wrapper">
    <div id="tab" class="btn-group leftside_tab" role="group">
      <ul class="nav">
        <li>
          <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn " role="button"><i class="material-icons">dashboard</i>Dashboard<div class="ripple-container"></div></a>
        </li>
        <li>
          <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn" role="button"><i class="material-icons ">person</i>Background<div class="ripple-container"></div></a>
        </li>
        <li>
          <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">content_paste</i>Promoter Details</a>
        </li>
        <li>  
          <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">library_books</i>Business Financials</a>
        </li>
        <li>
          <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">security</i>Security Details</a>
        </li>
        <li>
          <a  href="#" class="btn btn-large btn-success btn-space lefttabbtn  " role="button"><i class="material-icons">file_upload</i>Upload Documents</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="main-panel">
 @include('loans.dashboardNavbar')
 <div class="content">
  <section>

    @if(isset($isCAUserLoan) && $isCAUserLoan == true && isset($loans))
    <section style="margin-left: 50px;margin-right: 50px;">
      <div class="panel-body">
        <table id="smeGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Loan Application Id</th>
              <th>Type</th>
              <th>Loan Amount</th>
              <th>Loan Tenure</th>
              <th>Status</th>
            </tr>

          </thead>
          <tbody>
            @foreach($loans as $loan)
            <?php $labelValue = App\Helpers\FormatHelper::formatLoanType($loan->type);
            $statusValue = App\Helpers\FormatHelper::formatStatusType($loan->status);
            $queryFromSMENiwas = App\Models\Loan\LoansStatus::where('loan_id','=',$loan->id)->get()->first();
            $queryFromBank = App\Models\Loan\Bankallocation\LoansBankAllocation::where('loan_id','=',$loan->id)->get()->first();
            $threadValue = App\Models\Messenger\Thread::where('loan_id','=',$loan->id)->where('is_replied','=',null)->get();
            foreach($threadValue as $value)
            {
              $queryValue = App\Models\Messenger\Participant::where('user_id','=',$user->id)->where('thread_id','=',$value->id)->get()->first();
            }
            $loanID = $loan->id;
            ?>
            <tr>
              <td><a href="{{URL::to('loans/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/' . $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
              <td>{!! $labelValue !!}</td>
              <td>{!! $loan->loan_amount !!} Lacs</td>
              <td>{!! $loan->loan_tenure !!} Yr</td>
              <td>
                @if($statusValue == 'Rejected')
                <a class="tooltips" href="#">{!! $statusValue !!}<span>{!! $queryFromSMENiwas->remark !!}</span></a>
                @else
                {!! $statusValue !!}
                @endif
              </td>
              {{--<td>--}}
                {{--@if($statusValue == 'Application Form Pending')--}}
                {{--<a href = "{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}" style="pointer-events: none;cursor: default;">Download PDF</a>--}}
                {{--@else--}}
                {{--<a href = "{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}">Download PDF</a>--}}
                {{--@endif--}}
              {{--</td>--}}

              {{--@if( ($user->isSME() && $statusValue == 'Application Form Pending') && ($isDiscardApplication && isset($isDiscardApplication)) )--}}
              {{--<td><a class="btn" id="discard_application" onclick="discardApplication('{{$statusValue}}','{{$loan->id}}')">Discard current application</a></td>--}}
              {{--@elseif(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))--}}
              {{--<td></td>--}}
              {{--@endif--}}
              {{--@if($user->isBankUser() || $user->isAnalyst())--}}
              {{--<td><a href = "{{URL::to("messaging/compose/". $loan->id. '/' .$loan->user_id)}}" title="Raise A Query">Raise Query</a></td>--}}
              {{--@endif--}}
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </section>
  @else
  <section style="margin-left: 50px;margin-right: 50px;">
    <div class="panel-body">
      <table id="smeGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Loan Application Id</th>
            <th>Type</th>
            <th>Loan Amount</th>
            <th>Loan Tenure</th>
            <th>Status</th>
            <th>Download PDF</th>
            @if($user->isBankUser() || $user->isAnalyst())
            <th>Query</th>
            @endif
            @if(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))
            <th>Action</th>
            @endif

          </tr>

        </thead>
        <tbody>
          @foreach($loans as $loan)
          <?php $labelValue = App\Helpers\FormatHelper::formatLoanType($loan->type);
          $statusValue = App\Helpers\FormatHelper::calculateAndFormatStatus($loan, $user);
          $queryFromSMENiwas = App\Models\Loan\LoansStatus::where('loan_id','=',$loan->id)->get()->first();
          $queryFromBank = App\Models\Loan\Bankallocation\LoansBankAllocation::where('loan_id','=',$loan->id)->get()->first();
          $threadValue = App\Models\Messenger\Thread::where('loan_id','=',$loan->id)->where('is_replied','=',null)->get();
          foreach($threadValue as $value)
          {
            $queryValue = App\Models\Messenger\Participant::where('user_id','=',$user->id)->where('thread_id','=',$value->id)->get()->first();
          }
          $loanID = $loan->id;
          ?>
          <tr>
            {{--   <td><a href="{{URL::to('loans/profile-loan-details/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/' . $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td> --}}
            @if($loan->companySharePledged!='' && $loan->bscNscCode!='')
            <td><a href=" {{URL::to('loans/profile-loan-details/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'.$loan->companySharePledged .'/'.$loan->bscNscCode.'/'. $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
            @else
            <td><a href="{{URL::to('loans/profile-loan-details/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'. $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
            @endif

            <td>{!! $labelValue !!}</td>
            <td>{!! $loan->loan_amount !!} Lacs</td>
            <td>{!! $loan->loan_tenure !!} Yr</td>
            <td>
              @if(isset($queryFromSMENiwas['niwas_query_status']) && $queryFromSMENiwas['niwas_query_status'] == 'Y' && isset($queryFromBank['bank_query_status']) && $queryFromBank['bank_query_status'] == 'Y' && $user->isSME() && isset($queryValue->id) && $queryValue->id != '')
              <a href = "{{URL::to("messaging/".$queryValue->id)}}" title="View Query Details">Query Received From Bank & SMENiwas</a>
              @elseif(isset($queryFromSMENiwas['niwas_query_status']) && $queryFromSMENiwas['niwas_query_status'] == 'Y' && $user->isSME() && isset($queryValue->id) && $queryValue->id != '')
              <a href = "{{URL::to("messaging/".$queryValue->id)}}" title="View Query Details">SMENiwas Query</a>
              @elseif(isset($queryFromBank['bank_query_status']) && $queryFromBank['bank_query_status'] == 'Y' && $user->isSME() && isset($queryValue->id) && $queryValue->id != '')
              <a href = "{{URL::to("messaging/".$queryValue->id)}}" title="View Query Details">Query Received From Bank</a>
              @else
              @if($statusValue == 'Rejected')
              <a class="tooltips" href="#">{!! $statusValue !!}<span>{!! $queryFromSMENiwas->remark !!}</span></a>
              @else
              {!! $statusValue !!}
              @endif
              @endif
            </td>
           {{--  <td>
              @if($statusValue == 'Application Form Pending')
              <a href = "{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}" style="pointer-events: none;cursor: default;">Download PDF</a>
              @else
              <a href = "{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}">Download PDF</a>
              @endif
            </td> --}}

               <td>
                  @if($statusValue == 'Application Form Pending')
                  <a href="{{action('Pdf\PraposalprintController@getIndex', ['id' => $loan->id])}}" style="pointer-events: none;cursor: default;">Download PDF</a>                        @else
                  <a href="{{action('Pdf\PraposalprintController@getIndex', ['id' => $loan->id])}}">Download PDF</a> 
                  
                  @endif
                </td>

            @if( ($user->isSME() && $statusValue == 'Application Form Pending') && ($isDiscardApplication && isset($isDiscardApplication)) )
            <td><a class="btn" id="discard_application" onclick="discardApplication('{{$statusValue}}','{{$loan->id}}')">Discard current application</a></td>
            @elseif(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))
            <td></td>
            @endif
            @if($user->isBankUser() || $user->isAnalyst())
            <td><a href = "{{URL::to("messaging/compose/". $loan->id. '/' .$loan->user_id)}}" title="Raise A Query">Raise Query</a></td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</section>
@endif


<script type="text/template" data-grid="standard" data-template="results">

  <% _.each(results, function(r) { %>

  <tr>
    <td><a href="<%= r.edit_url %>"> Loan #<%= r.id %> </a> </td>
    <td><%= r.type_label %></td>
    <td><%= r.status %></td>
    <td><%= r.loan_amount %> Lacs</td>
    <td><%= r.loan_tenure %> Yr</td>
    <td><%= r.promoter_generation_type %></td>
    <td><%= r.promoter_background %></td>

  </tr>

  <% }); %>

</script>

<script type="text/template" data-grid="standard" data-template="no_results">
  <tr>
    <td colspan="5">No Results</td>
  </tr>
</script>

<script type="text/template" data-grid="standard" data-template="pagination">
  <% _.each(pagination, function(p) { %>
  {{--<div class="row">--}}
    <div class="col-md-6 paragraph-style">
      <p>Showing <%= p.page_start %> to <%= p.page_limit %> of <%= p.filtered %></p>
    </div>
    <div class="col-md-6">
      <ul class="pagination pagination-sm pull-right" style="margin:0 0 !important">
        <% if (p.previous_page !== null) { %>
        <li><a href="#" data-grid="standard" data-page="1"><i class="fa fa-angle-double-left"></i></a></li>
        <li><a href="#" data-grid="standard" data-page="<%= p.previous_page %>"><i class="fa fa-chevron-left"></i></a></li>
        <% } else { %>
        <li class="disabled"><span><i class="fa fa-angle-double-left"></i></span></li>
        <li class="disabled"><span><i class="fa fa-chevron-left"></i></span></li>
        <% } %>
        <%
        var num_pages = 8,
        split    = num_pages - 1,
        middle   = Math.floor(split / 2);

        var i = p.page - middle > 0 ? p.page - middle : 1,
        j = p.pages;

        j = p.page + middle > p.pages ? j : p.page + middle;

        i = j - i < split ? j - split : i;

        if (i < 1)
        {
          i = 1;
          j = p.pages > split ? split + 1 : p.pages;
        }
        %>
        <% for(i; i <= j; i++) { %>
        <% if (p.page === i) { %>
        <li class="active"><span><%= i %></span></li>
        <% } else { %>
        <li><a href="#" data-grid="standard" data-page="<%= i %>"><%= i %></a></li>
        <% } %>
        <% } %>
        <% if (p.next_page !== null) { %>
        <li><a href="#" data-grid="standard" data-page="<%= p.next_page %>"><i class="fa fa-chevron-right"></i></a></li>
        <li><a href="#" data-grid="standard" data-page="<%= p.pages %>"><i class="fa fa-angle-double-right"></i></a></li>
        <% } else { %>
        <li class="disabled"><span><i class="fa fa-chevron-right"></i></span></li>
        <li class="disabled"><span><i class="fa fa-angle-double-right"></i></span></li>
        <% } %>
      </ul>
    </div>
  {{--</div>--}}
  <% }); %>
</script>

<script type="text/template" data-grid="standard" data-template="filters">

  <% _.each(filters, function(f) { %>

  <button class="btn btn-default">

    <% if (f.from !== undefined && f.to !== undefined) { %>

    <% if (/[0-9]{4}-[0-9]{2}-[0-9]{2}/g.test(f.from) && /[0-9]{4}-[0-9]{2}-[0-9]{2}/g.test(f.to)) { %>

    <%= f.label %> <em><%= moment(f.from).format('MMM DD, YYYY') %>
      - <%= moment(f.to).format('MMM DD, YYYY') %></em>

      <% } else { %>

      <%= f.label %> <em><%= f.from %> - <%= f.to %></em>

      <% } %>

      <% } else if (f.col_mask !== undefined && f.val_mask !== undefined) { %>

      <%= f.col_mask %> <em><%= f.val_mask %></em>

      <% } else { %>

      <% if (f.column === 'all') { %>

      <%= f.value %>

      <% } else { %>

      <%= f.value %> in <em><%= f.column %></em>

      <% } %>

      <% } %>

      <span><i class="fa fa-times-circle"></i></span>

    </button>

    <% }); %>

  </script>

  <script type="text/template" data-grid="standard" data-template="no_filters">
    <i>There are no filters applied.</i>
  </script>

  <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

  <script type="text/javascript">
    $('.tip').tooltip();
  </script>

  <script src="{{ URL::asset('js/moment.min.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>

  <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('css/jquery-ui.css') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js_new/jquery.validate.js') }}"></script>

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

    jQuery(document).ready(function($){
      var oTable;

      $('#smeGrid').dataTable({
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
                                      //            var filterFirst = $("#filterFirst").html('<select id="all" class="form-control"><option value="all">All</option> <option value="loan_application_id">Application Id</option> <option value="type">Type</option> <option value="status">Status</option></select>');
                                      var filterSecond = $("#filterSecond").html('<strong>Filter</strong> : <select id="filters" class="form-control"><option value="">Filter</option> <option value="Application Form Pending">Application Form Pending</option> <option value="Document Upload Pending">Document Upload Pending</option> <option value="Application Submitted">Application Submitted</option> <option value="Application Forwarded to Bank">Application Forwarded to Bank</option><option value="Query Received From Bank">Query Received From Bank</option></select>');
                                      $(".DTTT_container").css(("margin-top"),5);
                                      $("#filterSecond").css(("margin-top"),3);
                                      $(".DTTT_container").css("float","none");
                                      $(".col-sm-3").css(("width"),'initial');
                                      oTable = $('#smeGrid').dataTable();
                                      $('#filters').change( function() {
                                        oTable.fnFilter( $(this).val() );
                                      });
                                    });
                                  </script>
                                  @endsection


