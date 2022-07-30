<?php

declare(strict_types=1);

namespace Src\Post\Application\ViewsData;

use Src\Post\Domain\PostEntity;

final class FormPostViewData
{
    public function __construct(
        public bool $isUpdate,
        public PostEntity $postToUpdateEntity,
    )
    {
    }

}
