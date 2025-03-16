{{-- monthly.blade.php --}}
@extends('layouts.app')

@section('title', '月ごとの収支')

@section('content')
<div class="container">
    <form action="{{ route('expenses.index') }}" method="POST">
        <h1>月ごとの収支</h1>
        <table>
            <tr>
                <th>月</th>
                <th>収入合計</th>
                <th>支出合計</th>
                <th>収支差額</th>
            </tr>
            @foreach($monthlySums as $month => $sums)
            <tr>
                <td>{{ $month }}</td>
                <td>¥{{ number_format($sums['incomeTotal'], 2) }}</td>
                <td>¥{{ number_format($sums['expenseTotal'], 2) }}</td>
                <td>¥{{ number_format($sums['balance'], 2) }}</td>
            </tr>
            @endforeach
        </table>
    </form>
</div>
@endsection
