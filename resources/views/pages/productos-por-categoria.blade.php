<div>


    <div class="bg-white pt-5 pb-10">

        <div class="px-2 xl:px-20 lg:px-20 md:px-15 sm:px-5">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col px-4 gap-4">
                    <samp class="font-bold uppercase">Detalle de categoria : {{ $categoria->name }}</samp>
                </div>
                <samp class="font-bold uppercase px-4">PRODUCTOS SIMILARES POR CATEGORIA</samp>
                <div class="flex flex-row flex-wrap sm:flex-grow-0 justify-center">
                    @if($productos->isEmpty())
                    <p>No hay productos para esta categoría.</p>
                    @else
                    @foreach($productos as $item)
                    <div
                        class="flex flex-shrink-0 w-full sm:w-auto flex-col items-center justify-center xl:justify-start lg:justify-start md:justify-start sm:justify-center">
                        <div
                            class="w-[15rem] relative group h-auto  rounded-2xl px-4 py-4 hover:border hover:pb-16 transition-colors duration-300">
                            <div>
                                <div class="bg-blue-300 text-white absolute z-10 right-5 top-5 rounded-full px-5">
                                    {{ $item->category->name }}
                                </div>
                            </div>
                            <div class="relative">
                                <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->url) : '/img/default.png' }}"
                                class="rounded-2xl object-cover object-center h-auto w-full" 
                                alt="{{ $item->nombre }}">
                            </div>
                            <div class="pt-1">
                                <span class=" font-bold truncate block">{{$item->nombre}}</span>
                                <div class="flex gap-1 justify-start items-center text-xs">
                                    <div class="flex flex-row">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <samp class=" font-extrabold p-0 m-0"> 330 vendido(s)</samp>
                                </div>
                                <div class="w-full text-sm font-extrabold  pt-0.5">
                                    <span class="text-2xl font-bold">
                                        <span class="text-lg">PEN</span>
                                        S/.{{$item->precio}}
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-center items-center  ">
                                <a href="{{ route('producto.detalle', $item->id) }}"
                                    class="absolute w-11/12 text-center rounded-3xl bg-black text-white px-10 py-2  opacity-0 transition group-hover:opacity-100 group-hover:mt-14">
                                    VER MÁS
                                </a >
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>