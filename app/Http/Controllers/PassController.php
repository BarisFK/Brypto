<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passwords;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\XFilesController; 


class PassController extends Controller
{
    private $xFilesController; // Add an instance
    public function __construct()
    {
        $this->xFilesController = new XFilesController();
    }

    public function passPage()
    {
        $passwords = Passwords::all(); 
        return view('passwords', compact('passwords'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'desc' => 'required|string|max:255'
        ]);
        
        $validatedData['user_id'] = Auth::id(); //Add pass with authenticated user's id 
        
        //dd($validatedData);
         $encryptionKey = config('app.encryption_key'); // Fetch from .env

         // Hash the password using your custom function
         $validatedData['password'] = $this->xFilesController->encryptMessage(
             $validatedData['password'],
             $encryptionKey
         );

        //dd($validatedData);
        Passwords::create($validatedData);

        return redirect()->route('passPage')->with('success', 'Password Added!');
    }
}
