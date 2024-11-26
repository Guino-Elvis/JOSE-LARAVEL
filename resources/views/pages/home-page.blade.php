<div>
    <div>
        <h1>Listado de Productos</h1>
        <ul>
            @foreach($categorias as $item)
                <a href="{{ route('productos.categoria', $item->id) }}">
                    <li>
                        <div class="bg-orange-600 text-white">
                            {{ $item->name }}
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
    <div>ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</div>
    <div>
        <h1>Listado de Productos</h1>
        <ul>
            @foreach ($productos as $item)
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
</div>
