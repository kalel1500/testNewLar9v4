<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Search extends Component
{
    public $foo;
    public $search = '';
    public $page = 1;
 
    protected $queryString = [
        'foo',
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];
 
    public function render()
    {
        $posts = Post::query()
            ->where(function($query) {
                if (!str($this->search)->isEmpty()) {
                    //$query->whereFullText('title', $this->search)->orWhereFullText('content', $this->search);
                    //$query->where('title', 'like', '%'.$this->search.'%')->orWhere('content', 'like', '%'.$this->search.'%');

                    //$query->where('title', 'like', '%'.$this->search.'%');
                    $query->whereFullText('title', $this->search);
                }
            })
            ->get();
        return view('livewire.search', ['posts' => $posts]);
    }

}
