<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Interfaces\CustomerInvoiceRepositoryInterface;
use App\Models\Customer;

use function PHPSTORM_META\map;

class CommonApiController extends Controller
{
    private CustomerInvoiceRepositoryInterface $customerInvoiceRepository;

    public function __construct(CustomerInvoiceRepositoryInterface $customerInvoiceRepository) 
    {
        $this->customerInvoiceRepository = $customerInvoiceRepository;
    }
    
    public function getList(Request $request)
    {
        $rules = [
            'type' => 'required|in:customer,invoice',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
        }

        $type = $request->type;
        if($type == 'customer') {
            $customers = $this->customerInvoiceRepository->getCustomers();
            $customers = $customers->map(function ($row) {
                return array(
                    'id' => $row->idEnc,
                    'name' => $row->name,
                    'email' => $row->email,
                    'phone' => $row->phone,
                    'address' => $row->address,
                );
            });
            return response()->json($customers);
        } else if($type == 'invoice') {
            $invoices = $this->customerInvoiceRepository->getInvoices();
            $invoices = $invoices->map(function ($row) {
                return array(
                    'id' => $row->idEnc,
                    'invoice_date' => $row->invoice_date,
                    'customer' => $row->customer->name,
                    'amount' => $row->amount,
                    'status' => $row->status,
                );
            });
            return response()->json($invoices);
        }        
    }

    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|in:customer,invoice',
            'name' => 'required_if:type,customer',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|max:500',
            'invoice_date' => 'nullable|date',
            'customer_id' => 'required_if:type,invoice',
            'amount' => 'nullable|numeric',
            'status' => 'nullable|in:Unpaid,Paid,Cancelled',
        ];
        $messages = [
            'name.required_if' => 'The name field is required.',
            'customer_id.required_if' => 'The customer field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
        }

        $type = $request->type;
        if($type == 'customer') {
            $rules = [
                'email' => 'unique:customers,email,NULL,id,phone,' . $request->phone,
            ];
            $messages = [
                'email.unique' => 'Customer with the same combination of the email and phone number is already exists.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];
            $this->customerInvoiceRepository->storeCustomer($data);
            return response()->json(['status' => true, 'message' => 'Customer added successfully'], 200);
        } else if($type == 'invoice') {
            try {
                $customerId = Crypt::decryptString($request->customer_id);
            } catch (DecryptException $e) {
                return response()->json(['status' => false, 'message' => 'Invalid customer id'], 201);
            }
            // check if customer exists
            $rules = [
                'customer_id' => function ($attribute, $value, $fail) use ($customerId) {
                    if (!Customer::where('id', $customerId)->exists()) {
                        $fail('The selected customer does not exist.');
                    }
                },
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
            }
            if($request->invoice_date == null) {
                $invoiceDate = Carbon::now();
            }
            $invoiceDate = $request->invoice_date;
            $invoiceDateFormatted = Carbon::parse($invoiceDate)->format('Y-m-d');
            $data = [
                'customer_id' => $customerId,
                'invoice_date' => $invoiceDateFormatted,
                'amount' => $request->amount,
                'status' => $request->status != null ? $request->status : 'Unpaid',
            ];
            $this->customerInvoiceRepository->storeInvoice($data);
            return response()->json(['status' => true, 'message' => 'Invoice added successfully'], 200);
        }
    }

    public function find(Request $request, $id)
    {
        $rules = [
            'type' => 'required|in:customer,invoice',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
        }

        try {
            $id = Crypt::decryptString($request->id);
        } catch (DecryptException $e) {
            return response()->json(['status' => false, 'message' => 'Invalid record'], 201);
        }
        $type = $request->type;
        if($type == 'customer') {
            $customer = $this->customerInvoiceRepository->findCustomer($id);
            if($customer != null) {
                $customerData = array(
                        'id' => $customer->idEnc,
                        'name' => $customer->name,
                        'email' => $customer->email,
                        'phone' => $customer->phone,
                        'address' => $customer->address,
                    );
            } else {
                $customerData = [];
            }
            return response()->json($customerData);
        } else if($type == 'invoice') {
            $invoice = $this->customerInvoiceRepository->findInvoice($id);
            if($invoice != null) {
                $invoiceData = array(
                        'id' => $invoice->idEnc,
                        'invoice_date' => $invoice->invoice_date,
                        'customer' => $invoice->customer->name,
                        'customer_id' => $invoice->customer->idEnc,
                        'amount' => $invoice->amount,
                        'status' => $invoice->status,
                    );
            } else {
                $invoiceData = [];
            }
            return response()->json($invoiceData);
        }        
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'type' => 'required|in:customer,invoice',
            'name' => 'required_if:type,customer',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|max:500',
            'invoice_date' => 'nullable|date',
            'customer_id' => 'required_if:type,invoice',
            'amount' => 'nullable|numeric',
            'status' => 'nullable|in:Unpaid,Paid,Cancelled',
        ];
        $messages = [
            'name.required_if' => 'The name field is required.',
            'customer_id.required_if' => 'The customer field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
        }

        try {
            $id = Crypt::decryptString($request->id);
        } catch (DecryptException $e) {
            return response()->json(['status' => false, 'message' => 'Invalid record, can not update.'], 201);
        }

        $type = $request->type;
        if($type == 'customer') {
            $rules = [
                'email' => 'unique:customers,email,' . $id . ',id,phone,' . $request->phone,
            ];
            $messages = [
                'email.unique' => 'Customer with the same combination of the email and phone number is already exists.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
            }
            
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];
            $this->customerInvoiceRepository->updateCustomer($id, $data);
            return response()->json(['status' => true, 'message' => 'Customer updated successfully'], 200);
        } else if($type == 'invoice') {
            try {
                $customerId = Crypt::decryptString($request->customer_id);
            } catch (DecryptException $e) {
                return response()->json(['status' => false, 'message' => 'Invalid customer id'], 201);
            }
            // check if customer exists
            $rules = [
                'customer_id' => function ($attribute, $value, $fail) use ($customerId) {
                    if (!
                    Customer::where('id', $customerId)->exists()) {
                        $fail('The selected customer does not exist.');
                    }
                },
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validation error occured', 'errors' => $validator->errors()], 201);
            }
            if($request->invoice_date == null) {
                $invoiceDate = Carbon::now();
            }
            $invoiceDate = $request->invoice_date;
            $invoiceDateFormatted = Carbon::parse($invoiceDate)->format('Y-m-d');
            $data = [
                'customer_id' => $customerId,
                'invoice_date' => $invoiceDateFormatted,
                'amount' => $request->amount,
                'status' => $request->status != null ? $request->status : 'Unpaid',
            ];
            $this->customerInvoiceRepository->updateInvoice($id, $data);
            return response()->json(['status' => true, 'message' => 'Invoice updated successfully'], 200);
        }
    }

}