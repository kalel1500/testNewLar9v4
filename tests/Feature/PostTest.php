<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_can_be_created()
    {
        $this->withoutExceptionHandling();

        $dataCreateProject = ['title' => 'Test Post', 'content' => 'Test Post'];
        $response = $this->post('/json/post/create', $dataCreateProject);

        $response->assertOk();

        $this->assertCount(1, Post::all());

        $post = Post::query()->first();

        // Comparacion de valores
        $this->assertEquals($post->title, $dataCreateProject['title']);
        $this->assertEquals($post->content, $dataCreateProject['content']);
    }

    public function test_post_list_can_be_received()
    {
        $this->withoutExceptionHandling();

        // Datos de prueba
        Post::factory(5)->create();

        // Metodo HTTP
        $response = $this->get('/json/post/list');

        $response->assertOk();

        //$posts = Post::all();

        // TODO Canals - mirar como comprobar json

        // Comparar valores en la vista
        //$response->assertViewIs('app.post.list');
        //$response->assertViewHas('posts', $posts);
    
    }
}
