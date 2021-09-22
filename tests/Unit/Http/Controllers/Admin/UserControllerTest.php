<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use App\Repositories\Eloquents\UserRepository;

use PHPUnit\Framework\TestCase;
use Mockery;

class UserControllerTest extends TestCase
{
    protected $userRepository, $point, $class, $subject, $mockObject;
    public function setUp():void
    {
        parent::setUp();
        $this->userRepository = Mockery::mock(UserRepository::class);
        // $this->mockObject = Mockery::mock(User::class);

        // $this->user = new UserController($this->mockObject);
        
    }

    public function tearDown():void
    {
        Mockery::close();
        unset($this->user);
        parent::tearDown();
    }

    public function test_list()
    {
        $userfake = User::factory()->create();
        if($userfake->id){
            $this->userRepository->shouldReceive('find')->with($userfake->id)->returnAnd();
        }else{
            return '404';
        }
        
        $response = $this->get("admin/students/detail/$userfake->id");
        $response->assertStatus(200);
        $this->assertEquals($response->baseResponse->isSuccessfull(),true);
        
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }
}