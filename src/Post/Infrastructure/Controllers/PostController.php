<?php

namespace Src\Post\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Src\Post\Application\CreatePostUseCase;
use Src\Post\Application\DeletePostUseCase;
use Src\Post\Application\GetPostByCriteriaUseCase;
use Src\Post\Infrastructure\Repositories\Eloquent\PostEloquentRepository;
use Src\Post\Application\GetPostUseCase;
use Src\Post\Application\PublishPostUseCase;
use Src\Post\Application\UpdatePostUseCase;

class PostController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PostEloquentRepository();
    }

    public function getPost(Request $request)
    {
        $userId = (int)$request->id;

        $getUserUseCase = new GetPostUseCase($this->repository);
        $postEntity     = $getUserUseCase->__invoke($userId);
    
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $postEntity]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $postEntity]], Response::HTTP_OK);
    }

    public function getPostByCriteria(Request $request)
    {
        $title  = $request->input('title');

        $getUserUseCase = new GetPostByCriteriaUseCase($this->repository);
        $postEntity     = $getUserUseCase->__invoke($title);
        
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $postEntity]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $postEntity]], Response::HTTP_OK);
    }

    public function createPost(Request $request)
    {
        $postTitle          = $request->input('title');
        $postContent        = $request->input('content');
        $postIsPublished    = $request->input('is_published');
        $postUserId         = $request->input('user_id');

        $createUserUseCase = new CreatePostUseCase($this->repository);
        $createUserUseCase->__invoke(
            $postTitle,
            $postContent,
            $postIsPublished,
            $postUserId
        );

        $getUserByCriteriaUseCase = new GetPostByCriteriaUseCase($this->repository);
        $newPost                  = $getUserByCriteriaUseCase->__invoke($postTitle);

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $newPost]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $newPost]], Response::HTTP_OK);
    }

    public function updatePost(Request $request)
    {
        $postId = (int)$request->id;

        $getPostUseCase = new GetPostUseCase($this->repository);
        $postEntity     = $getPostUseCase->__invoke($postId);

        $userTitle          = $request->input('name') ?? $postEntity->title()->value();
        $userContent        = $request->input('email') ?? $postEntity->content()->value();
        $postIsPublished    = $postEntity->is_published()->value();
        $postUserId         = $postEntity->user_id()->value();

        $updateUserUseCase = new UpdatePostUseCase($this->repository);
        $updateUserUseCase->__invoke(
            $postId,
            $userTitle,
            $userContent,
            $postIsPublished,
            $postUserId
        );

        $updatedPost = $getPostUseCase->__invoke($postId);

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $updatedPost]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $updatedPost]], Response::HTTP_OK);
    }

    public function publishManyPosts(Request $request)
    {

        // Obtengo los empleados
        $posts = $request->input('posts');

        $useCase = new PublishPostUseCase($this->repository);

        foreach ($posts as $post) {
            $useCase->__invoke(
                $post['id'],
                $post['is_published']
            );
        }

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'Success', data: []), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => []], Response::HTTP_OK);
    }

    public function deletePost(Request $request)
    {
        $postId = (int)$request->id;

        $deleteUserUseCase = new DeletePostUseCase($this->repository);
        $deleteUserUseCase->__invoke($postId);
    }

}
