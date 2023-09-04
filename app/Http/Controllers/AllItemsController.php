<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllItemsController extends Controller
{
    public function index()
    {
    
        return view('items.index');
    }
}
