<div>
    <h1>Productos en la categoría: {{ $categoria->name }}</h1>

    @if($productos->isEmpty())
        <p>No hay productos para esta categoría.</p>
    @else
        <ul>
            @foreach($productos as $item)
                <li>
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
                </li>
            @endforeach
        </ul>
    @endif
</div>
