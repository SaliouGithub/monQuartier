<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }

     
    public function create(): View
    {
        return view('pages.user.create');
    }
  
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        User::create($input);
        return redirect('pages.user.index')->with('flash_message', 'User Addedd!');
    }
    public function show(string $id): View
    {
        $user = User::find($id);
        return view('pages.user.show')->with('users', $user);
    }
    public function edit(string $id): View
    {
        $user = User::find($id);
        return view('pages.user.edit')->with('users', $user);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::find($id);
        $input = $request->all();
        $user->update($input);
        return redirect('user')->with('flash_message', 'user Updated!');  
    }
    
    public function destroy(string $id): RedirectResponse
    {
        User::destroy($id);
        return redirect('user')->with('flash_message', 'user deleted!'); 
    }
}
