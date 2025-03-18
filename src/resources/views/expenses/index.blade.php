{{-- index.blade.php --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title')
        <title>Calculation</title>
@endsection

@section('content')
<div class="container">
    <div class="content-head grid-item">
        <div class="content-head__2">
            <label class="calculation__label">家計簿</label>
            <a class="btn-register" href="{{ route('expenses.create') }}">新規登録</a>
        </div>
    </div>

    <div class="new grid-item">
        <div class="new__space">
            <div class="new__space--monthly-weekly">
                <label class="monthly"><a href="{{ route('expenses.monthly') }}">月の集計</a></label>
                <label class="weekly"><a href="{{ route('expenses.weekly') }}">週の集計</a></label>
            </div>
            <div class="table">
                <div class="table__second">
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
                                <td>{{ $expense->category ? $expense->category->name : 'カテゴリなし' }}</td>
                                <td>{{ $expense->note }}</td>
                                <td>
                                    <a class="table__second--show" href="{{ route('expenses.show', ['expense' => $expense->id]) }}">詳細</a>
                                    <a class="table__second--edit" href="{{ route('expenses.edit', ['expense' => $expense->id]) }}">編集</a>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($monthlySums as $month => $sums)
        <div class="total grid-item">
            <label>収入合計: ¥{{ number_format($sums['incomeTotal']) }}-</label>　-　
            <label>支出合計: ¥{{ number_format($sums['expenseTotal']) }}-</label>　=　
            <label>収支差額: ¥{{ number_format($sums['balance']) }}-</label>
        </div>
    @endforeach
</div>
@endsection

