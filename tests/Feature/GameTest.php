<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Game\Application\ViewsData\ListGamesViewData;
use App\Models\Game;
use Src\Game\Infrastructure\Repositories\Eloquent\GameEloquentRepository;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_can_be_created()
    {
        $this->withoutExceptionHandling();

        $dataCreateGame = ['title' => 'Test Game', 'description' => 'Test Game'];
        $response = $this->post('/game/store', $dataCreateGame);

        $response->assertOk();

        $this->assertCount(1, Game::all());

        $game = Game::query()->first();

        // Comparacion de valores
        $this->assertEquals($game->title, $dataCreateGame['title']);
        $this->assertEquals($game->description, $dataCreateGame['description']);
    }
    
    public function test_game_list_can_be_received()
    {
        $this->withoutExceptionHandling();

        // Datos de prueba
        Game::factory(5)->create();

        // Metodo HTTP
        $response = $this->get('/game/list');

        $response->assertOk();

        $repo = new GameEloquentRepository();
        $games = $repo->all();
        $viewData = new ListGamesViewData($games);

        // Comparar valores en la vista
        $response->assertViewIs('app.game.list');
        $response->assertViewHas('viewData', $viewData);
    
    }

}
