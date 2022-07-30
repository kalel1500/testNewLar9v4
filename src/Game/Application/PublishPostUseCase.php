<?php

declare(strict_types=1);

namespace Src\Post\Application;

use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\ValueObjects\PostId;
use Src\Post\Domain\ValueObjects\PostPublished;

final class PublishPostUseCase
{
    private $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        bool $isPublished
    ): void
    {
        $id             = new PostId($id);
        $isPublished    = new PostPublished($isPublished);
        $this->repository->publish($id, $isPublished);
    }
}
