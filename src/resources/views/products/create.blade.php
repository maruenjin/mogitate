@extends('layouts.app')

@section('content')
    


    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h1>商品登録</h1> 
        <div>
            <label>商品名</label><br>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>値段</label><br>
            <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>商品画像</label><br>
            <input type="file" name="image">
            @error('image')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
        <label>季節</label><br>
    @foreach ($seasons as $season)
        <input type="checkbox" name="season[]" value="{{ $season->id }}"
            {{ is_array(old('season')) && in_array($season->id, old('season')) ? 'checked' : '' }}>
        {{ $season->name }}
    @endforeach
    @error('season')
        <div style="color: red; margin-top: 5px;">{{ $message }}</div>
    @enderror
</div>
            
       

        <div>
            <label>商品説明</label><br>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <div class="button-group">
        <a href="{{ route('products.index') }}">戻る</a>
        <button type="submit">登録</button>
      </div>
    </form>
@endsection
