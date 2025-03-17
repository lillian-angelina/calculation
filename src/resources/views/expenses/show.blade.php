@extends('layouts.app')

@section('content')
<div class="container">
    <h1>支出・収入の詳細</h1>
    <table>
        <tr>
            <th>収入/支出</th>
            <td>{{ $expense->type ? '収入' : '支出' }}</td>
        </tr>
        <tr>
            <th>日付</th>
            <td>{{ $expense->date }}</td>
        </tr>
        <tr>
            <th>項目</th>
            <td>{{ $expense->title }}</td>
        </tr>
        <tr>
            <th>金額</th>
            <td>{{ number_format($expense->amount) }} 円</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $expense->category->name }}</td>
        </tr>
        <tr>
            <th>備考</th>
            <td>{{ $expense->note }}</td>
        </tr>
    </table>

    <a href="{{ route('expenses.index') }}">一覧に戻る</a>
</div>
@endsection
