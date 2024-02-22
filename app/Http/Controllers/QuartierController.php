<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Models\Commune;
use Illuminate\Http\Request;

class QuartierController extends Controller
{
    public function index()
    {
        $quartiers = Quartier::all();
        $communes = Commune::all();
        return view('pages.quartier.index', compact('quartiers', 'communes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $communes = Commune::all();
        Commune::create($input);
        return redirect()->route('pages.commune.index')->with(['success' => 'Commune ajoutée avec succès']);
    }


}
