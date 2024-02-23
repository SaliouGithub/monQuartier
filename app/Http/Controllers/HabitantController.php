<?php

namespace App\Http\Controllers;

use App\Models\Habitant;
use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HabitantController extends Controller
{
    public function index()
    {
        $habitants = Habitant::all();
        $maisons = Maison::all();
        return view('pages.habitant.index', compact('habitants', 'maisons'));
    }

    public function create(): View
    {
        $maisons = Maison::all();
        return view('pages.habitant.create', compact('maisons'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Habitant::create($input);
        return redirect()->route('pages.habitant.index')->with(['success' => 'Habitant ajouté avec succès']);
    }

    public function show(string $id): View
    {
        $habitant = Habitant::find($id);
        return view('pages.habitant.show')->with('habitant', $habitant);
    }

    public function edit(string $id): View
    {
        $habitant = Habitant::find($id);
        $maisons = Maison::all();
        return view('pages.habitant.edit', compact('habitant', 'maisons'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $habitant = Habitant::find($id);
        $input = $request->all();
        $habitant->update($input);
        return redirect()->route('pages.habitant.index')->with(['success' => 'Habitant modifié avec succès']);
    }

    public function destroy(string $id): RedirectResponse
    {
        Habitant::destroy($id);
        return redirect()->route('pages.habitant.index')->with(['success' => 'Habitant supprimé avec succès']);
    }
}
