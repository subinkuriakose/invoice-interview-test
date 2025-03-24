<x-admin.layout>
	@push('script')
		<script src="{{ asset('assets/admin/js/editInvoice.js') }}"></script>
	@endpush
	<section class="innerpages company-profile-main1 parallaxcont">
		<div class="container">
			<div class="row">
				<h3>Edit Invoice</h3>
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
			
			<form name="edit-invoice" id="editInvoiceForm" action="javascript:void(0);" data-url="{{ route('admin_invoice_update') }}" data-url_redirect="{{ route('admin_invoice_list') }}">
				@csrf
				<div class="mb-3">
					<label for="customer_id" class="form-label">Customer</label>
					<select name="customer_id" class="form-control" id="customer_id">
						<option value="">Select Customer</option>
						@foreach ($customers as $customer)
							<option value="{{ $customer['id'] }}" @if ($customer['idNonEnc'] == $customerId) selected @endif>{{ $customer['name'] }}</option>						
						@endforeach
					</select>
					@error('customer')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
				</div>
				<div class="mb-3">
					<label for="date" class="form-label">Date</label>
					<input type="date" name="date" class="form-control" id="date" value="{{ old('date', $invoice['invoice_date']) }}">
					@error('date')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
				</div>
				<div class="mb-3">
					<label for="amount" class="form-label">Amount</label>
					<input type="text" name="amount" class="form-control" id="amount" value="{{ old('amount', $invoice['amount']) }}">
					@error('amount')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
				</div>
				<div class="mb-3">
					<label for="status" class="form-label">Status</label>
					<select name="status" class="form-control" id="status">
						<option value="">Select Status</option>
						<option value="Unpaid" @if (old('status', $invoice['status']) == 'Unpaid') selected @endif>Unpaid</option>
						<option value="Paid" @if (old('status', $invoice['status']) == 'Paid') selected @endif>Paid</option>
						<option value="Cancelled" @if (old('status', $invoice['status']) == 'Cancelled') selected @endif>Cancelled</option>
					</select>
					@error('status')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
				</div>
				<input type="hidden" name="id" value="{{ $id }}">
				<button type="submit" class="button" name="submit" id="editCustomer">SUBMIT</button>
			</form>
			
	
		</div>
	</section>
	</x-layout>