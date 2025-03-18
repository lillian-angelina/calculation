{{-- create.blade.php --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection


@section('title')

@section('content')
<div class="container">
    <h1>追加登録</h1>
    <form class="form" action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div class="form__radio" >
            <label class="form__radio-1">
                <input class="form__radio-2" type="radio" name="type" value="1" /> 収入
            </label>
            <label class="form__radio-3">
                <input class="form__radio-4" type="radio" name="type" value="0" /> 支出
            </label>
            <input class="form-date" type="date" name="date" required>
        </div>
        <div class="form__content">
            <select class="category_id" name="category_id">
                @foreach($categories as $category)
                    <option class="category_id--option" value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input class="form-date" type="text" name="title" placeholder="詳細" required>
            <input class="form-date" type="number" name="amount" placeholder="金額" required>
            <input class="form-date" type="text" name="note" placeholder="備考">
            <button class="btn-submit" type="submit">追加</button>
        </div>
        <p class="btn"><a class="btn-return" href="{{ route('expenses.index') }}">一覧に戻る</a></p>
    </form>
</div>
@endsection
