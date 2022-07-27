<?php

declare(strict_types=1);

namespace Src\Post\Domain\Contracts;

use Src\Post\Domain\PostEntity;
use Src\Post\Domain\ValueObjects\PostId;
use Src\Post\Domain\ValueObjects\PostPublished;
use Src\Post\Domain\ValueObjects\PostTitle;

interface PostRepositoryContract
{
    public function find(PostId $postId): ?PostEntity;
    public function findByCriteria(PostTitle $postTitle): ?PostEntity;
    public function save(PostEntity $postEntity): void;
    public function update(PostId $postId, PostEntity $postEntity): void;
    public function delete(PostId $postId): void;
    public function publish(PostId $postId, PostPublished $isPublished): void;
}
