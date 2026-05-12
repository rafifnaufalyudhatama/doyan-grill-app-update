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
            // Simple vector representation for budget and price
            // User vector: [budget, 1]
            // Product vector: [price, 1]
            $userVector = [$budget, 10000];
            $productVector = [$product->price, 10000];

            $similarity = $this->cosineSimilarity($userVector, $productVector);
            
            // Only recommend products within budget (or slightly above if allowed, here we strict to <= budget)
            if ($product->price <= $budget) {
                $recommendations[] = [
                    'product' => $product,
                    'similarity' => $similarity
                ];
            }
        }

        // Sort by similarity descending
        usort($recommendations, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // Get Top 3
        $topRecommendations = array_slice($recommendations, 0, 3);
        $topProducts = array_column($topRecommendations, 'product');

        return view('recommendation.index', compact('topProducts', 'budget'));
    }

    private function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        for ($i = 0; $i < count($vec1); $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $normA += pow($vec1[$i], 2);
            $normB += pow($vec2[$i], 2);
        }

        $normA = sqrt($normA);
        $normB = sqrt($normB);

        if ($normA == 0 || $normB == 0) {
            return 0;
        }

        return $dotProduct / ($normA * $normB);
    }
}
