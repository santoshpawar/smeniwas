<script type="text/template" data-grid="main" data-template="results">

    <% _.each(results, function(r) { %>

    <tr data-grid-row>
        <td>
            <a href="<%= r.view_uri %>">
                <%= r.type %>
            </a>
        </td>
        <td>
            <%= r.name %>
        </td>

        <td>
            <%= r.description %>
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

        <td>
            <a href="<%= r.edit_uri %>">
                Edit
            </a>
        </td>
    </tr>

    <% }); %>

</script>
