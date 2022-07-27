<?php

declare(strict_types=1);

namespace Src\Post\Application;

use Src\Post\Domain\Contracts\PostRepositoryContract;
use Src\Post\Domain\PostEntity;
use Src\Post\Domain\ValueObjects\PostTitle;

final class GetPostByCriteriaUseCase
{
    private $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $title): ?PostEntity
    {
        return $this->repository->findByCriteria(new PostTitle($title));
    }
}
