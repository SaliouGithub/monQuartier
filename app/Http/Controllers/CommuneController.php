<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::all();
        return view('pages.commune.index', compact('communes'));
    }

    public function create(): View
    {
        return view('pages.commune.create');
    }
  

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Commune::create($input);
        return redirect()->route('pages.commune.index')->with(['success' => 'Commune ajoutée avec succès']);
    }

    public function show(string $id): View
    {
        $commune = Commune::find($id);
        return view('pages.commune.show')->with('communes', $commune);
    }
    public function edit(string $id): View
    {
        $commune = Commune::find($id);
        return view('pages.commune.edit')->with('communes', $commune);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $commune = Commune::find($id);
        $input = $request->all();
        $commune->update($input);
        return redirect()->route('pages.commune.index')->with(['success' => 'Commune modifiée avec succès']);  
    }
    
    public function destroy(string $id): RedirectResponse
    {
        Commune::destroy($id);
        return redirect('commune')->with(['success' => 'Commune supprimée avec succès']); 
    }
}
