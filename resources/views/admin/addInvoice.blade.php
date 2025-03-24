<x-admin.layout>
@push('script')
    <script src="{{ asset('assets/admin/js/addInvoice.js') }}"></script>
@endpush
<section class="innerpages company-profile-main1 parallaxcont">
	<div class="container">
		<div class="row">
			<h3>Create Invoice</h3>
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
		<div class="alert alert-danger" id="responseErrMessage" role="alert" style="display:none;">
		</div>
		
		<form name="add-customer" id="addInvoiceForm" action="javascript:void(0);" data-url="{{ route('admin_invoice_store') }}" data-url_redirect="{{ route('admin_invoice_list') }}">
			@csrf
			<div class="mb-3">
				<label for="customer_id" class="form-label">Customer</label>
				<select name="customer_id" class="form-control" id="customer_id">
					<option value="">Select Customer</option>
					@foreach ($customers as $customer)
						<option value="{{ $customer['id'] }}">{{ $customer['name'] }}</option>						
					@endforeach
				</select>
				@error('customer')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<div class="mb-3">
				<label for="date" class="form-label">Date</label>
				<input type="date" name="date" class="form-control" id="date">
				@error('date')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<div class="mb-3">
				<label for="amount" class="form-label">Amount</label>
				<input type="text" name="amount" class="form-control" id="amount" value="{{ old('amount') }}">
				@error('amount')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<div class="mb-3">
				<label for="status" class="form-label">Status</label>
				<select name="status" class="form-control" id="status">
					<option value="">Select Status</option>
					<option value="Unpaid">Unpaid</option>
					<option value="Paid">Paid</option>
					<option value="Cancelled">Cancelled</option>
				</select>
				@error('status')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<button type="submit" class="button" name="submit" id="editCustomer">SUBMIT</button>
		</form>
		

	</div>
</section>
</x-layout>