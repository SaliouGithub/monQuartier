<?php

namespace App\Http\Controllers;

use App\Models\DelegueQuartier;
use App\Models\Habitant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DelegueQuartierController extends Controller
{
    public function index()
    {
        $delegueQuartiers = DelegueQuartier::all();
        $habitants = Habitant::all();
        return view('pages.delegue.index', compact('delegueQuartiers', 'habitants'));
    }

    public function create(): View
    {
        $habitants = Habitant::all();
        return view('pages.delegue.create', compact('habitants'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        DelegueQuartier::create($input);
        return redirect()->route('pages.delegue.index')->with(['success' => 'Délégué ajouté avec succès']);
    }

    public function show(string $id): View
    {
        $delegueQuartier = DelegueQuartier::find($id);
        return view('pages.delegue.show')->with('delegue', $delegueQuartier);
    }

    public function edit(string $id): View
    {
        $delegueQuartier = DelegueQuartier::find($id);
        $habitants = Habitant::all();
        return view('pages.delegue.edit', compact('delegueQuartier', 'habitants'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $delegueQuartier = DelegueQuartier::find($id);
        $input = $request->all();
        $delegueQuartier->update($input);
        return redirect()->route('pages.delegue.index')->with(['success' => 'Délégué modifié avec succès']);
    }

    public function destroy(string $id): RedirectResponse
    {
        DelegueQuartier::destroy($id);
        return redirect()->route('pages.delegue.index')->with(['success' => 'Délégué supprimé avec succès']);
    }
}
