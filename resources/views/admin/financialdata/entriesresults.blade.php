<script type="text/template" data-grid="main" data-template="results">

    <% _.each(results, function(r) { %>

    <tr data-grid-row>
        <td>
            <a href="<%= r.view_uri %>">
                <%= r.entry %>
            </a>
        </td>

        <td>
            <%= r.description %>
        </td>

        <td>
            <%= r.calculation_method %>
        </td>

        <td>
            <%= r.formula_reference %>
        </td>

        <td>
            <%= r.model %>
        </td>

        <td>
            <%= r.attribute %>
        </td>

        <td>
            <%= r.sortorder %>
        </td>

        <td>
            <% if (r.status == 1) { %>
            Active
            <% } else { %>
            Inactive
            <% } %>
        </td>
    </tr>

    <% }); %>

</script>
