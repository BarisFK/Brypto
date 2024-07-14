<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{
    use HasFactory;

    protected $table = 'vault';
    protected $fillable = [
        'user_id',
        'title',
        'encrypted_data'
    ];
}
