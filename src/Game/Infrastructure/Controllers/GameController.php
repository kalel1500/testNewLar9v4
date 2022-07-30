<?php

namespace Src\Game\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Post\Application\CreatePostUseCase;
use Src\Post\Application\DeletePostUseCase;
use Src\Post\Application\GetAllPostsUseCase;
use Src\Post\Application\GetPostByCriteriaUseCase;
use Src\Post\Application\GetPostUseCase;
use Src\Post\Application\PublishPostUseCase;
use Src\Post\Application\UpdatePostUseCase;
use Src\Post\Application\ViewsData\FormPostViewData;
use Src\Post\Infrastructure\Repositories\Eloquent\PostEloquentRepository;

class GameController extends Controller
{
    private $repository;

    public function __construct(PostEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    /* ------------------------------------------------------------------------------ */
    /* ----------------------------- REDIRECCIONES ---------------------------------- */

    public function createPost(Request $request)
    {
        $postTitle          = $request->input('title');
        $postContent        = $request->input('content');
        $postIsPublished    = $request->input('is_published') ?? false;
        $postUserId         = $request->input('user_id') ?? 1;

        $createPostUseCase = new CreatePostUseCase($this->repository);
        $createPostUseCase->__invoke(
            $postTitle,
            $postContent,
            $postIsPublished,
            $postUserId
        );

        $getPostByCriteriaUseCase = new GetPostByCriteriaUseCase($this->repository);
        $newPost                  = $getPostByCriteriaUseCase->__invoke($postTitle);

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $newPost]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $newPost]], Response::HTTP_OK);
    }

    public function updatePost(Request $request, $id)
    {
        $getPostUseCase = new GetPostUseCase($this->repository);
        $postEntity     = $getPostUseCase->__invoke($id);

        $postTitle          = $request->input('name') ?? $postEntity->title()->value();
        $postContent        = $request->input('email') ?? $postEntity->content()->value();
        $postIsPublished    = $postEntity->is_published()->value();
        $postUserId         = $postEntity->user_id()->value();

        $updatePostUseCase = new UpdatePostUseCase($this->repository);
        $updatePostUseCase->__invoke(
            $id,
            $postTitle,
            $postContent,
            $postIsPublished,
            $postUserId
        );

        $updatedPost = $getPostUseCase->__invoke($id);

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $updatedPost]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $updatedPost]], Response::HTTP_OK);
    }

    public function publishManyPosts(Request $request)
    {
        // Obtengo los posts
        $posts = $request->input('posts');

        $publishPostUseCase = new PublishPostUseCase($this->repository);

        foreach ($posts as $post) {
            $publishPostUseCase->__invoke(
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

        $deletePostUseCase = new DeletePostUseCase($this->repository);
        $deletePostUseCase->__invoke($postId);
    }

    /* ------------------------------------------------------------------------------ */
    /* ------------------------------------ VISTAS ---------------------------------- */

    public function getAllPosts()
    {
        $getAllPostsUseCase = new GetAllPostsUseCase($this->repository);
        $allPosts     = $getAllPostsUseCase->__invoke();
    
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['allPosts' => $allPosts->toArray()]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['allPosts' => $allPosts->toArray()]], Response::HTTP_OK);
    }

    public function getPost($id)
    {
        $getPostUseCase = new GetPostUseCase($this->repository);
        $postEntity     = $getPostUseCase->__invoke($id);
    
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $postEntity]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $postEntity]], Response::HTTP_OK);
    }

    public function getPostByCriteria($title)
    {
        $getPostByCriteriaUseCase   = new GetPostByCriteriaUseCase($this->repository);
        $postEntity                 = $getPostByCriteriaUseCase->__invoke($title);
        
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['post' => $postEntity]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['post' => $postEntity]], Response::HTTP_OK);
    }

    public function updateForm($id)
    {
        $getPostUseCase = new GetPostUseCase($this->repository);
        $postEntity = $getPostUseCase($id);
        $viewData = new FormPostViewData(true, $postEntity);
        return view('app.post.form', compact('viewData'));
    }

}
