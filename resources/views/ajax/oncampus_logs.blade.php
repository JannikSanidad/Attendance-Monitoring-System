<thead>
	<tr>
	    <th>Student No.</th>
	    <th>Name</th>
	    <th>Time</th>
	    <th>Location</th>
	</tr>
</thead>
<tbody>
	@foreach($students as $student)

		<tr>
			<td>{{ $student->student_id }}</td>
			<td>{{ $student->name }}</td>
			<td>{{ $student->created_at }}</td>
			<td>{{ $student->location }}</td>
		</tr>
			
	@endforeach
</tbody>