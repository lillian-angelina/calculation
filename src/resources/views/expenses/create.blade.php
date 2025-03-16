{{-- create.blade.php --}}
@extends('layouts.app')

@section('title', '家計簿 - 新規登録')

@section('content')
<div class="container">
    <h1>新規登録</h1>
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div>
            <label>
                <input type="radio" name="type" value="1" /> 収入
            </label>
            <label>
                <input type="radio" name="type" value="0" /> 支出
            </label>
        </div>

        <input type="date" name="date" required>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" placeholder="金額" required>
        <input type="text" name="note" placeholder="備考">
        <input type="text" name="title" placeholder="項目名" required>
        <button type="submit">追加</button>
    </form>
</div>
@endsection
