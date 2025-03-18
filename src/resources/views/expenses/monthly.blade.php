@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/monthly.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>月間収支</h1>

    <!-- 月を選ぶフォーム -->
    <form class="form" action="{{ route('expenses.monthly') }}" method="GET">
        <label class="form__label" for="month">月を選択 :</label>
        <select class="month-select" name="month" id="month">
            @foreach(range(1, 12) as $month)
                <option class="month-option" value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                    {{ $month }}月
                </option>
            @endforeach
        </select>
        <button class="btn-submit" type="submit">選択</button>
    </form>

    <!-- 月ごとの収支表示 -->
    <table>
        <tr>
            <th>月</th>
            <th>収入合計</th>
            <th>支出合計</th>
            <th>収支差額</th>
        </tr>
        @foreach($monthlySums as $month => $sums)
        <tr>
            <td style="text-align: center;">{{ $month }}月</td>
            <td>¥{{ number_format($sums['incomeTotal'], 2) }}</td>
            <td>¥{{ number_format($sums['expenseTotal'], 2) }}</td>
            <td>¥{{ number_format($sums['balance'], 2) }}</td>
        </tr>
        @endforeach
    </table>
    <p class="btn"><a class="btn-return" href="{{ route('expenses.index') }}">一覧に戻る</a></p>
</div>
@endsection