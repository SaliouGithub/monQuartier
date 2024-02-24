<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.utilisateur.index', compact('users'));
    }

    public function create(): View
    {
        return view('pages.utilisateur.create');
    }
  
 
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        $input = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];
        User::create($input);
        return redirect()->route('pages.utilisateur.index')->with(['success' => 'Utilisateur ajouté avec succès']);
    }

    public function show(string $id): View
    {
        $user = User::find($id);
        return view('pages.utilisateur.show')->with('users', $user);
    }
    public function edit(string $id): View
    {
        $user = User::find($id);
        return view('pages.utilisateur.edit')->with('users', $user);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::find($id);
        $input = $request->all();
        $user->update($input);
        return redirect()->route('pages.utilisateur.index')->with(['success' => 'Utilisateur modifié avec succès']);  
    }
    
    public function destroy(string $id): RedirectResponse
    {
        User::destroy($id);
        return redirect('utilisateur')->with(['success' => 'Utilisateur supprimé avec succès']); 
    }
}
