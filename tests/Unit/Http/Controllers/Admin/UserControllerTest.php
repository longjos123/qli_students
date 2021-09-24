<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\Eloquents\UserRepository;

use Tests\TestCase;
use Mockery as m;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $userRepository;
    protected $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = m::mock(UserRepository::class);
        $this->user = m::mock(User::class);
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->user);
        parent::tearDown();
    }

    public function test_detail()
    {
        $userfake = User::factory()->create();
        $this->userRepository->shouldReceive('find')->with(34508)->returnAnd();

        $response = $this->get("admin/students/detail/$userfake->id");
        $response->assertStatus(200);
        $this->assertEquals($response->baseResponse->isSuccessfull(), true);
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }
}