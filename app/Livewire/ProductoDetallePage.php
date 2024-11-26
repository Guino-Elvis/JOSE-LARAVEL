<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class ProductoDetallePage extends Component
{
    public $producto;

    public function mount($id)
    {
        $this->producto = Producto::findOrFail($id); 
    }
    
    public function render()
    {
        $similares = Producto::where('category_id', $this->producto->category_id)
        ->where('id', '!=', $this->producto->id)
        ->get();

        return view('pages.producto-detalle-page',compact('similares'));
    }
}
