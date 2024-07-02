<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'card_owner',
        'card_no',
        'card_cvv',
        'expiry_month',
        'expiry_year',

    ];
}
