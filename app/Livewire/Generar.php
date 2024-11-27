<?php

namespace App\Livewire;

use App\Models\Producto;
use App\Models\Recomendado;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Generar extends Component
{
    public function render()
    {
        $userLogin = Auth::user();
        $transactions = Transaction::where('user_id', $userLogin->id)->get();

        // Inicializar recomendaciones como un array vacío
        $recommendations = [];

        // Si hay transacciones previas, buscar productos recomendados
        if (!$transactions->isEmpty()) {
            foreach ($transactions as $transaction) {
                $products = json_decode($transaction->products);

                foreach ($products as $productId) {
                    $product = Producto::find($productId);
                    if ($product) {
                        // Obtener productos similares y agregarlos a las recomendaciones
                        $similarProducts = $this->findSimilarProducts($product);
                        foreach ($similarProducts as $similarProduct) {
                            $recommendations[] = $similarProduct;
                        }
                    }
                }
            }

            // Eliminar duplicados
            $recommendations = array_unique($recommendations, SORT_REGULAR);

            // Guardar recomendaciones en la base de datos si hay productos recomendados
            if (!empty($recommendations)) {
                Recomendado::create([
                    'user_id' => $userLogin->id,
                    'recommended_products' => json_encode(array_column($recommendations, 'id')),
                ]);
            }
        }

        // Pasar las recomendaciones a la vista
        return view('pages.generar', compact('recommendations'));
    }

    /**
     * Buscar productos similares basado en el nombre y la categoría.
     *
     * @param Producto $product
     * @return array
     */
    public function findSimilarProducts($product)
    {
        // Obtener productos similares por nombre o categoría sin convertirlos a array
        return Producto::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('nombre', 'like', '%' . $product->nombre . '%') // Cambiado a 'nombre'
                    ->orWhere('category_id', $product->category_id);
            })
            ->get(); // Mantén esto como una colección
    }
}
