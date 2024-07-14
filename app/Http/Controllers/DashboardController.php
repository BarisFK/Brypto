<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use App\Models\Passwords;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCards = Cards::count();
        $totalPasswords = Passwords::count();

        $lastCreatedCard = Cards::orderBy('created_at', 'desc')->first(); // Assuming you track last_used 
        $mostUsedWebsite = Passwords::select('website')
            ->groupBy('website')
            ->orderByRaw('COUNT(*) DESC')
            ->value('website');

        // Calculate expiring cards based on your logic (e.g., within the next 30 days)
        $expiringSoon = Cards::where('expiry_year', '<', now()->addDays(30)->year)
            ->orWhere(function ($query) {
                $query->where('expiry_year', now()->year)
                      ->where('expiry_month', '<', now()->month);
            })
            ->count();

        $encryptionStatus = "Active"; // Replace with your actual encryption status logic
        
        return view('dashboard', compact(
            'totalCards', 'totalPasswords', 'lastCreatedCard', 'mostUsedWebsite', 
            'expiringSoon', 'encryptionStatus'
        ));
    }
}