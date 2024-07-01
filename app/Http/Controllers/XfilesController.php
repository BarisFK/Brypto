<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XfilesController extends Controller
{
    
    public function decryptPage()
    {
        return view('xfiles/decryption');
    }

    public function decryption(Request $request)
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

    public function encryptPage()
    {
        return view('xfiles/encryption');
    }

    public function encryption(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required',
            'key' => 'required',
        ]);

        $encryptedData = $this->encryptMessage($validatedData['message'], $validatedData['key']);

        return back()->with('encryptedData', $encryptedData);
    }

    private function encryptMessage($message, $key)
    {
        $encryptionKey = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-gcm'));
        $tag = null;

        $ciphertext = openssl_encrypt($message, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);

        return base64_encode($ciphertext . '::' . $iv . '::' . $tag);
    }

    public function vaultPage()
    {
        return view('xfiles/vault');
    }
}
