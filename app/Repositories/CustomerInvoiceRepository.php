<?php

namespace App\Repositories;

use App\Interfaces\CustomerInvoiceRepositoryInterface;
use App\Models\Customer;
use App\Models\Invoice;

class CustomerInvoiceRepository implements CustomerInvoiceRepositoryInterface 
{
    public function getCustomers()
    {
        return Customer::get();
    }

    public function getInvoices()
    {
        return Invoice::get();
    }

    public function storeCustomer($data)
    {
        return Customer::create($data);
    }

    public function storeInvoice($data)
    {
        return Invoice::create($data);
    }

    public function updateCustomer($id, $data)
    {
        return Customer::where('id', $id)->update($data);
    }

    public function updateInvoice($id, $data)
    {
        return Invoice::where('id', $id)->update($data);
    }

    public function findCustomer($id)
    {
        return Customer::find($id);
    }

    public function findInvoice($id)
    {
        return Invoice::find($id);
    }
    
    
}
