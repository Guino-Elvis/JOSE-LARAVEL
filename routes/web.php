<?php


use App\Livewire\Seting;
use App\Livewire\SetingPag;
use App\Livewire\HomePage;
use App\Livewire\DetallePage;
use App\Livewire\Generar;
use App\Livewire\ProductoDetallePage;
use App\Livewire\ProductoPage;
use App\Livewire\ProductosPorCategoria;
use App\Livewire\RecomendadosPage;
use App\Livewire\RecommendationApriori;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('pages.home-page');
// });



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/', ProductoPage::class)->name('inicio');
    Route::get('/producto/{id}', ProductoDetallePage::class)->name('producto.detalle');
    Route::get('/categoria/{id}/productos', ProductosPorCategoria::class)->name('productos.categoria');
    
    Route::get('/recomendaciones', Generar::class)->name('recoment');

});


