<?php

namespace Src\Post\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Post\Application\DeletePostUseCase;
use Src\Post\Application\FindPostUseCase;
use Src\Post\Application\GetAllPostsUseCase;
use Src\Post\Application\PublishPostUseCase;
use Src\Post\Application\SearchPostUseCase;
use Src\Post\Application\StorePostUseCase;
use Src\Post\Application\UpdatePostUseCase;
use Src\Post\Infrastructure\Repositories\Eloquent\PostEloquentRepository;

class JsonPostController extends Controller
{
    private $repository;

    public function __construct(PostEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPosts(?string $title)
    {
        $getAllPostsUseCase = new GetAllPostsUseCase($this->repository);
        $searchPostUseCase = new SearchPostUseCase($this->repository);
        $posts = (!is_null($title)) ? $searchPostUseCase($title) : $getAllPostsUseCase();
        
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['allPosts' => $posts->toArray()]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['allPosts' => $allPosts->toArray()]], Response::HTTP_OK);
    }

    public function findPost(int $id)
    {
        $getPostUseCase = new FindPostUseCase($this->repository);
        $postEntity     = $getPostUseCase->__invoke($id);
    
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $postEntity]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $postEntity]], Response::HTTP_OK);
    }

    public function createPost(Request $request)
    {
        $title          = $request->input('title');
        $content        = $request->input('content');
        $is_published   = $request->input('is_published') ?? false;
        $user_id        = $request->input('user_id') ?? 1;

        $storePostUseCase = new StorePostUseCase($this->repository);
        $storePostUseCase(
            $title,
            $content,
            $is_published,
            $user_id
        );

        $searchPostUseCase = new SearchPostUseCase($this->repository);
        $newPost = $searchPostUseCase($title)->first();

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $newPost]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $newPost]], Response::HTTP_OK);
    }

    public function updatePost(Request $request, int $id)
    {
        $findPostUseCase = new FindPostUseCase($this->repository);
        $postEntity = $findPostUseCase($id);

        $title          = $request->input('title') ?? $postEntity->title()->value();
        $content        = $request->input('content') ?? $postEntity->content()->value();
        $is_published   = $postEntity->is_published()->value();
        $user_id        = $postEntity->user_id()->value();

        $updatePostUseCase = new UpdatePostUseCase($this->repository);
        $updatePostUseCase->__invoke(
            $id,
            $title,
            $content,
            $is_published,
            $user_id
        );

        $updatedPost = $findPostUseCase($id);

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $updatedPost]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $updatedPost]], Response::HTTP_OK);
    }

    public function publishManyPosts(Request $request)
    {
        // Obtengo los posts
        $posts = $request->input('posts');

        $publishPostUseCase = new PublishPostUseCase($this->repository);

        foreach ($posts as $post) {
            $publishPostUseCase($post['id'],$post['is_published']);
        }

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'Success', data: []), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => []], Response::HTTP_OK);
    }

    public function deletePost(int $id)
    {
        $deletePostUseCase = new DeletePostUseCase($this->repository);
        $deletePostUseCase->__invoke($id);
    }

}
