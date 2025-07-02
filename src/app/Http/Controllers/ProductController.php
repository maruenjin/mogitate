<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function index(Request $request)
    {
        $query=Product::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {

            $query->orderBy('id','asc');
        }
            $products = $query->paginate(6);
            $products->appends($request->all());
    return view('products.index',compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        } else {
            $path = null;
        }

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $path,
        ]);

        if (isset($validated['season'])) {
            $product->seasons()->sync($validated['season']);
        }
    
        return redirect()->route('products.index')
            ->with('success', '商品を登録しました！');
    }
    



}
