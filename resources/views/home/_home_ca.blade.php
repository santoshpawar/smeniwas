@section('content')
    <div class="row">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

    </div>

    <section style="margin-left: 50px;margin-right: 50px;">
        <div class="panel-body">


            <table id="caGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Name Of Firm</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Purpose Of Loan</th>
                    <th>Entity Type</th>
                    <th>Turnover</th>
                    <th>Req. Loan</th>
                    <th>View Loan</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($userProfile) && count($userProfile) == 0)
                <tr class="text-center">
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;">
                        <a class="btn btn-success btn-cons sme_button" href="{{URL::to('register/ca/sme-client')}}" style = 'margin-top:20px;margin-left:20px;'>New SME Client</a>
                    </td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                </tr>
                @else
                @foreach($userProfile as $value)
                    <tr>
                        <td><a href="{{URL::to('register/wizard/edit-profile/'.$value->user_id)}}">{!! $value->name_of_firm !!}</a></td>
                        <td>{!! $value->owner_name !!}</td>
                        <td>{!! $value->address !!}</td>
                        <td>{!! $value->purpose_of_loan_label !!}</td>
                        <td>{!! $value->owner_entity_type !!}</td>
                        <td>{!! $value->latest_turnover !!} Lacs</td>
                        <td>{!! $value->required_amount !!} Lacs</td>
                        <td><a href="{{URL::to('home/ca-user-loans/'.$value->user_id)}}">View Loans</a></td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
        </div>
    </section>

    <script type="text/template" data-grid="standard" data-template="results">

        <% _.each(results, function(r) { %>

        <tr>
            <td><a href="<%= r.edit_url %>"><%= r.name_of_firm %> </a> </td>
            <td><%= r.owner_name %></td>
            <td><%= r.address %></td>
            <td><%= r.purpose_of_loan_label %></td>
            <td><%= r.owner_entity_type %></td>
            <td><%= r.latest_turnover %> Lacs</td>
            <td><%= r.required_amount %> Lacs</td>
            <td><a href="<%= r.redirect_url %>"><%=r.null %>View Loans</a> </td>
        </tr>

        <% }); %>

    </script>

    <script type="text/template" data-grid="standard" data-template="no_results">
        <tr>
            <td colspan="8">No Results</td>
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

    {{--<script type="text/template" data-grid="standard" data-template="no_filters">--}}
        {{--<i>There are no filters applied.</i>--}}
    {{--</script>--}}

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

            $('#caGrid').dataTable({
                "sDom": "<'row'<'col-sm-12'<'col-sm-6'<'col-sm-3'l><'col-sm-3'T>><'col-sm-6'f>>>" +
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
//            var filterSecond = $("#filterSecond").html('<strong>Filter</strong> : <select id="filters" class="form-control"><option value="">Filter</option> <option value="Approved">Approved Loans</option> <option value="Pending">Pending Loans</option> <option value="Rejected">Rejected Loans</option></select>');
            $(".DTTT_container").css(("margin-top"),5);
            $(".col-sm-3").css(("width"),'initial');

        });
    </script>
@endsection

