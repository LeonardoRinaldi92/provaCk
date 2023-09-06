<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use App\Models\Ice;
use App\Models\Equipement;
use App\Models\Glass;

class AllItemsController extends Controller
{
    public function index()
    {
        $ice = Ice::all();
        $equipment = Equipement::all();
        $glass = Glass::all();

        $items = Collection::make([
            $ice,
            $equipment,
            $glass
        ])->collapse()->sortBy('name');


        return view('items.index', compact('items'));
    }
}
