<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XFilesController extends Controller
{

    public function decryptPage()
    {
        return view('xfiles/decryption');
    }

    public function encryptPage()
    {
        return view('xfiles/encryption');
    }
    public function decryption(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt', //Get txt file
        ]);

        $file = $request->file('file');
        $encryptionKey = config('app.encryption_key');
        //dd($encryptionKey);

        try {
            $encryptedData = file_get_contents($file->getRealPath()); // Read data from the file

            // dd($file->getRealPath());

            list($encryptedData, $iv, $tag) = explode('::', base64_decode($encryptedData), 3);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);

            //dd($encryptedData.'    '.$iv.'    '.$tag.'    '.$encryptionKey);
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

    public function encryption(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required',
        ]);

        $encryptionKey = config('app.encryption_key');
        $encryptedData = $this->encryptMessage($validatedData['message'], $encryptionKey);

        return back()->with('encryptedData', $encryptedData);
    }

    public function encryptMessage($message, $key)
    {
        $encryptionKey = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-gcm'));
        $tag = null;

        $ciphertext = openssl_encrypt($message, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);

        return base64_encode($ciphertext . '::' . $iv . '::' . $tag);
    }

}
