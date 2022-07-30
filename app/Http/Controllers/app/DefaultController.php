<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function default()
    {
        return view('app.default');
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
