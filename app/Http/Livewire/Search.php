<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $foo;
    public $search = '';
    public $page = 1;
 
    protected $queryString = [
        'foo',
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
 
    public function render()
    {
        $posts = Post::query()
            ->where(function($query) {
                if (!str($this->search)->isEmpty()) {
                    // $query->whereFullText('title', $this->search)->orWhereFullText('content', $this->search);
                    $query->where('title', 'like', '%'.$this->search.'%')->orWhere('content', 'like', '%'.$this->search.'%');

                    //$query->where('title', 'like', '%'.$this->search.'%');
                    // $query->whereFullText('title', $this->search);
                }
            })
            ->paginate(10);
        return view('livewire.search', ['posts' => $posts]);
    }

}
