<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Producto;
use Livewire\Component;

class ProductoPage extends Component
{

    public function render()
    {
        $categorias = Category::all();

        $productos = Producto::all();
        return view('pages.home-page',compact('productos','categorias'));
    }
}
