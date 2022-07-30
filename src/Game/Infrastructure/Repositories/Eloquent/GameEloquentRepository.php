<?php

declare(strict_types=1);

namespace Src\Game\Infrastructure\Repositories\Eloquent;

use Src\Game\Domain\Contracts\GameRepositoryContract;
use Src\Game\Domain\GameEntity;
use Src\Game\Domain\ValueObjects\GameCollection;
use Src\Game\Domain\ValueObjects\GameCompany;
use Src\Game\Domain\ValueObjects\GameDescription;
use Src\Game\Domain\ValueObjects\GameId;
use Src\Game\Domain\ValueObjects\GameTitle;
use Src\Game\Domain\ValueObjects\GameYear;
use Src\Game\Infrastructure\Models\Game as GameEloquentModel;

final class GameEloquentRepository implements GameRepositoryContract
{
    private $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new GameEloquentModel();
    }
    
    public function all(): GameCollection
    {
        $eloquentAllGames = $this->eloquentModel->all();

        $array = [];
        foreach($eloquentAllGames as $eloquentModel) {
            $array[] = new GameEntity(
                new GameId($eloquentModel->id),
                new GameTitle($eloquentModel->title),
                new GameDescription($eloquentModel->description),
                new GameYear($eloquentModel->year),
                new GameCompany($eloquentModel->company_id),
            );
        }

        $result = new GameCollection(...$array);

        // Return Domain User model
        return $result;
    }

    public function find(GameId $id): ?GameEntity
    {
        $eloquentGame = $this->eloquentModel->findOrFail($id->value());

        // Return Domain User model
        return new GameEntity(
            new GameId($eloquentGame->id),
            new GameTitle($eloquentGame->title),
            new GameDescription($eloquentGame->description),
            new GameYear($eloquentGame->year),
            new GameCompany($eloquentGame->company_id),
        );
    }

    public function sarch(GameTitle $title): GameCollection
    {
        $eloquentGames = $this->eloquentModel
            ->where('title', $title->value())
            ->orWhere('description', $title->value())
            ->orWhere('year', $title->value())
            ->get();

        $array = [];
        foreach($eloquentGames as $eloquentModel) {
            $array[] = new GameEntity(
                new GameId($eloquentModel->id),
                new GameTitle($eloquentModel->title),
                new GameDescription($eloquentModel->description),
                new GameYear($eloquentModel->year),
                new GameCompany($eloquentModel->company_id),
            );
        }

        return new GameCollection(...$array);
    }

    public function save(GameEntity $game): void
    {
        /*$this->eloquentModel->create([
            'title'         => $game->title()->value(),
            'content'       => $game->content()->value(),
            'is_published'  => $game->is_published()->value(),
            'user_id'       => $game->user_id()->value(),
        ]);*/

        $data = $game->toArrayWithoutFields(['id']);
        $this->eloquentModel->create($data);
    }

    public function update(GameId $id, GameEntity $game): void
    {
        /*$this->eloquentModel
            ->findOrFail($id->value())
            ->update([
                'title'         => $game->title()->value(),
                'content'       => $game->content()->value(),
                'isPublished'   => $game->is_published()->value(),
            ]);*/

        $this->eloquentModel
            ->findOrFail($id->value())
            ->update($game->toArrayWithoutFields(['id', 'user_id']));
    }

    public function delete(GameId $id): void
    {
        $this->eloquentModel
            ->findOrFail($id->value())
            ->delete();
    }
}
