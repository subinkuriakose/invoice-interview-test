<x-admin.layout>
<section class="innerpages company-profile-main1 parallaxcont">
	<div class="container">
		<div class="row">
			<h3 style="width: 80%">Invoices</h3>
			<a style="width: 20%" href="{{ route('admin_invoice_add') }}" class="btn btn-primary">Add Invoice</a>
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
				<th scope="col">Customer</th>
				<th scope="col">Date</th>
				<th scope="col">Amount</th>
				<th scope="col">Status</th>
				<th scope="col">Action</th>
			  </tr>
			</thead>
			<tbody>
				@forelse ($invoices as $key=>$row)
					<tr>
						<th scope="row">{{ $key+1 }}</th>
						<td>{{ $row['customer']; }}</td>
						<td>{{ $row['invoice_date']; }}</td>
						<td>{{ $row['amount']; }}</td>
						<td>{{ $row['status']; }}</td>
						<td>
							<a href="{{ route('admin_invoice_edit', ['id' => $row['id']]) }}">Edit</a>
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