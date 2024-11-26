<div>
    <h1>{{ $producto->nombre }}</h1>
    <p>{{ $producto->descripcion }}</p>
    <p>Precio: ${{ $producto->precio }}</p>
    <p>Stock: {{ $producto->stock }}</p>
    <div class="bg-red-700 text-white">
        {{ $producto->category->name }}
    </div>
    <h2>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</h2>
    <h2>Productos similares</h2>
    <ul>
        @foreach ($similares as $item)
            <a href="{{ route('producto.detalle', $item->id) }}">
                <img src="{{ $item->images->first() ? Storage::url($item->images->first()->url) : asset('/img/no_imagen.jpg') }}"
                    class="max-w-[4rem] rounded-md border" alt="{{ $item->nombre }}">
                <li>
                    <div>
                        {{ $item->nombre }} - ${{ $item->precio }}
                    </div>
                    <div class="bg-green-700 text-white">
                        {{ $item->category->name }}
                    </div>
                </li>
            </a>
        @endforeach
    </ul>
</div>
