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

        return view('products.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
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


        return view('products.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('products.edit', compact('user'));
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

    public function file()
    {
        return view('file');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt', //Get txt file
            'key' => 'required|string',
        ]);

        $file = $request->file('file');
        $key = $request->input('key');
        $encryptionKey = base64_decode($key); //Decode the key 

    // dd($encryptionKey.'////'.$key);

        try {
            $encryptedData = file_get_contents($file->getRealPath()); // Read data from the file

    // dd($file->getRealPath());

            list($encryptedData, $iv, $tag) = explode('::', base64_decode($encryptedData), 3);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);
            
    //dd($encryptedData.'    '.$iv.'    '.$tag);
    //dd($decryptedData);
    
            if ($decryptedData === false) {

                return back()->with('decryptionError', "Invalid Key or Corrupted Data")
                    ->withInput();
            }

            $originalFilePath = $file->getRealPath();
            file_put_contents($originalFilePath, $decryptedData); //Rewrite the file with decrypted data


            $backupFilePath = $originalFilePath . '.bak'; // Create a backup 
    //dd($backupFilePath);
            copy($originalFilePath, $backupFilePath);

            session(['originalFilePath' => $file->getRealPath()]); // Store in session
            return back()->with('decryptedData', $decryptedData)
                ->withInput();
        } catch (\Exception $e) {
            return back()->with('decryptionError', 'Error decrypting file. Details: ' . $e->getMessage());
        }
    }

}