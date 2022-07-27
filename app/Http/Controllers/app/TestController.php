<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

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

}
