<?php
require_once('ContactSource.php');
require_once('Contact.php');
class AccountService implements ContactSource {
    public function createContact(array $data): Contact {
        // Assume $data contains the necessary information to create a contact
        $contact = new Contact(
            $data['first_name'], 
            $data['last_name'], 
            $data['email'], 
            $data['phone'], 
            'Account'
        );
        
        // Logic to save the contact in the database
        $contact->setId(uniqid()); // Generating a unique ID for the contact
        return $contact;
    }
}
