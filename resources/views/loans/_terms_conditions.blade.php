<div class="col-md-9">
    <div class="tab-content tab-design" style="padding-left:10px;padding-top:20px;padding-right:25px;">
        <div class="row" style="margin-left:10px">
            <div class="col-md-12">
                <div id="yearQue37" class="form-group">
                    <div id="topcust" class="panel panel-success">
                        <div class="panel-heading">Terms of Service
                        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                        </div>
                        <div class="panel-body">
                            <div style="padding:10px; max-height: 300px;overflow-y: scroll;overflow-x: hidden;">
                                <p>{!! $termsConditions!!}</p>
                            </div>
                    </div>
                    </div>

                    <div class="col-lg-12 col-sm-12" style="margin-left:20px;">
                        <label class="checkbox">
                            <input name="" type="checkbox" value="agree1" id="agree1"><b>I agree to share information with partner banks</b>
                        </label>
                        <label class="checkbox">
                            <input name="" type="checkbox" value="agree2" id="agree2"><b>I agree with the terms of use</b>
                        </label>
                    </div>

                </div>
            </div>
        </div>
        {{--<div class="center-align" style="margin:0px 25px;"></div>--}}
        <div class="row">
            <div class="col-md-12">
                {!! Form::button('Back <i class="fa fa-reply"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div6','$loanType','$endUseList', $amount, $loanTenure, $loanId); return false;", 'value'=> 'Back', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                {!! Form::button('Submit <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
            </div>
        </div>
    </div>
</div>

@section('footer')
    <script type="text/javascript">
        function validate() {
            var remember1 = document.getElementById('agree1');
            var remember2 = document.getElementById('agree2');
            if (!remember1.checked || !remember2.checked){
                alert("You must agree to the terms first.")
                return false;
            }
        }
    </script>
@endsection