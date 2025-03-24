<?php

namespace App\Traits;

use App\Models\Contact;

trait Contacts
{
        
    /**
     * createContact
     * create a contact when creating an ‘account’ or when creating a ‘lead’
     *
     * @param  array $data
     * @return object
     */
    public function createContact(array $data)
    {
        return Contact::create($data);
    }
}