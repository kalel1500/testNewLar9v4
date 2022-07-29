<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function testEloquent()
    {
        $post = Post::create([
            'title' => 'aa',
            'content' => 'aa',
        ]);
        dd($post);
    }

    public function testResponse()
    {
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => []]), Response::HTTP_OK);
    }
}
