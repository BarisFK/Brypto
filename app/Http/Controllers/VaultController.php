<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vault;

class VaultController extends Controller
{
    public function vaultPage()
    {
        $vaultItems = Vault::where('user_id', auth()->id())->get(); // Fetch for the logged-in user

        return view('xfiles.vault', compact('vaultItems'));
    }
    public function saveToVault(Request $request)
    {
        $validated = $request->validate([
            'encrypted_data' => 'required',
            'vault_title' => 'required|string|max:255',
        ]);

        // Assuming you have the authenticated user:
        $user = auth()->user();

        Vault::create([
            'user_id' => $user->id,
            'title' => $validated['vault_title'],
            'encrypted_data' => $validated['encrypted_data'],
        ]);

        // Başarı mesajını session'a ekleyin
        return back()->with('success', 'Data saved to vault successfully!');
    }
    public function decryptVault(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'itemId' => 'required|exists:vault,id',
        ]);

        $item = Vault::find($request->input('itemId'));
        $encryptedData = $item->encrypted_data;
        $key = $request->input('key');
        $encryptionKey = base64_decode($key);

        //dd($encryptedData,$key,$encryptionKey);

        try {
            list($encryptedData, $iv, $tag) = explode('::', base64_decode($encryptedData), 3);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);

         //dd($decryptedData);
            if (!$encryptedData || !$iv || !$tag) {
                return back()->with('decryptionError', 'Invalid data format')->withInput();
            }
            if ($decryptedData === false) {
                return back()->with('decryptionError', openssl_error_string())->withInput();
            }

            return back()->with('success', 'Data decrypted successfully!')->with('decryptedData', $decryptedData);
        } catch (\Exception $e) {
            return back()->with('decryptionError', 'Error decrypting data: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteVaultData(Request $request, $id)
    {
        $item = Vault::findOrFail($id);

        $request->validate([
            'key' => 'required|string',
        ]);

        $key = $request->input('key');
        $encryptionKey = base64_decode($key);

        try {
            // Decrypt the data from the database to verify the key
            list($encryptedData, $iv, $tag) = explode('::', base64_decode($item->encrypted_data), 3);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);

            if ($decryptedData === false) {
                return back()->with('decryptionError', "Invalid Key")->withInput();
            }

            $item->delete();

            return back()->with('success', 'Vault item deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('decryptionError', 'Error decrypting data: ' . $e->getMessage());
        }
    }


}
