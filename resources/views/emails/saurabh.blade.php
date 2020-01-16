 
<!DOCTYPE html>
<html lang="en">
<body>

	<h3>New Query Received</h3>
<table >
	<tbody>
		<tr>
			<td>Name of Firm </td>
			<td>  {{ $name_of_firm }}</td>
		</tr>
		<tr>
			<td> Owner of entity</td>
			<td>{{ $owner_entity_type }} </td>
		</tr>
		<tr>
			<td> Owner Name</td>
			<td>{{ $owner_name }} </td>
		</tr>
		<tr>
			<td> Address</td>
			<td>{{ $address }} </td>
		</tr>
		<tr>
			<td>City </td>
			<td> {{ $owner_city }}</td>
		</tr>
		<tr>
			<td>Contact </td>
			<td>{{ $contact1 }} </td>
		</tr>
		<tr>
			<td>Purpose of Loan </td>
			<td>{{ $owner_purpose_of_loan }} </td>
		</tr>
		<tr>
			<td>Required Amount</td>
			<td>{{ $required_amount }} </td>
		</tr>
	</tbody>
</table>

</body>
</html>
