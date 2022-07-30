<?php

declare(strict_types=1);

namespace Src\Game\Domain;

use Src\Game\Domain\ValueObjects\GameCompany;
use Src\Game\Domain\ValueObjects\GameDescription;
use Src\Game\Domain\ValueObjects\GameId;
use Src\Game\Domain\ValueObjects\GameTitle;
use Src\Game\Domain\ValueObjects\GameYear;
use Src\Shared\Domain\Contracts\EntityContract;

final class GameEntity extends EntityContract
{
    public function __construct(
        private GameId $id,
        private GameTitle $title,
        private GameDescription $description,
        private GameYear $year,
        private GameCompany $company_id,
    ) {
    }

    public function id(): GameId
    {
        return $this->id;
    }

    public function title(): GameTitle
    {
        return $this->title;
    }

    public function description(): GameDescription
    {
        return $this->description;
    }

    public function year(): GameYear
    {
        return $this->year;
    }

    public function company_id(): GameCompany
    {
        return $this->company_id;
    }

    public function toArray(): array
    {
        return [
            'id'            => $this->id()->value(),
            'title'         => $this->title()->value(),
            'description'   => $this->description()->value(),
            'year'          => $this->year()->value(),
            'company_id'    => $this->company_id()->value(),
        ];
    }

    public function toArrayWithoutFields(array $fields): array
    {
        $array = [
            'id'            => $this->id()->value(),
            'title'         => $this->title()->value(),
            'description'   => $this->description()->value(),
            'year'          => $this->year()->value(),
            'company_id'    => $this->company_id()->value(),
        ];
        foreach ($fields as $field) {
            unset($array[$field]);
        }

        return $array;
    }

    public static function create(
        GameId $id,
        GameTitle $title,
        GameDescription $description,
        GameYear $year,
        GameCompany $company_id,
    ): self {
        return new self($id, $title, $description, $year, $company_id);
    }
}
