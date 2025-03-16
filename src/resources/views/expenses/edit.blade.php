{{-- edit.blade.php --}}
@extends('layouts.app')

@section('title', '家計簿 - 編集')

@section('content')
<div class="container">
    <h1>編集</h1>
    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="type">
            <option value="1" {{ $expense->type == 1 ? 'selected' : '' }}>収入</option>
            <option value="0" {{ $expense->type == 0 ? 'selected' : '' }}>支出</option>
        </select>
        <input type="date" name="date" value="{{ $expense->date }}" required>
        <input type="text" name="title" value="{{ $expense->title }}" required>
        <input type="number" name="amount" value="{{ $expense->amount }}" required>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="text" name="note" value="{{ $expense->note }}">
        <button type="submit">更新</button>
    </form>
    <a href="{{ route('expenses.index') }}">戻る</a>
</div>
@endsection
