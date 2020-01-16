<script type="text/template" data-grid="main" data-template="results">

    <% _.each(results, function(r) { %>

    <tr data-grid-row>
        <td>
            <input data-grid-checkbox type="checkbox" name="entries[]" value="<%= r.id %>">
        </td>
        <td>
            <a href="<%= r.edit_uri %>">
                <%= r.name %>
            </a>
        </td>
        <td><%= r.value %></td>
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
