@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto my-12 px-4 sm:px-6">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center reveal" data-animation="animate-fade-in-up">
        Riwayat <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-yellow-500">Pesanan Anda</span>
    </h2>

    @if($orders->isEmpty())
        <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 text-center reveal" data-animation="animate-blur-in">
            <div class="text-gray-400 mb-4 text-6xl">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 mb-6">Anda belum pernah melakukan pemesanan sebelumnya.</p>
            <a href="{{ route('home') }}" class="inline-block py-3 px-8 rounded-xl bg-gradient-to-r from-orange-500 to-orange-400 text-white font-bold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 transition-all duration-300">Mulai Belanja</a>
        </div>
    @else
        <div class="space-y-8">
            @foreach($orders as $order)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden reveal" data-animation="animate-fade-in-up" style="transition-delay: {{ $loop->index * 50 }}ms;">
                    
                    <!-- Order Header -->
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <div class="text-sm text-gray-500 font-medium mb-1">Tanggal Pesanan: {{ $order->created_at->format('d M Y, H:i') }}</div>
                            <div class="font-bold text-gray-800">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-4 py-1.5 rounded-full text-sm font-bold {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ strtoupper($order->status) }}
                            </span>
                            <a href="{{ route('order.invoice', $order->id) }}" class="text-orange-500 hover:text-orange-600 font-bold text-sm transition-colors flex items-center gap-1">
                                <i class="fa-solid fa-file-invoice"></i> Lihat Invoice
                            </a>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6 flex flex-col gap-4 bg-gray-50/30">
                        @foreach($order->items as $item)
                            <form action="{{ route('cart.add') }}" method="POST" class="m-0 p-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full text-left bg-white border border-gray-200 rounded-2xl p-4 flex flex-row items-center gap-5 hover:border-orange-500 hover:shadow-md transition-all duration-300 group cursor-pointer relative">
                                    
                                    <!-- Product Image (Left) -->
                                    <div class="w-14 h-14 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 shadow-sm border border-gray-200">
                                        @if($item->product->image)
                                            <img src="{{ str_starts_with($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fa-solid fa-image text-gray-300"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Details (Right) -->
                                    <div class="flex-1 min-w-0 flex flex-col justify-center">
                                        <h4 class="text-base font-bold text-gray-800 group-hover:text-orange-600 transition-colors line-clamp-1 leading-tight mb-0.5">{{ $item->product->name }}</h4>
                                        <div class="text-xs text-gray-500 leading-tight">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                        <div class="text-sm font-black text-gray-900 leading-tight mt-0.5">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                                    </div>

                                    <!-- Add to Cart Icon -->
                                    <div class="hidden sm:flex flex-col items-center justify-center px-4">
                                        <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </div>
                                        <span class="text-[10px] font-bold text-orange-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">Beli Lagi</span>
                                    </div>
                                </button>
                            </form>
                        @endforeach
                    </div>

                    <!-- Order Footer -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-gray-500 font-medium text-sm">Total Belanja</div>
                        <div class="text-xl font-black text-orange-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
