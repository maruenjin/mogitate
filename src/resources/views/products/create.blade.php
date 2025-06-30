@extends('layouts.app')

@section('content')
    <h1>商品登録</h1>

    {{-- エラーメッセージ表示 --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div>
            <label>商品名</label><br>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- 値段 --}}
        <div>
            <label>値段</label><br>
            <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- 商品画像 --}}
        <div>
            <label>商品画像</label><br>
            <input type="file" name="image">
            @error('image')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- 季節 --}}
        <div>
            <label>季節</label><br>
            <input type="radio" name="season" value="春" {{ old('season') == '春' ? 'checked' : '' }}> 春
            <input type="radio" name="season" value="夏" {{ old('season') == '夏' ? 'checked' : '' }}> 夏
            <input type="radio" name="season" value="秋" {{ old('season') == '秋' ? 'checked' : '' }}> 秋
            <input type="radio" name="season" value="冬" {{ old('season') == '冬' ? 'checked' : '' }}> 冬
            @error('season')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- 商品説明 --}}
        <div>
            <label>商品説明</label><br>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <button type="submit">登録</button>
        <a href="{{ route('products.index') }}">戻る</a>
    </form>
@endsection
