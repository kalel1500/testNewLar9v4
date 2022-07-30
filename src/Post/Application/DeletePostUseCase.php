<?php

declare(strict_types=1);

namespace Src\Post\Application;

use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\ValueObjects\PostId;

final class DeletePostUseCase
{
    private $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): void
    {
        $this->repository->delete(new PostId($id));
    }
}
