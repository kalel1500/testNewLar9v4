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

        $newPost = Post::query()->select('id','title','content','is_published','user_id')->first();

        // Comparacion de valores
        $this->assertEquals($newPost->title, $dataCreateProject['title']);
        $this->assertEquals($newPost->content, $dataCreateProject['content']);
        
        
        // Comparar la estructura de la respuesta
        $response->assertJsonStructure([
            'statusCode',
            'message',
            'data' => [
                'post' => ['id', 'title', 'content', 'is_published', 'user_id']
            ],
        ]);

        // Comprobar el valor del json
        $shoudReceive = ['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $newPost->toArray()]];
        $response->assertExactJson($shoudReceive);
    }

    public function test_post_list_can_be_received()
    {
        $this->withoutExceptionHandling();

        // Datos de prueba
        Post::factory(5)->create();

        // Metodo HTTP
        $response = $this->get('/json/post/list');

        $response->assertOk();

        // Comparar la estructura de la respuesta
        $response->assertJsonStructure([
            'statusCode',
            'message',
            'data' => [
                'posts' => [
                    '*' => [
                        'id',
                        'title',
                        'content',
                        'is_published',
                        'user_id',
                    ]
                ]
            ],
        ]);

        // Comprobar el valor del json
        $posts = Post::query()->select('id','title','content','is_published','user_id')->get()->toArray();
        $shoudReceive = ['statusCode' => 0, 'message' => 'success', 'data' => ['posts' => $posts]];
        $response->assertExactJson($shoudReceive);
    
    }
}
