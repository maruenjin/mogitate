@extends('layouts.app')

@section('content')
    <header>
        <h1>商品一覧</h1>
        <a href="{{ route('products.create') }}" class="btn btn-add">+ 商品を追加</a>
    </header>

    {{-- 検索フォーム --}}
    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
        <button type="submit">検索</button>

        <select name="sort" onchange="this.form.submit()">
            <option value="">並び替えを選択</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が低い順</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
        </select>
    </form>

    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('images/noimage.png') }}" alt="no image">
                @endif

                <h2>{{ $product->name }}</h2>
                <p>￥{{ number_format($product->price) }}</p>
                <a href="{{ route('products.show', $product->id) }}">詳細を見る</a>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection

