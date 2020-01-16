<div class="container-fluid">
    <div class="row">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
    <!-- Tab panes -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid main-container">
                        <div class="col-md-12 content">
                        </div>
                        <div class="clearfix"></div>
                        <div class="row" style="margin-left:20px;">
                            <div class="col" style="margin-left:20px;">
                                @include($sub_view_type)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- end container -->

@section('footer')
    <script>
        $(document).ready(function()
        {
            $('#loan_product').select2({
                allowClear: true,
                placeholder: "Select Loan Product Type"
            });
            $('#loan_tenure').select2({
                allowClear: true,
                placeholder: "Select Tenure"
            });
        });
    </script>
@append


