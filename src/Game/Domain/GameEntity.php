<?php

declare(strict_types=1);

namespace Src\Post\Domain;

use Src\Post\Domain\ValueObjects\PostContent;
use Src\Post\Domain\ValueObjects\PostId;
use Src\Post\Domain\ValueObjects\PostOwner;
use Src\Post\Domain\ValueObjects\PostPublished;
use Src\Post\Domain\ValueObjects\PostTitle;
use Src\Shared\Domain\Contracts\EntityContract;

final class PostEntity extends EntityContract
{
    public function __construct(
        private PostId $id,
        private PostTitle $title,
        private PostContent $content,
        private PostPublished $is_published,
        private PostOwner $user_id,
    ) {
    }

    public function id(): PostId
    {
        return $this->id;
    }

    public function title(): PostTitle
    {
        return $this->title;
    }

    public function content(): PostContent
    {
        return $this->content;
    }

    public function is_published(): PostPublished
    {
        return $this->is_published;
    }

    public function user_id(): PostOwner
    {
        return $this->user_id;
    }

    public function toArray(): array
    {
        return [
            'id'            => $this->id()->value(),
            'title'         => $this->title()->value(),
            'content'       => $this->content()->value(),
            'is_published'  => $this->is_published()->value(),
            'user_id'       => $this->user_id()->value(),
        ];
    }

    public function toArrayWithoutFields(array $fields): array
    {
        $array = [
            'id'            => $this->id()->value(),
            'title'         => $this->title()->value(),
            'content'       => $this->content()->value(),
            'is_published'  => $this->is_published()->value(),
            'user_id'       => $this->user_id()->value(),
        ];
        foreach ($fields as $field) {
            unset($array[$field]);
        }

        return $array;
    }

    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        PostPublished $is_published,
        PostOwner $user_id,
    ): self {
        return new self($id, $title, $content, $is_published, $user_id);
    }
}
