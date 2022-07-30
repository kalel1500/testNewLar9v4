@php /** @var Src\Game\Application\ViewsData\ListGamesViewData $viewData */ @endphp

<x-layouts.app>

    <x-cards.simple>

        @foreach ($viewData->games as $game)
            <div>
                {{ $game->title()->value() }}
            </div>
        @endforeach


    </x-cards.simple>

</x-layouts.app>
