<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        return $this->index();
    }

    public function index()
    {
        return 'Hello world!';
    }
}
