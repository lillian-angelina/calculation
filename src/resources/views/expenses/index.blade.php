{{-- index.blade.php --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title', '家計簿')

@section('content')
<div class="container">
    <h1>家計簿</h1>
    <a href="{{ route('expenses.create') }}">新規登録</a>
    <!-- 月ごとの集計ページへのリンク -->
    <a href="{{ route('expenses.monthly') }}">
        <label for="">月ごとの収入と支出を集計</label>
    </a>

    <!-- 週ごとの集計ページへのリンク -->
    <a href="{{ route('expenses.weekly') }}">
        <label for="">週ごとの収入と支出を集計</label>
    </a>

    <table>
        <tr>
            <th>収入/支出</th>
            <th>日付</th>
            <th>項目</th>
            <th>金額</th>
            <th>カテゴリー</th>
            <th>備考</th>
            <th>操作</th>
        </tr>
        @foreach($expenses as $expense)
        <tr>
            <td>{{ $expense->type == 1 ? '収入' : '支出' }}</td>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->title }}</td>
            <td>\{{ $expense->amount }}</td>
            <td>{{ $expense->category->name }}</td>
            <td>{{ $expense->note }}</td>
            <td>
                <a href="{{ route('expenses.show', ['expense' => $expense->id]) }}">詳細</a>
                <a href="{{ route('expenses.edit', ['expense' => $expense->id]) }}">編集</a>
                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
        
    </table>
    @foreach($monthlySums as $month => $sums)
    <div>
        <label>収入合計: ¥{{ number_format($sums['incomeTotal'], 2) }}-</label>
        <label>支出合計: ¥{{ number_format($sums['expenseTotal'], 2) }}-</label>
        <label>収支差額: ¥{{ number_format($sums['balance'], 2) }}-</label>
    @endforeach
    <h3>取引一覧</h3>
    <ul>
        @foreach($transactions as $transaction)
            <li>{{ $transaction->amount }} - {{ $transaction->type }} - {{ $transaction->category->name }}</li>
        @endforeach
    </ul>
    </div>
</div>
@endsection



