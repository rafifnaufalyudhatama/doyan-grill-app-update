<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class RecommendationController extends Controller
{
    public function index()
    {
        return view('recommendation.index');
    }

    public function search(Request $request)
    {
        $budget = $request->input('budget');
        $products = Product::all();
        
        $recommendations = [];

        foreach ($products as $product) {
            // Pembuatan Vektor Sederhana untuk Perhitungan Kemiripan (Content-Based Filtering)
            // Vektor User: [budget, konstanta]
            // Vektor Produk: [harga produk, konstanta]
            $userVector = [$budget, 10000];
            $productVector = [$product->price, 10000];

            $similarity = $this->cosineSimilarity($userVector, $productVector);
            
            // Hanya merekomendasikan produk yang harganya kurang dari atau sama dengan budget
            if ($product->price <= $budget) {
                $recommendations[] = [
                    'product' => $product,
                    'similarity' => $similarity
                ];
            }
        }

        // Mengurutkan hasil rekomendasi dari tingkat kemiripan paling tinggi (Descending)
        usort($recommendations, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // Mengambil 3 produk teratas sebagai hasil rekomendasi terbaik
        $topRecommendations = array_slice($recommendations, 0, 3);
        $topProducts = array_column($topRecommendations, 'product');

        return view('recommendation.index', compact('topProducts', 'budget'));
    }

    // Fungsi Algoritma Cosine Similarity
    // Rumus Dasar: (A . B) / (||A|| * ||B||)
    private function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        // Menghitung Dot Product (A . B) dan Magnitude dari masing-masing vektor
        for ($i = 0; $i < count($vec1); $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $normA += pow($vec1[$i], 2);
            $normB += pow($vec2[$i], 2);
        }

        // Menghitung akar kuadrat untuk mendapatkan Euclidean norm (||A|| dan ||B||)
        $normA = sqrt($normA);
        $normB = sqrt($normB);

        // Menghindari pembagian dengan nol
        if ($normA == 0 || $normB == 0) {
            return 0;
        }

        // Mengembalikan skor Cosine Similarity
        return $dotProduct / ($normA * $normB);
    }
}
