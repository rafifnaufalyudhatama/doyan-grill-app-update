@extends('layouts.app')

@section('content')

    <div class="bg-orange-50 border border-orange-200 text-orange-800 px-6 py-4 rounded-2xl mb-8 flex items-center justify-center gap-3 text-sm font-medium shadow-sm reveal" data-animation="animate-fade-in-up">
        <i class="fa-solid fa-motorcycle text-lg"></i>
        <span>Pemberitahuan: Layanan antar (Delivery) saat ini hanya tersedia untuk wilayah <strong>Magelang - Jogja</strong>.</span>
    </div>

    <div class="mb-12 max-w-2xl mx-auto px-4 sm:px-0 reveal" data-animation="animate-fade-in-up">
        <form action="{{ route('home') }}" method="GET" class="flex gap-3 sm:gap-4">
            <div class="relative flex-1 group">
                <div class="absolute inset-y-0 flex items-center pointer-events-none text-gray-400 group-focus-within:text-orange-500 transition-colors duration-300" style="left: 1.5rem;">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu daging atau frozen food favorit Anda..." class="block w-full py-4 pr-6 text-gray-800 bg-white border border-gray-200 rounded-full shadow-sm hover:shadow-md focus:shadow-lg focus:ring-4 focus:ring-orange-500/10 focus:border-orange-400 transition-all duration-300 outline-none text-base sm:text-lg placeholder-gray-400" style="padding-left: 3.5rem;">
            </div>
            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-400 hover:from-orange-600 hover:to-orange-500 text-white font-bold rounded-full px-6 sm:px-10 transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-center flex-shrink-0">
                Cari
            </button>
        </form>
    </div>

    @if(request('search'))
        <h2 class="text-2xl font-bold text-center mb-10 text-gray-800 reveal" data-animation="animate-blur-in">
            Hasil pencarian untuk <span class="text-orange-500">"{{ request('search') }}"</span>
        </h2>
    @else
        <h2 class="text-3xl font-extrabold text-center mb-12 text-gray-800 reveal" data-animation="animate-blur-in">
            Menu <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-yellow-500">Pilihan Kami</span>
        </h2>
    @endif
 
     @if($products->isEmpty())
         <div class="col-span-full bg-white p-10 rounded-3xl shadow-sm border border-gray-100 text-center">
             <div class="text-gray-400 mb-4 text-5xl">
                 <i class="fa-solid fa-magnifying-glass-minus"></i>
             </div>
             <h3 class="text-xl font-bold text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
             <p class="text-gray-500">Maaf, kami tidak dapat menemukan menu dengan kata kunci tersebut.</p>
         </div>
     @else
         <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8">
             @foreach($products as $product)
                 <div class="group bg-white rounded-2xl md:rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 md:hover:-translate-y-2 transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] reveal" data-animation="animate-pop-in" style="transition-delay: {{ $loop->index * 75 }}ms;">
                     <div class="relative h-32 sm:h-48 md:h-56 overflow-hidden">
                         <span class="absolute top-2 right-2 md:top-4 md:right-4 bg-white/90 backdrop-blur-md px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-bold text-orange-600 z-10 shadow-sm">
                             {{ strtoupper($product->category) }}
                         </span>
                         @if($product->image)
                             <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]">
                         @else
                             <div class="w-full h-full bg-gray-50 flex items-center justify-center group-hover:bg-gray-100 transition-colors duration-500">
                                 <i class="fa-solid fa-image text-3xl md:text-4xl text-gray-300"></i>
                             </div>
                         @endif
                     </div>
                     <div class="p-3 md:p-6 flex flex-col h-[calc(100%-8rem)] sm:h-[calc(100%-12rem)] md:h-[calc(100%-14rem)] justify-between">
                         <div>
                             <h3 class="text-sm md:text-xl font-bold text-gray-800 mb-1 line-clamp-2 md:line-clamp-1 leading-tight md:leading-normal">{{ $product->name }}</h3>
                             <div class="text-base md:text-2xl font-black text-orange-600 mb-3 md:mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                         </div>
                         <div class="flex flex-col xl:flex-row gap-2 md:gap-3 mt-auto">
                             <a href="{{ route('product.show', $product->id) }}" class="flex-1 text-center py-1.5 md:py-2.5 rounded-lg md:rounded-xl border md:border-2 border-gray-100 text-gray-700 font-bold text-xs md:text-base hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 active:scale-95 transition-all duration-300">Detail</a>
                             <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                 @csrf
                                 <input type="hidden" name="product_id" value="{{ $product->id }}">
                                 <input type="hidden" name="quantity" value="1">
                                 <button type="submit" class="w-full py-1.5 md:py-2.5 rounded-lg md:rounded-xl bg-gradient-to-r from-orange-500 to-orange-400 text-white font-bold shadow-md md:shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 flex justify-center items-center text-xs md:text-base">
                                     <i class="fa-solid fa-cart-plus"></i><span class="ml-1 xl:hidden">Beli</span>
                                 </button>
                             </form>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     @endif

@endsection
