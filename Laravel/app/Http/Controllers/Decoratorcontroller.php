<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decorator;

class DecoratorController extends Controller
{
    public function index()
    {
        $decorators = Decorator::latest()->paginate(10);
        return view('decorator.index', compact('decorators'));
    }
}