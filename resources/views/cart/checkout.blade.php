@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center space-x-2 mb-8">
            <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-orange-500 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Checkout</h1>
        <p class="text-gray-600 text-lg mb-12">Lengkapi informasi untuk menyelesaikan pemesanan</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8 reveal" data-animation="animate-fade-in-up">
        
        <!-- Form Section -->
        <div class="flex-1 bg-white p-10 rounded-[2rem] shadow-sm border border-gray-100">
            <!-- Informasi Pembeli -->
            <h3 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-user text-orange-500"></i> Informasi Pembeli
            </h3>
            <form id="checkout-form" action="{{ route('cart.process') }}" method="POST">
                @csrf
                <div class="space-y-5 mb-8">
                    <div>
                        <label for="name" class="block font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="w-full px-5 py-3 border-2 border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all" required placeholder="Masukkan nama Anda">
                    </div>
                    <div>
                        <label for="phone" class="block font-bold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" class="w-full px-5 py-3 border-2 border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all" required placeholder="Contoh: 081234567890">
                    </div>
                    <div>
                        <label for="email" class="block font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-5 py-3 border-2 border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all" required placeholder="email@example.com">
                    </div>
                </div>

                <!-- Alamat Pengiriman -->
                <h3 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100 flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot text-orange-500"></i> Alamat Pengiriman
                </h3>
                <div class="space-y-5 mb-8">
                    <div>
                        <label for="address" class="block font-bold text-gray-700 mb-2">Alamat lengkap</label>
                        <textarea id="address" name="address" class="w-full px-5 py-3 border-2 border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all" rows="4" required placeholder="Masukkan alamat pengiriman secara detail"></textarea>
                    </div>
                </div>

                    <!-- Metode Pembayaran -->
                <h3 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100 flex items-center gap-2">
                    <i class="fa-solid fa-wallet text-orange-500"></i> Metode Pembayaran
                </h3>
                
                <div class="space-y-3">
                    <!-- Transfer Bank -->
                    <label class="relative cursor-pointer block">
                        <input type="radio" name="payment_method" value="Transfer Bank" class="peer sr-only" required checked>
                        
                        <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 hover:border-orange-300 hover:bg-gray-50 transition-all">
                            <div class="flex items-center gap-3 mb-2 ml-9">
                                <div class="font-bold text-gray-800">Transfer Bank</div>
                            </div>
                            <div class="text-sm text-gray-600 ml-9">BCA, Mandiri, BRI, BNI</div>
                        </div>

                        <div class="absolute left-4 top-4 w-6 h-6 rounded border-2 border-gray-300 text-transparent peer-checked:border-orange-500 peer-checked:bg-orange-500 peer-checked:text-white flex items-center justify-center transition-all mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </label>
                    
                    <!-- E-Wallet -->
                    <label class="relative cursor-pointer block">
                        <input type="radio" name="payment_method" value="E-Wallet" class="peer sr-only" required>
                        
                        <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 hover:border-orange-300 hover:bg-gray-50 transition-all">
                            <div class="flex items-center gap-3 mb-2 ml-9">
                                <div class="font-bold text-gray-800">E-Wallet</div>
                            </div>
                            <div class="text-sm text-gray-600 ml-9">Dana, Gopay, Shopeepay</div>
                        </div>

                        <div class="absolute left-4 top-4 w-6 h-6 rounded border-2 border-gray-300 text-transparent peer-checked:border-orange-500 peer-checked:bg-orange-500 peer-checked:text-white flex items-center justify-center transition-all mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </label>
                    
                    <!-- COD -->
                    <label class="relative cursor-pointer block">
                        <input type="radio" name="payment_method" value="COD" class="peer sr-only" required>
                        
                        <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 hover:border-orange-300 hover:bg-gray-50 transition-all">
                            <div class="flex items-center gap-3 mb-2 ml-9">
                                <div class="font-bold text-gray-800">Bayar di Tempat (COD)</div>
                            </div>
                            <div class="text-sm text-gray-600 ml-9">Bayar saat barang diterima</div>
                        </div>

                        <div class="absolute left-4 top-4 w-6 h-6 rounded border-2 border-gray-300 text-transparent peer-checked:border-orange-500 peer-checked:bg-orange-500 peer-checked:text-white flex items-center justify-center transition-all mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </label>
                </div>
                </div>
            </form>
        </div>

        <!-- Order Summary Section -->
        <div class="flex-[1] bg-gradient-to-br from-orange-50 to-white p-6 rounded-[2rem] shadow-sm border border-orange-100 h-max">
            <h3 class="text-lg font-bold text-gray-800 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-receipt text-orange-500"></i> Ringkasan Pesanan
            </h3>
            
            <div class="space-y-4 mb-5">
                @php $totalAmount = 0; @endphp
                @foreach($cart->items as $item)
                    @php 
                        $itemTotal = $item->product->price * $item->quantity; 
                        $totalAmount += $itemTotal;
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <i class="fa-solid fa-image text-gray-400 text-xl"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">{{ $item->product->name }}</div>
                            <div class="text-sm text-gray-500">x{{ $item->quantity }}</div>
                        </div>
                        <div class="font-bold text-gray-800">Rp {{ number_format($itemTotal, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>

            <div class="border-t-2 border-dashed border-gray-200 pt-5 space-y-3">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-800">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Ongkir</span>
                    <span class="text-green-600">Rp 0</span>
                </div>
                <div class="flex justify-between items-center text-lg font-black text-orange-600 pt-2 border-t border-gray-200">
                    <span>Total</span>
                    <span>Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                </div>
            </div>

            <button type="submit" form="checkout-form" class="w-full py-3 rounded-xl bg-gradient-to-r from-orange-500 to-orange-400 text-white font-bold text-lg shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fa-solid fa-check-circle"></i> Buat Pesanan
            </button>
        </div>

    </div>

@endsection
