<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class ProductosPorCategoria extends Component
{
    public $categoria;

    public function mount($id)
    {
        $this->categoria = Category::findOrFail($id);
    }

    public function render()
    {
        $productos = $this->categoria->productos ?? collect(); 
        return view('pages.productos-por-categoria', compact('productos'));
    }
}
