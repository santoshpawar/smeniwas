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
      <section>
        <div class="panel-body">
          <table id="smeGrid" class="display  table-bordered" cellspacing="0" width="100%">
            {{--
              <table id="smeGrid" class="table   table-bordered" cellspacing="0" width="100%"> --}}
                <thead>
                  <tr>
                    <th>Loan Application Id</th>
                    <th>Company Name</th>
                    <th>Type</th>
                    <th>Loan Amount</th>
                    <th>Loan Tenure</th>
                    <th>Status</th>
                    <th>Download PDF</th>
                  {{-- @if($user->isBankUser() || $user->isAnalyst())
                  <th>Query</th>
                  @endif --}}
                  @if(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                <?php
            /*  echo "<pre>";
              print_r($usrPro[11]->name_of_firm);
              echo "</pre>";
              dd($usrPro);*/
              ?>
              @foreach($loans as $loan)
              <?php
              $labelValue = App\Helpers\FormatHelper::formatLoanType($loan->type);
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
              @if($loan->status > 3)
              <tr>
                @if($loan->companySharePledged!='' && $loan->bscNscCode!='')
                <td><a href=" {{URL::to('loans/praposal/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'.$loan->companySharePledged .'/'.$loan->bscNscCode.'/'. $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
                @else
                <td><a href="{{URL::to('loans/praposal/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'. $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
                @endif
                <td>{!! $loan->getUserProfile['name_of_firm'] !!} </td>
                <td>{!! $labelValue !!}</td>
                <td>{!! $loan->loan_amount !!} Lacs</td>
                <td>{!! $loan->loan_tenure !!} Yr</td>

                <td class="{!! $statusValue !!}">

                  @if($statusValue == 'Application Forwarded to Bank')
                  <a href="{{URL::to('loans/praposal/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'. $loan->id)}}">Create Proposal</a>
                  @elseif($statusValue=='Proposal Approved')
                   <a href="{{URL::to('loans/praposal/loancomment/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'. $loan->id)}}"> {!! $statusValue !!}  </a>
                 
                  @else
                  {!! $statusValue !!} 
                  @endif


                </td>
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

                      {{-- @if($user->isBankUser() || $user->isAnalyst())
                      <td><a href="{{URL::to(" messaging/compose/ ". $loan->id. '/' .$loan->user_id)}}" title="Raise A Query">Raise Query</a></td>
                      @endif --}}
                    </tr>
                    @endif

                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </section>
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
