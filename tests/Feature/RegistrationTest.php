<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\Contacts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    use Contacts;

    /**
     * Return success if registration page loaded
     */
    public function test_registration_page_loading(): void
    {
        $response = $this->get('/registration');

        $response->assertStatus(200);
    }

    /**
     * Test creating user and contact
     */
    public function test_create_user_and_contact(): void
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $this->assertModelExists($user);

        $dataContact = array(
            'name' => $user->name,
            'email' => $user->email,
            'contact_type' => 'b2c_customer',
            'source_type' => 'registration',
            'user_id' => $user->id,
        );

        $contact = $this->createContact($dataContact);

        $this->assertModelExists($contact);
    }

}
