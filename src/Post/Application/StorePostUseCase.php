<?php

declare(strict_types=1);

namespace Src\Post\Application;

use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\PostEntity;
use Src\Post\Domain\ValueObjects\PostContent;
use Src\Post\Domain\ValueObjects\PostId;
use Src\Post\Domain\ValueObjects\PostOwner;
use Src\Post\Domain\ValueObjects\PostPublished;
use Src\Post\Domain\ValueObjects\PostTitle;

final class StorePostUseCase
{
    private $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $title,
        string $content,
        bool $isPublished,
        int $userId
    ): void
    {
        $id             = new PostId(null);
        $title          = new PostTitle($title);
        $content        = new PostContent($content);
        $isPublished    = new PostPublished($isPublished);
        $userId         = new PostOwner($userId);

        $user = PostEntity::create($id, $title, $content, $isPublished, $userId);

        $this->repository->save($user);
    }
}
