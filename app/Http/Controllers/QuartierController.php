<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use Illuminate\Http\Request;

class QuartierController extends Controller
{
    public function index()
    {
        $quartiers = Quartier::all();
        return view('pages.quartier.index', compact('quartiers'));
    }
}
