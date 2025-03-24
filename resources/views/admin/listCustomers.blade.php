<x-admin.layout>
<section class="innerpages company-profile-main1 parallaxcont">
	<div class="container">
		<div class="row">
			<h3 style="width: 80%">Customers</h3>
			<a style="width: 20%" href="{{ route('admin_customer_add') }}" class="btn btn-primary">Add Customer</a>
		</div>
		@if(session('msgSuccess'))
			<div class="alert alert-primary" role="alert">
				{{ session('msgSuccess') }}
			</div>
		@endif
		@if(session('msgError'))
			<div class="alert alert-danger" role="alert">
			{{ session('msgError') }}
			</div>
		@endif
		
		<table class="table">
			<thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
				<th scope="col">Address</th>
				<th scope="col">Action</th>
			  </tr>
			</thead>
			<tbody>
				@forelse ($customers as $key=>$row)
					<tr>
						<th scope="row">{{ $key+1 }}</th>
						<td>{{ $row['name']; }}</td>
						<td>{{ $row['email']; }}</td>
						<td>{{ $row['phone']; }}</td>
						<td>{{ $row['address']; }}</td>
						<td>
							<a href="{{ route('admin_customer_edit', ['id' => $row['id']]) }}">Edit</a>
						</td>
					</tr>
				@empty
					No records found
				@endforelse
			</tbody>
		</table>
		

	</div>
</section>
</x-layout>