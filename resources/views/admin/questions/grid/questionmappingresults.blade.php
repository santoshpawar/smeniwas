<script type="text/template" data-grid="main" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td>
				<%= r.condition_name %>
			</td>

			<td>
				<%= r.field_name %>
			</td>

			<td>
				<%= r.clause %>
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
