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

    public function tailwind2()
    {
        return view('app.tests.tailwind2');
    }

    public function livewire()
    {
        return view('app.tests.livewire');
    }
}
