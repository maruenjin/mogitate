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
        $seasons = Season::all();
        return view('products.create',compact('seasons'));
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
    
    public function show(Product $product)
    {
    return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
    $query = Product::query();

    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    if ($request->filled('sort')) {
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }
    } else {
        $query->orderBy('id', 'asc');
    }

    $products = $query->paginate(6);
    $products->appends($request->all());

    return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $seasons = Season::all();
        $productSeasonIds = $product->seasons->pluck('id')->toArray();
        return view('products.edit', compact('product', 'seasons', 'productSeasonIds'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric', 'between:0,10000'],
            'description' => ['required', 'max:120'],
            'image' => ['nullable', 'mimes:png,jpeg'],
            'season' => ['required', 'array'],
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->save();

        $product->seasons()->sync($validated['season']);

        return redirect()->route('products.index')->with('success', '更新しました！');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', '削除しました！');
    }






}
