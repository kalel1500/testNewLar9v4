<?php

declare(strict_types=1);

namespace Src\Post\Application;

use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\ValueObjects\PostCollection;

final class GetAllPostsUseCase
{
    private $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): PostCollection
    {
        return $this->repository->all();
    }
}
