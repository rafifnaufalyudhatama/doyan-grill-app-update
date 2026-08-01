@extends('layouts.app')

@section('content')
<div class="invoice-card" style="max-width: 800px; margin: 2rem auto; background: white; padding: 3rem; border-radius: 15px; box-shadow: var(--shadow); border-top: 10px solid var(--primary-color);">
    
    <div class="invoice-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 3rem;">
        <div>
            <h1 style="color: var(--primary-color); margin: 0; font-size: 2.5rem;">INVOICE</h1>
            <p style="color: #666; margin-top: 0.5rem;">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div style="text-align: right;">
            <h2 style="margin: 0; color: #333;">Doyan Frozen & Grill</h2>
            <p style="color: #666; margin: 0.2rem 0;">Madukoro, Kajoran, Magelang RT 006 / RW 001</p>
            <p style="color: #666; margin: 0;">0856-0058-9155</p>
        </div>
    </div>

    <div class="invoice-details" style="margin-bottom: 3rem; display: flex; gap: 2rem; flex-wrap: wrap;">
        <!-- Data Diri Pembeli Card -->
        <div style="background-color: #fdfbf7; border: 1px solid #f0e6d2; border-left: 5px solid var(--primary-color); padding: 1.5rem; border-radius: 12px; flex: 1; min-width: 300px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.2rem; border-bottom: 1px solid #f0e6d2; padding-bottom: 0.8rem;">
                <div style="background-color: var(--primary-color); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h4 style="color: var(--primary-color); text-transform: uppercase; margin: 0; font-size: 1rem; font-weight: 800; letter-spacing: 0.5px;">Data Diri Pembeli</h4>
            </div>
            <p style="font-weight: 800; color: #2d3748; margin: 0 0 0.8rem 0; font-size: 1.3rem;">{{ $order->customer_name }}</p>
            <div style="display: flex; align-items: center; gap: 0.8rem; color: #4a5568; margin-bottom: 0.5rem; font-size: 0.95rem;">
                <i class="fa-solid fa-phone" style="color: #a0aec0; width: 16px; text-align: center;"></i>
                <p style="margin: 0; font-weight: 500;">{{ $order->customer_phone }}</p>
            </div>
            @if($order->customer_email)
            <div style="display: flex; align-items: center; gap: 0.8rem; color: #4a5568; margin-bottom: 0.5rem; font-size: 0.95rem;">
                <i class="fa-solid fa-envelope" style="color: #a0aec0; width: 16px; text-align: center;"></i>
                <p style="margin: 0; font-weight: 500;">{{ $order->customer_email }}</p>
            </div>
            @endif
            <div style="display: flex; align-items: flex-start; gap: 0.8rem; color: #4a5568; margin-bottom: 1.2rem; font-size: 0.95rem;">
                <i class="fa-solid fa-location-dot" style="color: #a0aec0; width: 16px; text-align: center; margin-top: 4px;"></i>
                <p class="customer-address" style="margin: 0; flex: 1; line-height: 1.5;">{{ $order->customer_address }}</p>
            </div>
            <div style="background-color: white; border-radius: 8px; padding: 0.8rem; border: 1px dashed #e2e8f0; display: inline-block;">
                <p style="color: #718096; margin: 0; font-size: 0.85rem;"><i class="fa-regular fa-calendar" style="margin-right: 5px;"></i> Tanggal Pesanan: <span style="font-weight: 700; color: #2d3748;">{{ $order->created_at->format('d M Y') }}</span></p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 2rem; padding: 1rem; min-width: 200px;">
            <div>
                <h4 style="color: #a0aec0; text-transform: uppercase; margin-bottom: 0.8rem; font-size: 0.8rem; font-weight: 700; letter-spacing: 0.5px;">Status Pembayaran</h4>
                <span style="background: #fffaf0; border: 1px solid #feebc8; color: #dd6b20; padding: 0.5rem 1.2rem; border-radius: 50px; font-weight: 800; font-size: 0.9rem; display: inline-block; box-shadow: 0 2px 4px rgba(221, 107, 32, 0.1);">
                    <i class="fa-solid fa-circle-info" style="margin-right: 5px;"></i> {{ strtoupper($order->status) }}
                </span>
            </div>
            <div>
                <h4 style="color: #a0aec0; text-transform: uppercase; margin-bottom: 0.5rem; font-size: 0.8rem; font-weight: 700; letter-spacing: 0.5px;">Metode Pembayaran</h4>
                <div style="font-weight: 700; color: #2d3748; font-size: 1.1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-wallet" style="color: var(--primary-color);"></i>
                    @php
                        $paymentMethod = $order->payment_method;
                        if ($paymentMethod === 'COD') {
                            echo 'Bayar di Tempat (COD)';
                        } elseif ($paymentMethod === 'Transfer Bank') {
                            echo 'Transfer Bank';
                        } elseif ($paymentMethod === 'E-Wallet') {
                            echo 'E-Wallet';
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
    </div>

    <div class="invoice-table-wrapper">
        <table class="invoice-table" style="width: 100%; border-collapse: collapse; margin-bottom: 3rem;">
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
    </div>

    <div style="display: flex; justify-content: flex-end;">
        <div class="invoice-totals" style="width: 300px;">
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
        <div class="invoice-actions" style="margin-top: 2rem;">
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
    @media (max-width: 768px) {
        .invoice-card { padding: 1.5rem !important; margin: 1rem !important; }
        .invoice-header { flex-direction: column; gap: 1.5rem; }
        .invoice-header > div:last-child { text-align: left !important; }
        .invoice-details { flex-direction: column; gap: 1.5rem !important; }
        .customer-address { width: 100% !important; }
        .invoice-table-wrapper { overflow-x: auto; margin-bottom: 2rem; }
        .invoice-table { min-width: 500px; }
        .invoice-totals { width: 100% !important; }
        .invoice-actions { display: flex; flex-direction: column; gap: 1rem; }
        .invoice-actions .btn { margin-left: 0 !important; width: 100%; justify-content: center; }
    }
</style>
@endsection
