@extends('app_header')
@section('head-content')
        <?php
            if(!isset($resultsTemplate)) {
                $resultsTemplate = 'admin.grid.no_results';
            }
            if(!isset($paginationTemplate)) {
                $paginationTemplate = 'admin.grid.pagination';
            }
            if(!isset($filtersTemplate)) {
                $filtersTemplate = 'admin.grid.filters';
            }
            if(!isset($noResultsTemplate)) {
                $noResultsTemplate = 'admin.grid.no_results';
            }
        ?>
        @include($resultsTemplate)
        @include($paginationTemplate)
        @include($filtersTemplate)
        @include($noResultsTemplate)
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $('.tip').tooltip();
    </script>
    <script src="{{ URL::asset('js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
    <script>
    /*    // Code to make the ul visible
        $('.dropdown-toggle').dropdown();
        // Code added by rahul to change the color of the dropdown under export and filter
        $("button.btn.btn-default.dropdown-toggle").next().children().css({'background-color':'#FFF'});
        $("button.btn.btn-default.dropdown-toggle").next().children().children().css({'color':'#000'});
        // Setup DataGrid
        var grid = $.datagrid('main', '#data-grid', '#data-grid_pagination', '#datadata-grid_applied',
                {
                    throttle: 20,
                    loader: '.loader',
                    callback: function (obj) {
                        // Select the correct value on the per page dropdown
                        $('[data-per-page]').val(obj.opt.throttle);
                        // Disable the export button if no results
                        $('button[name="export"]').prop('disabled', (obj.pagination.filtered === 0) ? true : false);
                    }
                }
        );*/
        // Date Picker
        /*
         $('.datePicker').datetimepicker({
         pickTime: false
         });
         */
        /**
         * DEMO ONLY EVENTS
         */
        $('[data-per-page]').on('change', function () {
            grid.setThrottle($(this).val());
            grid.refresh();
        });
    </script>

  <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('css/jquery-ui.css') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js_new/jquery.validate.js') }}"></script>
@endsection
