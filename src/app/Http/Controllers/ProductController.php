<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function index()
    {
    return view('products.index');
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        
        dd($validated);
    }



}
