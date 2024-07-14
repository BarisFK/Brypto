<?php
namespace App\Http\Controllers;

use App\Models\Cards;
use App\Models\Passwords;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // For better date handling

class DashboardController extends Controller
{
    public function index()
    {
        $totalCards = Cards::count();
        $totalPasswords = Passwords::count();
        
        // Check for existing cards before proceeding
        $lastCreatedCard = Cards::latest('created_at')->first(); 

        $mostUsedWebsite = Passwords::select('website')
            ->groupBy('website')
            ->orderByRaw('COUNT(*) DESC')
            ->value('website');

        // Use Carbon for cleaner date calculations
        $expiringSoon = Cards::where('expiry_year', '<', now()->addDays(30)->year)
            ->orWhere(function ($query) {
                $query->where('expiry_year', now()->year)
                       ->where('expiry_month', '<', now()->month);
            })
            ->count();

        $encryptionStatus = "Active"; // Replace with your actual encryption logic

        return view('dashboard', compact(
            'totalCards', 'totalPasswords', 'lastCreatedCard', 'mostUsedWebsite', 
            'expiringSoon', 'encryptionStatus'
        ));
    }
}
