<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index()
    {
        \Log::debug('Test debug message');
        return view('root.index');
    }
}
