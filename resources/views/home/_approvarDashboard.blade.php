<?php $user = Auth::user(); ?>
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
          <table id="smeGrid" class="display responsive nowrap" cellspacing="0" width="100%">
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
                @endif @if(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))
                <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @if(isset($loans) && count($loans) == 0)
              <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;">
                  <a class="btn btn-success btn-cons sme_button pull-left" href="{{URL::to('/loans/index')}}" style='margin-top:10px;margin-bottom: 10px;'>Create New Loan</a>                  {{-- <a class="btn btn-success btn-cons sme_button pull-left" href="{{URL::to('/loans/wizard')}}" style='margin-top:10px;margin-bottom: 10px;'>Load Advisor</a>                  --}}
                </td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                @if($user->isBankUser() || $user->isAnalyst())
                <td style="border:none;"></td>
                @endif @if(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))
                <td style="border:none;"></td>
                @endif
              </tr>
              @else @foreach($loans as $loan)
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
                @if($loan->companySharePledged!='' && $loan->bscNscCode!='')
                <td><a href=" {{URL::to('loans/praposal/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'.$loan->companySharePledged .'/'.$loan->bscNscCode.'/'. $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
                @else
                <td><a href="{{URL::to('loans/praposal/company-background/'. $loan->type. '/' .$loan->end_use. '/' .$loan->loan_amount. '/' .$loan->loan_tenure. '/'. $loan->id)}}">{!! isset($loan->getUserProfile->name_of_firm) ? $loan->getUserProfile->name_of_firm : '' !!} [# {!! $loan->id !!}]</a></td>
                @endif
                <td>{!! $labelValue !!}</td>
                <td>{!! $loan->loan_amount !!} Lacs</td>
                <td>{!! $loan->loan_tenure !!} Yr</td>
                <td class="{!! $statusValue !!}">
                   {!! $statusValue !!}
                </td>
                <td>
                  @if($statusValue == 'Application Form Pending')
                  <a href="{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}" style="pointer-events: none;cursor: default;">Download PDF</a>                  @else
                  <a href="{{action('Pdf\PrintController@getIndex', ['id' => $loan->id])}}">Download PDF</a> @endif
                </td>
                @if( ($user->isSME() && $statusValue == 'Application Form Pending') && ($isDiscardApplication && isset($isDiscardApplication))
                )
                <td><a class="btn" id="discard_application" onclick="discardApplication('{{$statusValue}}','{{$loan->id}}')">Discard current application</a></td>
                @elseif(($isDiscardApplication && isset($isDiscardApplication)) && ($user->isSME()))
                <td></td>
                @endif 

                @if($user->isBankUser() || $user->isAnalyst())
                <td><a href="{{URL::to(" messaging/compose/ ". $loan->id. '/' .$loan->user_id)}}" title="Raise A Query">Raise Query</a></td>
                @endif
              </tr>
              @endforeach @endif
            </tbody>
          </table>
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
