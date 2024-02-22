<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MaisonController extends Controller
{
    public function index()
    {
        $maisons = Maison::all();
        return view('pages.maison.index', compact('maisons'));
    }

    public function create(): View
    {
        return view('pages.maison.create');
    }
  

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Maison::create($input);
        return redirect()->route('pages.maison.index')->with(['success' => 'Maison ajoutée avec succès']);
    }

    public function show(string $id): View
    {
        $maison = Maison::find($id);
        return view('pages.maison.show')->with('maisons', $maison);
    }
    public function edit(string $id): View
    {
        $maison = Maison::find($id);
        return view('pages.maison.edit')->with('maisons', $maison);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $maison = Maison::find($id);
        $input = $request->all();
        $maison->update($input);
        return redirect()->route('pages.maison.index')->with(['success' => 'Maison modifiée avec succès']);  
    }
    
    public function destroy(string $id): RedirectResponse
    {
        Maison::destroy($id);
        return redirect('maison')->with(['success' => 'Maison supprimée avec succès']); 
    }
}
