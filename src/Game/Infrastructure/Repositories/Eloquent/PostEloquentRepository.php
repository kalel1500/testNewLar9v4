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

        // Return Domain User model
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

    public function findByCriteria(PostTitle $title): ?PostEntity
    {
        $eloquentPost = $this->eloquentModel
            ->where('title', $title->value())
            ->firstOrFail();

        // Return Domain User model
        return new PostEntity(
            new PostId($eloquentPost->id),
            new PostTitle($eloquentPost->title),
            new PostContent($eloquentPost->content),
            new PostPublished($eloquentPost->is_published),
            new PostOwner($eloquentPost->user_id),
        );
    }

    public function save(PostEntity $postEntity): void
    {
        /*$this->eloquentModel->create([
            'title'         => $postEntity->title()->value(),
            'content'       => $postEntity->content()->value(),
            'is_published'  => $postEntity->is_published()->value(),
            'user_id'       => $postEntity->user_id()->value(),
        ]);*/

        $data = $postEntity->toArrayWithoutFields(['id']);
        $this->eloquentModel->create($data);
    }

    public function update(PostId $id, PostEntity $postEntity): void
    {
        /*$this->eloquentModel
            ->findOrFail($id->value())
            ->update([
                'title'         => $postEntity->title()->value(),
                'content'       => $postEntity->content()->value(),
                'isPublished'   => $postEntity->is_published()->value(),
            ]);*/

        $this->eloquentModel
            ->findOrFail($id->value())
            ->update($postEntity->toArrayWithoutFields(['id', 'user_id']));
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
