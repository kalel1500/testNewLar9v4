<?php

declare(strict_types=1);

namespace Src\Post\Domain\Contracts;

use Src\Post\Domain\PostEntity;
use Src\Post\Domain\ValueObjects\PostCollection;
use Src\Post\Domain\ValueObjects\PostId;
use Src\Post\Domain\ValueObjects\PostPublished;
use Src\Post\Domain\ValueObjects\PostTitle;

interface PostRepositoryContract
{
    public function all(): PostCollection;
    public function find(PostId $id): ?PostEntity;
    public function search(PostTitle $postTitle): PostCollection;
    public function save(PostEntity $post): void;
    public function update(PostId $id, PostEntity $post): void;
    public function delete(PostId $id): void;
    public function publish(PostId $id, PostPublished $isPublished): void;
}
