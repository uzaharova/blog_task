<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAuthor()
    {
        $this->json('GET', '/api/author_list')
            ->assertJson([
                [
                    'login' => true,
                    'author_ip' => true,
                ]
            ]);
    }
}
