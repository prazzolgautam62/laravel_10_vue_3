<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{

//    use RefreshDatabase;

   public function testLogin()
   {
        // create dummy data 
        // $user = User::factory()->create();
        $requestData = [
            'email' => 'bibek@gmail.com',
            'password' => '12345678',
        ];
        
        $response = $this->post('/login',[
            'email' => $requestData['email'],
            'password' => $requestData['password'],
        ]);
        $response->assertSuccessful();
   }
}
