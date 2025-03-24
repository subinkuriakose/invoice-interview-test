<x-admin.layout>
@push('script')
    <script src="{{ asset('assets/admin/js/addCustomer.js') }}"></script>
@endpush
<section class="innerpages company-profile-main1 parallaxcont">
	<div class="container">
		<div class="row">
			<h3>Add Customer</h3>
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
		
		<form name="add-customer" id="addCustomerForm" action="javascript:void(0);" data-url="{{ route('admin_customer_store') }}" data-url_redirect="{{ route('admin_customer_list') }}">
			@csrf
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
				@error('name')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email') }}">
				@error('email')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<div class="mb-3">
				<label for="phone" class="form-label">Phone</label>
				<input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
				@error('phone')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<div class="mb-3">
				<label for="address" class="form-label">Address</label>
				<textarea name="address" class="form-control" id="address">{{ old('address') }}</textarea>
				@error('address')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
			</div>
			<button type="submit" class="button" name="submit" id="editCustomer">SUBMIT</button>
		</form>
		

	</div>
</section>
</x-layout>