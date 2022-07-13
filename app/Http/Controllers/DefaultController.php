<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function default()
    {
        return view('default');
    }

    public function tailwind()
    {
        return view('app.tests.tailwind');
    }

    public function livewire()
    {
        return view('app.tests.livewire');
    }
}
