<tr>
	<th>Student ID</th>
	<th>STATUS</th>
	<th>TIMESTAMP</th>	
</tr>

@foreach($logs as $value)
	
	<tr>
		<td>{{ $value->student_id }}</td>
		<td><?php if($value->attendance_status == 1){echo 'TIME IN';} else {echo 'TIME OUT';} ?></td>
		<td>{{ $value->created_at }}</td>
	</tr>

@endforeach