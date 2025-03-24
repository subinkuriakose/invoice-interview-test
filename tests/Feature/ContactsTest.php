<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Return success if contact listing page loaded
     */
    public function test_contact_listing_page_loading(): void
    {
        $response = $this->get('/contacts/list');

        $response->assertStatus(200);
    }

    /**
     * Test creating contact
     */
    public function test_create_contact(): void
    {
        $contact = Contact::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '9999999999',
            'contact_type' => 'b2c_customer',
            'source_type' => 'lead',
        ]);

        $this->assertModelExists($contact);
    }

}
