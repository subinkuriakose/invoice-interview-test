<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require('AccountService.php');
require('ContactService.php');

// Creating a contact from an Account
$accountData = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@example.com',
    'phone' => '1234567890'
];

$accountService = new AccountService();
$contactService = new ContactService($accountService);
$contact = $contactService->createContact($accountData);

echo "Contact created from Account: " . $contact->getId() . "\n";