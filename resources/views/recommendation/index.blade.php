@extends('layouts.app')

@section('content')

    <h2 class="text-3xl font-extrabold text-center mb-12 text-gray-800 reveal" data-animation="animate-blur-in">
        Sistem Rekomendasi <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-yellow-500">Menu</span>
    </h2>
    
    <div class="bg-white p-10 sm:p-12 rounded-3xl shadow-sm border border-gray-100 max-w-2xl mx-auto mb-16 reveal text-center" data-animation="animate-fade-in-up">
        <h3 class="text-3xl font-bold text-gray-800 mb-4">Cari Sesuai Budget Anda</h3>
        <p class="text-gray-500 mb-10 text-lg px-4">Kami akan merekomendasikan menu terbaik yang pas di kantong Anda!</p>
        
        <form action="{{ route('recommendation.search') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="budget" class="block font-bold text-gray-700 mb-2">Masukkan Budget (Rp)</label>
                <input type="text" id="budget" name="budget" class="w-full px-5 py-4 border-2 border-gray-100 rounded-xl text-lg focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all placeholder:text-gray-500 placeholder:opacity-60" required placeholder="Contoh : 15000 - 500000" value="{{ isset($budget) ? $budget : '' }}">
            </div>
            <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-orange-500 to-orange-400 text-white font-bold text-lg shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition-all duration-300">Cari Rekomendasi</button>
        </form>
    </div>

    @if(isset($topProducts))
        <h3 class="text-2xl font-bold text-center text-gray-800 mb-10 reveal" data-animation="animate-blur-in">Berikut adalah rekomendasi untuk budget Rp {{ number_format($budget, 0, ',', '.') }}</h3>
        
        @if(count($topProducts) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($topProducts as $index => $product)
                    <div class="group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] relative reveal" data-animation="animate-pop-in" style="transition-delay: {{ $loop->index * 75 }}ms;">
                        <div class="absolute top-4 left-4 bg-orange-500 text-white w-10 h-10 flex items-center justify-center rounded-full font-bold z-20 shadow-lg shadow-orange-500/40">
                            #{{ $index + 1 }}
                        </div>
                        <div class="relative h-56 overflow-hidden">
                            @if($product->image)
                                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]">
                            @else
                                <div class="w-full h-full bg-gray-50 flex items-center justify-center group-hover:bg-gray-100 transition-colors duration-500">
                                    <i class="fa-solid fa-image text-4xl text-gray-300"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-1 line-clamp-1">{{ $product->name }}</h3>
                            <div class="text-2xl font-black text-orange-600 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="flex gap-3">
                                <a href="{{ route('product.show', $product->id) }}" class="flex-1 text-center py-2.5 rounded-xl border-2 border-gray-100 text-gray-700 font-bold hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 transition-all duration-300">Detail</a>
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-orange-400 text-white font-bold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-error text-center">
                Maaf, tidak ada menu yang sesuai dengan budget Anda.
            </div>
        @endif
    @endif

@endsection
