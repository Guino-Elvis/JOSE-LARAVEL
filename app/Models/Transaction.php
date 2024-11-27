<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'products'];

    protected $casts = [
        'products' => 'array', // Esto asegura que el campo 'products' sea tratado como un array JSON
    ];
    
    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
