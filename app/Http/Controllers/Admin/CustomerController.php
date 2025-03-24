<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CustomerController extends Controller
{   
    /**
     * index. List customers
     *
     * @return void
     */
    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        $url = url('/api/customer-invoice/list?type=customer');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get($url);
        if ($response->successful()) {
            $customers = $response->json();
        } else {
            $customers = [];
            $message = $response->body();
            session()->flash('msgError', $message);
        }

        return view('admin.listCustomers', compact('customers'));
    }

    public function add()
    {
        return view('admin.addCustomer');
    }

    public function store(Request $request)
    {
        $url = url('/api/customer-invoice/add-data');
        $params = [
            'type' => 'customer',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->post($url, $params);
        if ($response->successful()) {
            session()->flash('msgSuccess', 'Customer added successfully');
            return $message = $response->body();
        } else {
            // return $response->body();
            return 'error';
        }

        return redirect()->route('customer_list');
    }

    public function edit(Request $request, $id)
    {
        $url = url('/api/customer-invoice/find-data/'.$id);
        $params = [
            'type' => 'customer',
        ];
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->get($url, $params);
        if ($response->successful()) {
            $customer = $response->json();
        } else {
            $customer = [];
            $message = $response->body();
            session()->flash('msgError', $message);
        }

        return view('admin.editCustomer', compact('customer', 'id'));
    }

    public function update(Request $request)
    {
        $url = url('/api/customer-invoice/update-data/'.$request->id);
        $params = [
            'type' => 'customer',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $token = $request->session()->get('token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->put($url, $params);
        if ($response->successful()) {
            session()->flash('msgSuccess', 'Customer updated successfully');
            return $message = $response->body();
        } else {
            // return $response->body();
            return 'error';
        }

        return redirect()->route('customer_list');
    }



}
