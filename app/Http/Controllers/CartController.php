<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login atau buat akun terlebih dahulu untuk melihat keranjang.');
        }

        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    private function getCart()
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        if ($userId) {
            $cart = Cart::firstOrCreate(['user_id' => $userId]);
            // If there's a guest cart, merge it? (Simplifying for now: just use user cart)
        } else {
            $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        }

        return $cart->load('items.product');
    }

    public function add(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login atau buat akun terlebih dahulu untuk memasukkan produk ke keranjang.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        if ($request->has('checkout')) {
            return redirect()->route('cart.checkout');
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function checkout(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login atau buat akun terlebih dahulu untuk melakukan pemesanan.');
        }

        $cart = $this->getCart();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        return view('cart.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login atau buat akun terlebih dahulu untuk melakukan pemesanan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $cart = $this->getCart();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        return DB::transaction(function () use ($cart, $request) {
            $totalPrice = $cart->items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'customer_email' => $request->email,
                'customer_address' => $request->address,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Create Order Items & Update Stock
            foreach ($cart->items as $item) {
                $product = $item->product;
                
                // Check if stock is sufficient
                if ($product->stock < $item->quantity) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi!");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                ]);

                // Decrement stock
                $product->decrement('stock', $item->quantity);
            }

            // Clear Cart
            $cart->items()->delete();
            $cart->delete();

            return redirect()->route('order.invoice', $order->id)->with('success', 'Pesanan Anda berhasil dibuat!');
        });
    }

    public function invoice($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('order.invoice', compact('order'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:increase,decrease'
        ]);

        $cartItem = CartItem::findOrFail($id);
        
        if ($request->action === 'increase') {
            $cartItem->quantity += 1;
        } else {
            $cartItem->quantity = max(1, $cartItem->quantity - 1);
        }
        
        $cartItem->save();

        return back()->with('success', 'Kuantitas diperbarui!');
    }

    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Produk dihapus dari keranjang!');
    }
}
