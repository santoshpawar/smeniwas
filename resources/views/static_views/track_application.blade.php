<section class="content_style">
    <div class="carousel fade-carousel" data-ride="carousel" id="bs-carousel">
        <div class="carousel-inner">
            <div class="item slides active">
                <div class="slide-6"></div>
                {{--<div class="hero">--}}
                {{--<hgroup>--}}
                {{--<h2 class="loan_advisor" style="margin-bottom: 125px; font-weight:bold;">Register User</h2>--}}
                {{--</hgroup>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row  roundedbox">
        <div class="col-md-12">
            <h3 class="center-align2"><span>Track Your Application</span></h3>
        </div>
        <div class="col-md-12 paragraph_style">
            <p>Enter the Loan ID in following text box,after verification a mail and SMS of the loan status will be provided to the registered user.<br></p>
        </div>
        {!! Form::model(null,['method' =>'POST','action' => $formaction] ) !!}
        <div class="col-md-12 paragraph_style" >
            <div class="form-group">
                {!! Form::label('loan_id','Loan ID ', ['class' => '']) !!}
                {!! Form::text('loan_id', null, array('class' => 'form-control', 'id'=>'loan_id', 'placeholder'=>'Enter Loan ID','required'=>'true')) !!}
            </div>
            <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
        {!! Form::close() !!}
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </div>
</div>