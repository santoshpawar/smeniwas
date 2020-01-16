 <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">Google Search <span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
       {{--    <p class="category">Apply new loan</p> --}}
   </div>
   <div class="card-content">
    <div class="col-md-12 input">
    <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
        <?php $counter = 0; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-6">

                    @if(isset($promotersKycDetails))
                    @foreach ($promotersKycDetails as $key => $promoter)
                    {!!Form::hidden('promoter['.$key.'][kyc_name]',$promoter->kyc_name,array('id'=>'promoter_' . $key,'class' =>'form-control'))!!}
                    @endforeach
                    @endif

                    {!!Form::text('gs',$loanUserProfile->name_of_firm,array('id'=>'gs','class' =>'form-control'))!!}
                    </div>
                <div class="col-md-6">
                    {!! Form::button('Search', array('id' => 'gsBtn', 'class' => 'btn btn-success btn-cons sme_button', 'value'=>'Search', 'style' => 'margin-left:20px;')) !!}
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12" style="margin-left:20px;">
                <?php
                $backDiv = 'Div6';
                if ($isPL) {
                    $backDiv = 'Div7';
                }
                ?>
                {!! Form::button('<i class="fa fa-reply"></i> Back', array('class' => 'btn btn-success btn-cons
                    sme_button', 'onclick' => "showTab('$backDiv','$loanType','$endUseList', $amount, $loanTenure,
                    '$loanId'); return false;", 'value'=> 'Back', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    @if($user->isSME() || $user->isBankUser())
                    {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    @endif
                    {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    @if(Auth::user()->isAnalyst())
                    {!! Form::submit('Save & Continue', array('class' => 'btn btn-success btn-cons sme_button', 'value'=>
                    'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}

                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="padding:0">Search Result</h4>
        </div>
        <div class="modal-body">
            <p id="loading"><img src="http://www.bba-reman.com/images/fbloader.gif" /></p>
            <div id="searchResult"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-right:15px">Close</button>
        </div>
    </div>

</div>
</div>


<div id="dialog" title="Error" style="position: relative">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
{{--<button id="opener">Open Dialog</button>--}}

@section('footer')

<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {

        var promoters = [];

        $("input[id*='promoter_']").each(function (i, el) {
            promoters.push($(el).val()); 
        });

            //console.log(promoters);
            
            $('#gsBtn').click(function(){
                $('#myModal').modal({
                    keyboard: false,
                    backdrop: 'static'
                })
                $('#searchResult').html('');
                $('#loading').show();
                $.post('http://koala.app/google', {q:$('#gs').val(), p:['ankit mehta', 'rahul singh']}, function(res) {
                    var results = JSON.parse(res);

                    console.log(results);

                    var html = '';

                    if (results.data.length > 0) {

                        $('#loading').hide();
                        $('#searchResult').show();

                        html += '<ul class="gs_result">';

                        $.each(results.data, function(i, item) {
                            console.log(i, item);

                            html += '<li><a href="'+ item.link +'" target="_blank">' + item.linkTitle + '</a>' +
                            '<div><p>'+ item.shortText+'</p></div>'    
                            '</li>';

                        });

                        html += '</ul>';

                        console.log(html);

                        $('#searchResult').html(html);

                    } else {
                        $('#loading').hide();
                        $('#searchResult').html('<p>No results found!</p>');
                    }
                })
            });
        });
    </script>

    <script>

        $(function() {
            $( "#dialog" ).dialog({
                autoOpen: false,
                modal:true,
                width: 800,
                resizable: true,
                buttons: {
                    OK: function() {
                        $( this ).dialog( "close" );
                    }
                },
                show: {
                    effect: "blind",
                    duration: 100
                },
                hide: {
                    effect: "explode",
                    duration: 1000
                }

            }).prev(".ui-dialog-titlebar").css("background","#9cbd31").prev(".ui-dialog-buttonset").css("text-align","center");
        });

        @if (count($errors) > 0)
        $(window).scrollTop($(this).scrollTop() + $(this).height());
        $(function() {
            $( "#dialog" ).dialog( "open" );
        });
        @endif

        $('a').tooltip();
    </script>
    @endsection