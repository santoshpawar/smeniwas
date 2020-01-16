<script type="text/template" data-grid="main" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row <%= (r.id == {{ $currentUser->id }}) ? ' disabled' : '' %>>
			<td>
				<input data-grid-checkbox <%= (r.id == {{ $currentUser->id }}) ? ' disabled' : '' %> type="checkbox" name="entries[]" value="<%= r.id %>">
			</td>
			<td>
				<a href="<%= r.edit_uri %>">
					<% if (r.username) { %>
					<%= r.username %>
					<% } else { %>
					N/A
					<% } %>
				</a>
			</td>
			<td><a href="mailto:<%= r.email %>"><%= r.email %></a></td>
			<td class="hidden-xs"><%= moment(r.created_at).format('MMM DD, YYYY') %></td>
		</tr>

	<% }); %>

</script>
