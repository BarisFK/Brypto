<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Http\Request;


class CardsController extends Controller
{

    public function cardsPage()
    {
        $cards = Cards::all(); 
        return view('cards', compact('cards'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'card_owner' => 'required|string|max:255',
            'card_no' => 'required|string',
            'card_cvv' => 'required|string|max:3',
            'expiry_month' => 'required|numeric|min:1|max:12',
            'expiry_year' => 'required|numeric|min:24|max:36',

        ]);

        Cards::create($validatedData);

        return redirect()->route('cardsPage')->with('success', 'Kart başarıyla eklendi!');
    }


}
