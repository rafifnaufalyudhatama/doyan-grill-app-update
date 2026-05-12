@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 2rem auto; background: white; padding: 3rem; border-radius: 15px; box-shadow: var(--shadow); border-top: 10px solid var(--primary-color);">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 3rem;">
        <div>
            <h1 style="color: var(--primary-color); margin: 0; font-size: 2.5rem;">INVOICE</h1>
            <p style="color: #666; margin-top: 0.5rem;">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div style="text-align: right;">
            <h2 style="margin: 0; color: #333;">Doyan Frozen & Grill</h2>
            <p style="color: #666; margin: 0.2rem 0;">Pekanbaru, Riau</p>
            <p style="color: #666; margin: 0;">0812-XXXX-XXXX</p>
        </div>
    </div>

    <div style="margin-bottom: 3rem; display: flex; gap: 4rem;">
        <div>
            <h4 style="color: #888; text-transform: uppercase; margin-bottom: 0.5rem; font-size: 0.8rem;">Diterbitkan Untuk</h4>
            <p style="font-weight: 700; margin: 0; font-size: 1.1rem;">{{ $order->customer_name }}</p>
            <p style="color: #666; margin: 0.2rem 0;">{{ $order->customer_phone }}</p>
            <p style="color: #666; margin: 0; width: 250px;">{{ $order->customer_address }}</p>
            <p style="color: #666; margin-top: 1rem;">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
        </div>
        <div>
            <h4 style="color: #888; text-transform: uppercase; margin-bottom: 0.5rem; font-size: 0.8rem;">Status Pembayaran</h4>
            <span style="background: #fff3e0; color: #ff9800; padding: 0.3rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.9rem;">
                {{ strtoupper($order->status) }}
            </span>
        </div>
        <div style="margin-top: 2rem;">
            <h4 style="color: #888; text-transform: uppercase; margin-bottom: 0.5rem; font-size: 0.8rem;">Metode Pembayaran</h4>
            <div style="font-weight: 700; color: #333; font-size: 1.1rem;">
                @php
                    $paymentMethod = $order->payment_method;
                    if ($paymentMethod === 'COD') {
                        echo 'Bayar di Tempat (COD) - Bayar saat barang diterima';
                    } elseif ($paymentMethod === 'Transfer Bank') {
                        echo 'Transfer Bank (BCA, Mandiri, BRI, BNI)';
                    } elseif ($paymentMethod === 'E-Wallet') {
                        echo 'E-Wallet (Dana, Gopay, Shopeepay)';
                    } elseif (in_array($paymentMethod, ['BCA', 'BNI', 'BRI', 'Mandiri'])) {
                        echo 'Transfer Bank ' . $paymentMethod;
                    } elseif (in_array($paymentMethod, ['GoPay', 'Dana', 'Shopeepay'])) {
                        echo 'E-Wallet ' . $paymentMethod;
                    } else {
                        echo $paymentMethod;
                    }
                @endphp
            </div>
        </div>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 3rem;">
        <thead>
            <tr style="border-bottom: 2px solid #eee; text-align: left;">
                <th style="padding: 1rem 0; color: #888; font-weight: 600;">Deskripsi Produk</th>
                <th style="padding: 1rem 0; color: #888; font-weight: 600; text-align: center;">Qty</th>
                <th style="padding: 1rem 0; color: #888; font-weight: 600; text-align: right;">Harga</th>
                <th style="padding: 1rem 0; color: #888; font-weight: 600; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr style="border-bottom: 1px solid #f9f9f9;">
                <td style="padding: 1.5rem 0;">
                    <div style="font-weight: 700; color: #333;">{{ $item->product->name }}</div>
                </td>
                <td style="padding: 1.5rem 0; text-align: center;">{{ $item->quantity }}</td>
                <td style="padding: 1.5rem 0; text-align: right;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td style="padding: 1.5rem 0; text-align: right; font-weight: 700;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display: flex; justify-content: flex-end;">
        <div style="width: 300px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: #888;">Subtotal</span>
                <span style="font-weight: 600;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: #888;">Biaya Pengiriman</span>
                <span style="font-weight: 600; color: #4caf50;">FREE</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 1rem; border-top: 2px solid #eee;">
                <span style="font-size: 1.2rem; font-weight: 800;">Total Akhir</span>
                <span style="font-size: 1.5rem; font-weight: 800; color: var(--primary-color);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div style="margin-top: 4rem; text-align: center; border-top: 1px dashed #ddd; padding-top: 2rem;">
        <p style="color: #888; font-style: italic;">Terima kasih telah berbelanja di Doyan Frozen & Grill!</p>
        <div style="margin-top: 2rem;">
            <a href="{{ route('home') }}" class="btn btn-outline">Kembali ke Beranda</a>
            <button onclick="window.print()" class="btn btn-primary" style="margin-left: 1rem;"><i class="fa-solid fa-print"></i> Cetak Invoice</button>
        </div>
    </div>

</div>

<style>
    @media print {
        .navbar, .btn-outline, .btn-primary { display: none !important; }
        body { background: white !important; }
        div { box-shadow: none !important; border: none !important; margin: 0 !important; max-width: 100% !important; }
    }
</style>
@endsection
