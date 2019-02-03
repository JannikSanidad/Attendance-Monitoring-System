<thead>
	<tr>
	    <th>Admin ID</th>
	    <th>Name</th>
	    <th>Login Status</th>
	    <th>Location</th>
	    <th>Action</th>
	</tr>
</thead>
<tbody>
	@foreach($users as $user)

		<tr>
			<td>{{ $user->admin_id }}</td>
			<td>{{ $user->first_name }} {{ $user->last_name }}</td>
			<td><?php if($user->login_status == 1){echo 'Online';} else {echo 'Offline';} ?></td>
			<td><?php if($user->location == NULL){echo 'NULL';} else {echo $user->location;} ?></td>
			<td>
				<a href="/users/{{ $user->admin_id }}" class="btn btn-primary btn-sm">View</a> 
				<a href="/users/{{ $user->admin_id }}/edit" class="btn btn-warning btn-sm">Edit</a> 
				<a href="#" name="{{ $user->admin_id }}" onclick="deleteAdmin(this)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">Delete</a>
			</td>
		</tr>
			
	@endforeach
</tbody>