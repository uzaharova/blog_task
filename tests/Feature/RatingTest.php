<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RatingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRatingCreate()
    {
        $this->json('POST', '/api/add_rating', ['post_id' => 1, 'rating' => 5])
            ->assertJson([
                'rating_average' => true
            ]);
    }
}
