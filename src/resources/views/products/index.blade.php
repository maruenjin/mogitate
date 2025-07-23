@extends('layouts.app')

@section('content')
<div class="container">

    <div class="sidebar">
        <h2>商品一覧</h2>
        
        <form action="{{ route('products.search') }}" method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            
            <button type="submit">検索</button>

            <p class="sort-label">価格順で表示</p>

            <select name="sort" onchange="this.form.submit()">
                <option value="">並び替えを選択</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が低い順</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
            </select>
        </form>
    </div>

    <div class="main-content">
        <div class="page-title-area">
            <a href="{{ route('products.create') }}" class="btn btn-add">+ 商品を追加</a>
        </div>

        <div class="product-grid">
            @foreach ($products as $product)
                <a href="{{ route('products.edit', $product->id) }}" class="product-card-link">
                   <div class="product-card">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/noimage.png') }}" alt="no image">
                        @endif

                        <h2>{{ $product->name }}</h2>
                        <p>￥{{ number_format($product->price) }}</p>
                    </div>  
                </a>
            @endforeach
        </div>  

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
