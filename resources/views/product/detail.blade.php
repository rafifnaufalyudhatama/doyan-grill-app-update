@extends('layouts.app')

@section('content')

<div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 md:p-10 mb-16 reveal" data-animation="animate-fade-in-up">
    <div class="flex flex-col md:flex-row gap-10 md:gap-16">
        
        <!-- Product Image -->
        <div class="w-full md:w-2/5">
            <div class="relative rounded-3xl overflow-hidden shadow-md group">
                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full text-sm font-bold text-orange-600 z-10 shadow-sm">
                    {{ strtoupper($product->category) }}
                </span>
                @if($product->image)
                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]">
                @else
                    <div class="w-full h-[400px] bg-gray-50 flex items-center justify-center group-hover:bg-gray-100 transition-colors duration-500">
                        <i class="fa-solid fa-image text-6xl text-gray-300"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="w-full md:w-3/5 flex flex-col justify-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">{{ $product->name }}</h1>
            
            <div class="bg-orange-50 border border-orange-100 p-6 rounded-2xl mb-8 flex items-center">
                <div class="text-4xl font-black text-orange-600">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-orange-500"></i> Deskripsi Produk
                </h3>
                <div class="text-gray-600 leading-relaxed bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="flex items-center flex-wrap sm:flex-nowrap gap-4 sm:gap-6 mb-8 bg-white border border-gray-100 p-4 rounded-2xl shadow-sm w-full sm:w-max">
                    <span class="font-bold text-gray-700">Kuantitas</span>
                    <div class="flex items-center bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
                        <button type="button" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-orange-600 transition-colors active:scale-95" onclick="document.getElementById('qty').value = Math.max(1, parseInt(document.getElementById('qty').value) - 1)">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" id="qty" name="quantity" class="w-16 h-10 text-center bg-transparent border-none focus:ring-0 font-bold text-gray-800" value="1" min="1" max="{{ $product->stock }}">
                        <button type="button" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-orange-600 transition-colors active:scale-95" onclick="let q = document.getElementById('qty'); if(parseInt(q.value) < {{ $product->stock }}) q.value = parseInt(q.value) + 1">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    <span class="text-sm font-medium text-orange-600 bg-orange-50 px-3 py-1.5 rounded-lg">Tersisa {{ $product->stock }} buah</span>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="flex-1 py-4 rounded-xl border-2 border-orange-500 text-orange-600 font-bold hover:bg-orange-50 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 text-lg">
                        <i class="fa-solid fa-cart-plus"></i> Masukkan Keranjang
                    </button>
                    <button type="submit" formaction="{{ route('cart.add') }}?checkout=1" class="flex-1 py-4 rounded-xl bg-gradient-to-r from-orange-500 to-orange-400 text-white font-bold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 text-lg">
                        Beli Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
