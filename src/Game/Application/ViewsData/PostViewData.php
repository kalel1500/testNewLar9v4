<?php

declare(strict_types=1);

namespace Src\Post\Application\ViewsData;

use Src\Post\Domain\PostEntity;

final class PostViewData
{
    public function __construct(
        public PostEntity $post,
    )
    {
    }
}
