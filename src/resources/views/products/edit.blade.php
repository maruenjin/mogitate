@extends('layouts.app')

@section('content')
    <h1>商品一覧</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>商品名</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}">
        </div>

        <div>
            <label>値段</label><br>
            <input type="number" name="price" value="{{ old('price', $product->price) }}">
        </div>

        <div>
            <label>商品画像</label><br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="200">
            @endif
            <br>
            <input type="file" name="image">
        </div>

        <div>
            <label>季節</label><br>
            @foreach ($seasons as $season)
                <input type="checkbox" name="season[]" value="{{ $season->id }}"
                    {{ in_array($season->id, old('season', $productSeasonIds)) ? 'checked' : '' }}>
                {{ $season->name }}
            @endforeach
        </div>

        <div>
            <label>商品説明</label><br>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="wrapper-buttons">
    <a href="{{ route('products.index') }}" class="btn-back">戻る</a>

    <button type="submit" class="btn-save">変更を保存</button>
</div>
</form>


    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">
            🗑
        </button>
    </form>
</div>


    </form>
@endsection
