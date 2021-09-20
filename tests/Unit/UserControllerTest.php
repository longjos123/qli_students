<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_db()
    {
        // $auth = $this->get(route('student.show'));

        // $auth->assertStatus(200);
       $this->assertDatabaseHas('users', [
           'username' => 'longdang',
       ]);
    }
}