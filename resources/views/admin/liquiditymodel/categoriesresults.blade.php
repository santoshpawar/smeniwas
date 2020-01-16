<script type="text/template" data-grid="main" data-template="results">

    <% _.each(results, function(r) { %>

    <tr data-grid-row>
        <td>
            <a href="<%= r.view_uri %>">
                <%= r.label %>
            </a>
        </td>

        <td>
            <%= r.description %>
        </td>

        <td>
            <%= r.weight %>
        </td>

        <td>
            <% if (r.status == 1) { %>
            Active
            <% } else { %>
            Inactive
            <% } %>
        </td>

        <td>
            <a href="<%= r.edit_uri %>">
                Edit
            </a>
        </td>
    </tr>

    <% }); %>

</script>
