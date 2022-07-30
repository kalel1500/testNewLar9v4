<?php

declare(strict_types=1);

namespace Src\Post\Application;

use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\ValueObjects\PostCollection;
use Src\Post\Domain\ValueObjects\PostTitle;

final class SearchPostUseCase
{
    private $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $title): PostCollection
    {
        return $this->repository->search(new PostTitle($title));
    }
}
