<?php

namespace App\Livewire;

use App\Models\Producto;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ProductoDetallePage extends Component
{
    public $producto;
    public $idproducto;
    public $mensaje = '';

    public function mount($id)
    {
        $this->producto = Producto::findOrFail($id);

        $viewedProducts = session()->get('guardar_productos', []);

        // Ensure no duplicates
        if (!in_array($id, $viewedProducts)) {
            $viewedProducts[] = $id;
        }

        session()->put('guardar_productos', $viewedProducts);

        // If the user has viewed at least 5 products, save the transaction
        if (count($viewedProducts) >= 5) {
            $this->storeTransaction($viewedProducts);
            $this->mensaje = '¡Felicidades! Has alcanzado el objetivo de recomendaciones.';
        }
    }

    public function storeTransaction($viewedProducts)
    {
        // Avoid duplicate transactions
        if (Transaction::where('user_id', Auth::user()->id)->where('products', json_encode($viewedProducts))->exists()) {
            return;
        }

        // Save the transaction
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->products = json_encode($viewedProducts);
        $transaction->save();

        session()->forget('guardar_productos');

        return response()->json(['message' => 'Transacción guardada correctamente']);
    }

    public function render()
    {
        $similares = Producto::where('category_id', $this->producto->category_id)
            ->where('id', '!=', $this->producto->id)
            ->get();

        $mensaje = $this->mensaje;
        return view('pages.producto-detalle-page', compact('similares', 'mensaje'));
    }

   
}
