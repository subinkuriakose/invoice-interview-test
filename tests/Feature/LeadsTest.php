<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Traits\Contacts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadsTest extends TestCase
{
    use RefreshDatabase;
    use Contacts;

    /**
     * Return success if lead page loaded
     */
    public function test_leads_page_loading(): void
    {
        $response = $this->get('/lead');

        $response->assertStatus(200);
    }

    /**
     * Test creating lead and contact
     */
    public function test_create_lead_and_contact(): void
    {
        $lead = Lead::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '9999999999',
            'description' => 'test description',
        ]);
        $this->assertModelExists($lead);

        $dataContact = array(
            'name' => $lead->name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'contact_type' => 'b2c_customer',
            'source_type' => 'lead',
            'lead_id' => $lead->id,
        );

        $contact = $this->createContact($dataContact);

        $this->assertModelExists($contact);
    }

}
