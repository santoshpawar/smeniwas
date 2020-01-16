<div class="row">
  <div class="card">
    <div class="card-header" data-background-color="green">
      <h3 class="title">Profile Details:  Analyst User</h3>
      {{-- <p class="category">Apply new loan</p> --}}
    </div>
    <div class="card-content">
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
      <div class="clearfix"></div>
      
          @include($sub_view_type)
  
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
