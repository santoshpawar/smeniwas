<script type="text/template" data-grid="main" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td>
				<a href="<%= r.view_uri %>">
					<%= r.loan_type %>
				</a>
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
