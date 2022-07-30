<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Post\Infrastructure\Models\Post;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_can_be_created()
    {
        $this->withoutExceptionHandling();

        $dataCreateProject = ['title' => 'Test Post', 'content' => 'Test Post'];
        $response = $this->post('/createPost', $dataCreateProject);

        $response->assertOk();

        $this->assertCount(1, Post::all());

        $post = Post::query()->first();

        // Comparacion de valores
        $this->assertEquals($post->title, $dataCreateProject['title']);
        $this->assertEquals($post->content, $dataCreateProject['content']);
    }

}
