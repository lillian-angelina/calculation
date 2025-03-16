@extends('layouts.app')

@section('title', '支出の追加')

@section('content')
<div class="container">
    <h1>支出の追加</h1>
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">項目</label>
            <input type="text" id="title" name="title" placeholder="項目" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="amount">金額</label>
            <input type="number" id="amount" name="amount" placeholder="金額" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="date">日付</label>
            <input type="date" id="date" name="date" required class="form-control">
        </div>

        <div class="form-group">
            <label for="category_id">カテゴリー</label>
            <select name="category_id" id="category_id" required class="form-control">
                <option value="">カテゴリーを選択</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">追加</button>
    </form>
</div>
@endsection
