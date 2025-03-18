@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weekly.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>週ごとの収支</h1>

    <!-- 週を選ぶフォーム -->
    <form action="{{ route('expenses.weekly') }}" method="GET">
        <label for="week">週を選択:</label>
        <select name="week" id="week">
            @foreach(range(1, 52) as $week)
                <option value="{{ $week }}" {{ request('week') == $week ? 'selected' : '' }}>
                    第{{ $week }}週
                </option>
            @endforeach
        </select>
        <button type="submit">選択</button>
    </form>

    <!-- 週ごとの収支表示 -->
    <table>
        <tr>
            <th>週</th>
            <th>収入合計</th>
            <th>支出合計</th>
            <th>収支差額</th>
        </tr>
        @foreach($weeklySums as $week => $sums)
        <tr>
            <td>{{ $week }}</td>
            <td>¥{{ number_format($sums['incomeTotal'], 2) }}</td>
            <td>¥{{ number_format($sums['expenseTotal'], 2) }}</td>
            <td>¥{{ number_format($sums['balance'], 2) }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection