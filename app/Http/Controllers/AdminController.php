<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // For password hashing
use Illuminate\Validation\Rule; // For validation rules


class AdminController extends Controller
{
    public function profilepage()
    {
        return view('profile');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('created_at', 'DESC')->get();

        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:3|confirmed', // Use 'confirmed' for password confirmation
            'type' => 'required|string|in:user,admin', // Limit types
        ]);

        // Hash the Password
        $validatedData['password'] = Hash::make($validatedData['password']);
        //dd($validatedData);
        if ($validatedData['type'] == "user") {
            $validatedData['type'] = 0;
        } else {
            $validatedData['type'] = 1;
        }
        //Create the User
        User::create($validatedData);

        //Redirect with Success Message
        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);  // 1. Fetch User and Validate Input


        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id !== Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
        }

        $validatedData = $request->validate([
            'type' => ['required', Rule::in(['user', 'admin'])],
            'oldpass' => ['required'],
            'password' => ['required', 'confirmed', 'min:1'],
            'password_confirmation' => ['required'],
        ]);
        if (!Hash::check($request->oldpass, $user->password)) {
            return redirect()->back()->withErrors(['oldpass' => 'Incorrect old password']);
        }

        $user->type = $validatedData['type'] === 'admin' ? 1 : 0;

        // Only update the password if a new one was provided
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        dd($user->save());
        if ($user->save()) {
            return redirect()->route('users.index')->with('success', 'User updated');
        } else {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the user.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('success', ' User deleted');
    }


    public function cardsPage()
    {
        return view('cards');
    }
}