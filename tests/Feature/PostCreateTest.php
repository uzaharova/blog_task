<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostCreate()
    {
        $this->json('POST', '/api/post_create', ['title' => 'test1', 'description' => 'description1', 'login' => 'user1'])
            ->assertJson([
                'post_id' => true
            ]);
    }
}
