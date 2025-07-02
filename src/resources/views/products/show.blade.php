@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }} の詳細</h1>

    <p>価格：¥{{ number_format($product->price) }}</p>
    <p>{{ $product->description }}</p>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="200">
    @endif

    <a href="{{ route('products.index') }}">一覧に戻る</a>
@endsection
