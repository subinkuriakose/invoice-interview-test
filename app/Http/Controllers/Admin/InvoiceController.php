<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

class InvoiceController extends Controller
{   
    /**
     * index. List customers
     *
     * @return void
     */
    public function index(Request $request)
    {
        $url = url('/api/customer-invoice/list?type=invoice');
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get($url);
        if ($response->successful()) {
            $invoices = $response->json();
        } else {
            $invoices = [];
            $message = $response->body();
            session()->flash('msgError', $message);
        }

        return view('admin.listInvoices', compact('invoices'));
    }

    public function add(Request $request)
    {
        $url = url('/api/customer-invoice/list?type=customer');
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get($url);
        if ($response->successful()) {
            $customers = $response->json();
        } else {
            $customers = [];
        }

        return view('admin.addInvoice', compact('customers'));
    }

    public function store(Request $request)
    {
        $url = url('/api/customer-invoice/add-data');
        $params = [
            'type' => 'invoice',
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->date,
            'amount' => $request->amount,
            'status' => $request->status,
        ];
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->post($url, $params);
        if ($response->successful()) {
            session()->flash('msgSuccess', 'Data added successfully');
            return $message = $response->body();
        } else {
            // return $response->body();
            return 'error';
        }
    }

    public function edit(Request $request, $id)
    {
        $url = url('/api/customer-invoice/find-data/'.$id);
        $params = [
            'type' => 'invoice',
        ];
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get($url, $params);
        if ($response->successful()) {
            $invoice = $response->json();
        } else {
            $invoice = [];
            $message = $response->body();
            session()->flash('msgError', $message);
        }

        $url = url('/api/customer-invoice/list?type=customer');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get($url);
        if ($response->successful()) {
            $customers = $response->json();
            foreach($customers as $key=>$row) {
                try {
                    $idNonEnc = Crypt::decryptString($row['id']);
                } catch (DecryptException $e) {
                    $idNonEnc = '';
                }
                $customers[$key]['idNonEnc'] = $idNonEnc;
            }
        } else {
            $customers = [];
        }

        try {
            $customerId = Crypt::decryptString($invoice['customer_id']);
        } catch (DecryptException $e) {
            $customerId = '';
        }

        return view('admin.editInvoice', compact('invoice', 'customers', 'id', 'customerId'));
    }

    public function update(Request $request)
    {
        $url = url('/api/customer-invoice/update-data/'.$request->id);
        $params = [
            'type' => 'invoice',
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->date,
            'amount' => $request->amount,
            'status' => $request->status,
        ];
        
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->put($url, $params);
        if ($response->successful()) {
            session()->flash('msgSuccess', 'Invoice updated successfully');
            return $message = $response->body();
        } else {
            // return $response->body();
            return 'error';
        }
    }



}
