<?php

declare(strict_types=1);

namespace Src\Post\Infrastructure\Repositories\Eloquent;

use Src\Post\Infrastructure\Models\Post as PostEloquentModel;
use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\PostEntity;
use Src\Post\Domain\ValueObjects\PostCollection;
use Src\Post\Domain\ValueObjects\PostContent;
use Src\Post\Domain\ValueObjects\PostId;
use Src\Post\Domain\ValueObjects\PostOwner;
use Src\Post\Domain\ValueObjects\PostPublished;
use Src\Post\Domain\ValueObjects\PostTitle;

final class PostEloquentRepository implements PostRepositoryContract
{
    private $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new PostEloquentModel();
    }
    
    public function all(): PostCollection
    {
        $eloquentAllPosts = $this->eloquentModel->all();

        $array = [];
        foreach($eloquentAllPosts as $eloquentPost) {
            $array[] = new PostEntity(
                new PostId($eloquentPost->id),
                new PostTitle($eloquentPost->title),
                new PostContent($eloquentPost->content),
                new PostPublished($eloquentPost->is_published),
                new PostOwner($eloquentPost->user_id),
            );
        }

        $result = new PostCollection(...$array);

        // Return a collection of Domain Post model
        return $result;
    }

    public function find(PostId $id): ?PostEntity
    {
        $eloquentPost = $this->eloquentModel->findOrFail($id->value());

        // Return Domain User model
        return new PostEntity(
            new PostId($eloquentPost->id),
            new PostTitle($eloquentPost->title),
            new PostContent($eloquentPost->content),
            new PostPublished($eloquentPost->is_published),
            new PostOwner($eloquentPost->user_id),
        );
    }

    public function search(PostTitle $title): PostCollection
    {
        $eloquentPosts = $this->eloquentModel
            ->where('title', 'like', '%'.$title->value().'%')
            ->orWhere('content', 'like', '%'.$title->value().'%')
            ->get();

        $array = [];
        foreach($eloquentPosts as $eloquentPost) {
            $array[] = new PostEntity(
                new PostId($eloquentPost->id),
                new PostTitle($eloquentPost->title),
                new PostContent($eloquentPost->content),
                new PostPublished($eloquentPost->is_published),
                new PostOwner($eloquentPost->user_id),
            );
        }

        return new PostCollection(...$array);
    }

    public function save(PostEntity $post): void
    {
        /*$this->eloquentModel->create([
            'title'         => $post->title()->value(),
            'content'       => $post->content()->value(),
            'is_published'  => $post->is_published()->value(),
            'user_id'       => $post->user_id()->value(),
        ]);*/

        $data = $post->toArrayWithoutFields(['id']);
        $this->eloquentModel->create($data);
    }

    public function update(PostId $id, PostEntity $post): void
    {
        /*$this->eloquentModel
            ->findOrFail($id->value())
            ->update([
                'title'         => $post->title()->value(),
                'content'       => $post->content()->value(),
                'isPublished'   => $post->is_published()->value(),
            ]);*/

        $this->eloquentModel
            ->findOrFail($id->value())
            ->update($post->toArrayWithoutFields(['id', 'user_id']));
    }

    public function delete(PostId $id): void
    {
        $this->eloquentModel
            ->findOrFail($id->value())
            ->delete();
    }

    public function publish(PostId $id, PostPublished $is_published): void
    {
        $this->eloquentModel
            ->findOrFail($id->value())
            ->update(['is_published'   => $is_published->value()]);
    }
}
