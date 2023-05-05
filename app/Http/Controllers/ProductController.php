<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function search(Request $request)
    {
        $query = $this->product->get();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function show(Request $request)
    {
        $query = $this->product->where('product_code', $request->code)->first();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }
}
