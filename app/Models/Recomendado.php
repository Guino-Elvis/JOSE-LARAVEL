<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendado extends Model
{
    use HasFactory;
        // Definir los campos que pueden ser asignados masivamente
        protected $fillable = [
            'user_id',
            'recommended_products',
        ];

        //Relación 1 a * inversa
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
