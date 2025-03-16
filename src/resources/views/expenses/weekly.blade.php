{{-- weekly.blade.php --}}
@extends('layouts.app')

@section('title', '週ごとの収支')

@section('content')
<div class="container">
    <h1>週ごとの収支</h1>
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
