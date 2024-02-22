<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuartierController extends Controller
{
    public function index()
    {
        $quartiers = Quartier::all();
        $communes = Commune::all();
        return view('pages.quartier.index', compact('quartiers', 'communes'));
    }

    public function create(): View
    {
        $communes = Commune::all();
        return view('pages.quartier.create', compact('communes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Quartier::create($input);
        return redirect()->route('pages.quartier.index')->with(['success' => 'Quartier ajouté avec succès']);
    }

    public function show(string $id): View
    {
        $quartier = Quartier::find($id);
        return view('pages.quartier.show')->with('quartier', $quartier);
    }

    public function edit(string $id): View
    {
        $quartier = Quartier::find($id);
        $communes = Commune::all();
        return view('pages.quartier.edit', compact('quartier', 'communes'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $quartier = Quartier::find($id);
        $input = $request->all();
        $quartier->update($input);
        return redirect()->route('pages.quartier.index')->with(['success' => 'Quartier modifié avec succès']);
    }

    public function destroy(string $id): RedirectResponse
    {
        Quartier::destroy($id);
        return redirect()->route('pages.quartier.index')->with(['success' => 'Quartier supprimé avec succès']);
    }
}
