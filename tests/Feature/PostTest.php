<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    public function test_post_create()
    {

        $payload = [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ];

        $this->json('POST', '/api/posts', $payload)
            ->assertStatus(201)
            ->assertJson([
                'id'=> 1,
                'title' => 'Test Title',
                'body' => 'Test Body',

            ]);

    }

    public function test_post_update()
    {
        $post =Post::factory(1)->create();

        $payload = [
            'title' => 'Test Title5',
            'body' => 'Test Body5',
        ];

        $this->json('PUT', '/api/posts/'.$post->id, $payload)
            ->assertStatus(201)
            ->assertJson([
                $post->id,
                'title' => 'Test Title5',
                'body' => 'Test Body5',

            ]);
    }

    public function test_post_delete()
    {
        $post =Post::factory(1)->create();

        $this->json('DELETE', '/api/posts/'.$post->id)
            ->assertStatus(204);
    }


    public function test_post_list()
    {
        Post::factory()->create([
            'title' => 'Test Title1',
            'body' => 'Test Body1',
        ]);
        Post::factory()->create([
            'title' => 'Test Title2',
            'body' => 'Test Body2',
        ]);


        $this->json('GET', '/api/posts')
            ->assertStatus(200)
            ->assertJson([
                ['title' => 'Test Title1','body' => 'Test Body1'],
                ['title' => 'Test Title2','body' => 'Test Body2'],
            ]);
    }
}
