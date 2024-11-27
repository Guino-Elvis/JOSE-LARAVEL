<?php


namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Recomendado; // Importar el modelo Recomendado
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Asegúrate de importar el Log
use Phpml\Association\Apriori;

class RecommendationApriori extends Component
{
    // Listener para actualizar las recomendaciones
    protected $listeners = ['updateHeaderOfForm' => 'generateRecommendations'];

    public function generateRecommendations()
    {
        Log::info('generateRecommendations called');  // Usar Log correctamente
        $userLogin = Auth::user();  // Obtener el usuario logueado

        // Obtener todas las transacciones del usuario logueado
        $transactions = Transaction::where('user_id', $userLogin->id)->get(); // Corregir la consulta para filtrar por user_id



        // Si no hay transacciones, no hacer nada
        if ($transactions->isEmpty()) {
            Log::info('No transactions found for user');
            return;
        }

        // Verificar qué transacciones se están obteniendo
        Log::info('Transactions:', ['transactions' => $transactions]);
        // Extraer los productos de las transacciones
        $productTransactions = [];
        foreach ($transactions as $transaction) {
            // Asegúrate de que cada transacción sea un array de productos
            $products = json_decode($transaction->products);
            if (is_array($products)) {
                $productTransactions[] = $products;  // Cada transacción es un array de productos
            }
        }
        Log::info('Product transactions:', ['productTransactions' => $productTransactions]);
        // Parámetros de Apriori
        $minSupport = [0.1];  // Ahora soporte mínimo es un array con el valor flotante
        $minConfidence = 0.5;  // Confianza mínima en formato flotante

        // Crear el objeto Apriori pasando solo la confianza mínima
        $apriori = new Apriori($minConfidence);  // Solo pasamos la confianza mínima al constructor

        // Ahora pasamos ambos parámetros a la función train():
        $apriori->train($productTransactions, $minSupport);

        // Obtener las reglas de asociación
        $rules = $apriori->getRules(); // Aquí obtendremos un array de objetos AssociationRule
        Log::info('Generated rules:', ['rules' => $rules]);
        // Almacenar las recomendaciones en un array
        $recommendations = [];

        foreach ($rules as $rule) {
            if (is_object($rule)) {
                // $antecedent = $rule->getAntecedent();
                // $consequent = $rule->getConsequent();

                $antecedent = implode(", ", $rule->getAntecedent());
                $consequent = implode(", ", $rule->getConsequent());
                 
                // Get real products based on rule IDs
                $antecedentProducts = Producto::whereIn('id', $antecedent)->get();
                $consequentProducts = Producto::whereIn('id', $consequent)->get();

                // Create recommendations
                $recommendations[] = [
                    'antecedent' => $antecedentProducts->pluck('nombre')->implode(", "),
                    'consequent' => $consequentProducts->pluck('nombre')->implode(", "),
                    'support' => $rule->getSupport(),
                    'confidence' => $rule->getConfidence(),
                ];
            }
        }

        // Verificar si el array de recomendaciones no está vacío
        Log::info('Recommendations generated', ['recommendations' => $recommendations]);

        // Guardar las recomendaciones en la base de datos
        if (!empty($recommendations)) {
            $recomendacionesCreado = Recomendado::create([
                'user_id' => $userLogin->id,
                'recommended_products' => json_encode($recommendations),  // Guardamos las recomendaciones como un JSON
            ]);
            dd($recomendacionesCreado);  // Aquí puedes hacer un dd para ver la creación de la recomendación.
            Log::info('Recommendation saved in database', ['recomendacion' => $recomendacionesCreado]);
        } else {
            Log::info('No recommendations generated');
        }
    }

    public function render()
    {
        // Llamamos a la función generateRecommendations en el render
        $this->generateRecommendations();

        // Retornar la vista del componente
        return view('livewire.recommendation-apriori');  // No se renderiza ninguna vista si no se necesita
    }
}
