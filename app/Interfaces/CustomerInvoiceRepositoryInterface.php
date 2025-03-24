<?php

namespace App\Interfaces;

interface CustomerInvoiceRepositoryInterface 
{
    public function getCustomers();
    public function getInvoices();
    public function storeCustomer($data);
    public function storeInvoice($data);
    public function updateCustomer($id, $data);
    public function updateInvoice($id, $data);
    public function findCustomer($id);
    public function findInvoice($id);
}