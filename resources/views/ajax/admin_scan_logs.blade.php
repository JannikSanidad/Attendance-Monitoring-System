
<thead>
	<tr id="header-row">
	    <th>Student No.</th>
	    <th>Name</th>
	    <th>Attendance Type</th>
	    <th>Time</th>
	    <th>Location</th>
	</tr>
</thead>

<tbody>
	@foreach($attendance_logs as $logs)

		<tr>
			<td>{{ $logs->student_id }}</td>
			<td>{{ $logs->name }}</td>
			<td><?php if($logs->attendance_status == 1){echo 'Time In';} else {echo 'Time Out';} ?></td>
			<td>{{ $logs->created_at }}</td>
			<td>{{ $logs->location }}</td>
		</tr>
			
	@endforeach
</tbody>
	