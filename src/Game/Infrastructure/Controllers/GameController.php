<?php

namespace Src\Game\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Game\Application\DeleteGameUseCase;
use Src\Game\Application\FindGameUseCase;
use Src\Game\Application\GetAllGamesUseCase;
use Src\Game\Application\SearchGmeUseCase;
use Src\Game\Application\StoreGameUseCase;
use Src\Game\Application\UpdateGameUseCase;
use Src\Game\Application\ViewsData\FormGameViewData;
use Src\Game\Infrastructure\Repositories\Eloquent\GameEloquentRepository;

class GameController extends Controller
{
    private $repository;

    public function __construct(GameEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    /* ------------------------------------------------------------------------------ */
    /* ----------------------------- REDIRECCIONES ---------------------------------- */

    public function createGame(Request $request)
    {
        $title          = $request->input('title');
        $description    = $request->input('description');
        $year           = (int)$request->input('year');
        $company_id     = $request->input('company_id') ?? 1;

        $storeGameUseCase = new StoreGameUseCase($this->repository);
        $storeGameUseCase(
            $title,
            $description,
            $year,
            $company_id
        );

        $searchGmeUseCase = new SearchGmeUseCase($this->repository);
        $newGame = $searchGmeUseCase($title)->first();

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['game' => $newGame]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['game' => $newGame]], Response::HTTP_OK);
    }

    public function updateGame(Request $request, int $id)
    {
        $findGameUseCase = new FindGameUseCase($this->repository);
        $game = $findGameUseCase($id);

        $title          = $request->input('title') ?? $game->title()->value();
        $description    = $request->input('description') ?? $game->description()->value();
        $year           = (int)$request->input('year') ?? $game->year()->value();
        $company_id     = $game->company_id()->value();

        $updateGameUseCase = new UpdateGameUseCase($this->repository);
        $updateGameUseCase->__invoke(
            $id,
            $title,
            $description,
            $year,
            $company_id
        );

        $updatedGame = $findGameUseCase($id);

        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['game' => $updatedGame]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['game' => $updatedGame]], Response::HTTP_OK);
    }

    public function deleteGame(int $id)
    {
        $deleteGameUseCase = new DeleteGameUseCase($this->repository);
        $deleteGameUseCase($id);
    }

    /* ------------------------------------------------------------------------------ */
    /* ------------------------------------ VISTAS ---------------------------------- */

    public function getAllGames(?string $title)
    {
        $getAllGamesUseCase = new GetAllGamesUseCase($this->repository);
        $searchGamesUseCase = new SearchGmeUseCase($this->repository);
        $games = (!is_null($title)) ? $searchGamesUseCase($title) : $getAllGamesUseCase();
    
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['games' => $games->toArray()]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['games' => $games->toArray()]], Response::HTTP_OK);
    }

    public function findGame(int $id)
    {
        $findGameUseCase = new FindGameUseCase($this->repository);
        $game = $findGameUseCase($id);
    
        return response()->json(arrayJsonResponse(statusCode: 0, message: 'success', data: ['game' => $game]), Response::HTTP_OK);
        //return response()->json(['statusCode' => 0, 'message' => 'success', 'data' => ['game' => $game]], Response::HTTP_OK);
    }

    public function createForm()
    {
        $viewData = new FormGameViewData(false, null);
        return view('app.game.form', compact('viewData'));
    }

    public function updateForm(int $id)
    {
        $findGameUseCase = new FindGameUseCase($this->repository);
        $game = $findGameUseCase($id);
        $viewData = new FormGameViewData(true, $game);
        return view('app.game.form', compact('viewData'));
    }

}
