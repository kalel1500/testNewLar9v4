<?php

declare(strict_types=1);

namespace Src\Post\Application\ViewsData;

use Src\Post\Domain\ValueObjects\PostCollection;

final class ListPostsViewData
{
    public function __construct(
        public PostCollection $posts,
    )
    {
    }

}
