<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopPostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPosts()
    {
        $this->json('GET', '/api/top_posts', ['count' => 1])
            ->assertJson([
                [
                    'title' => true,
                    'description' => true,
                ]
            ]);
    }
}
