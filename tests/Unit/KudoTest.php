<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class KudoTest extends TestCase
{
  use WithoutMiddleware;
  use RefreshDatabase;

  public function test_list_kudos()
  {
    $response = $this->get('/api/kudos');
    $response->assertStatus(200);
  }

  public function test_can_create_kudos()
  {
    //$user = User::factory()->create();
    //$this->actingAs($user);

    $data = [
      'iduser' => 1,
      'idboard' => 1,
      'description' => 'description'
    ];
    $response = $this->post('/api/kudos', $data);
    $response->assertStatus(200);
    //$response->assertJson(['data' => $data]);
  }
}
