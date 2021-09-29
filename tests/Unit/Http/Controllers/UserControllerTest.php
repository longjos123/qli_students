<?php

namespace Tests\Unit\Http\Controllers;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Service\UserService;
use App\Service\PointService;
use App\Models\Point;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mockery as m;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = m::mock(UserService::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->userService);   
    }
   
    /**
     * @test
     *
     * @covers ::show
     */
    // public function test_show()
    // {
    //     $userMock = User::factory(1)->make();
    //     $this->userService->shouldReceive('getAll')->andReturn($userMock);

    //     $response = $this->get("/admin/students/students-show/");
    //     $response->assertStatus(200);
    //     $this->assertEquals($response->baseResponse->isSuccessful(), true);
    // }

    public function test_login_post()
    {
        $userMock = User::factory()->make();
       
        $this->userService->shouldReceive('findUser')
            ->with('userMock->id')
            ->andReturn();

        $response = $this->post('/',[
            'username' => $userMock->username,
            'password' => $userMock->password,
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('/students-show');
        $response->assertStatus(302);
    }
    

}