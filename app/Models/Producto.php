<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory;

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relación polimorfica 1 * 1
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

  
}
