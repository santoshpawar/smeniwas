<script type="text/template" data-grid="main" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td>
					<%= r.questionnumber %>
			</td>

			<td>
				<a href="<%= r.view_uri %>">
					<%= r.question_label %>
				</a>
			</td>

			<td>
				<%= r.category_label %>
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
