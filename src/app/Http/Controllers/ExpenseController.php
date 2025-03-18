<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index()
    {
        // すべての支出と収入を取得
        $expenses = Expense::with('category')->get();

        // すべての取引データを取得（もし取引を扱いたい場合）
        $transactions = Transaction::all();

    // 月ごとの収入と支出を集計
    $monthlyExpenses = $expenses->groupBy(function ($expense) {
        return Carbon::parse($expense->date)->format('Y-m'); // 年-月形式でグループ化
    });

    $monthlySums = $monthlyExpenses->map(function ($expenses) {
        $incomeTotal = $expenses->where('type', 1)->sum('amount'); // 収入の合計
        $expenseTotal = $expenses->where('type', 0)->sum('amount'); // 支出の合計
        $balance = $incomeTotal - $expenseTotal; // 収支差額
        return [
            'incomeTotal' => $incomeTotal,
            'expenseTotal' => $expenseTotal,
            'balance' => $balance
        ];
    });

    return view('expenses.index', compact('expenses', 'monthlySums', 'monthlyExpenses', 'transactions'));
    }

    public function monthly(Request $request)
    {
        $selectedMonth = $request->input('month', date('m')); // デフォルトは現在の月
    
        // 月ごとの集計
        $monthlySums = Transaction::selectRaw('DATE_FORMAT(date, "%Y-%m") as month')
            ->selectRaw('SUM(CASE WHEN type = "収入" THEN amount ELSE 0 END) as incomeTotal')
            ->selectRaw('SUM(CASE WHEN type = "支出" THEN amount ELSE 0 END) as expenseTotal')
            ->whereMonth('date', $selectedMonth) // 選択した月で絞り込む
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy('month')
            ->toArray();
    
        // 収支差額の計算
        foreach ($monthlySums as &$sums) {
            $sums['balance'] = $sums['incomeTotal'] - $sums['expenseTotal'];
        }
    
        return view('expenses.monthly', compact('monthlySums'));
    }

    // 週ごとの集計
    public function weekly(Request $request)
    {
        $selectedWeek = $request->input('week', date('W')); // デフォルトは現在の週
    
        // 週ごとの集計
        $weeklySums = Transaction::selectRaw('YEARWEEK(date, 1) as week')
            ->selectRaw('SUM(CASE WHEN type = "収入" THEN amount ELSE 0 END) as incomeTotal')
            ->selectRaw('SUM(CASE WHEN type = "支出" THEN amount ELSE 0 END) as expenseTotal')
            ->whereRaw('YEARWEEK(date, 1) = ?', [$selectedWeek]) // 選択した週で絞り込む
            ->groupBy('week')
            ->orderBy('week', 'asc')
            ->get()
            ->keyBy('week')
            ->toArray();
    
        // 収支差額の計算
        foreach ($weeklySums as &$sums) {
            $sums['balance'] = $sums['incomeTotal'] - $sums['expenseTotal'];
        }
    
        return view('expenses.weekly', compact('weeklySums'));
    }



    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'type' => 'required|in:1,0', // 収入か支出か
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id', // カテゴリが存在するか
            'amount' => 'required|numeric|min:1', // 金額は1以上の数値
            'note' => 'nullable|string', // 備考は任意
            'title' => 'required|string|max:255',  // title を必須項目としてバリデーション
        ]);

        // 新しい取引を作成
        $expense = new Expense();
        $expense->type = $validated['type'];
        $expense->date = $validated['date'];
        $expense->category_id = $validated['category_id'];
        $expense->amount = $validated['amount'];
        $expense->note = $validated['note'];
        $expense->title = $validated['title'];  // title を保存
        $expense->save(); // データを保存

        // 成功した場合、ホーム画面にリダイレクト
        return redirect()->route('expenses.index')->with('success', '新規登録が完了しました。');
    }


    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }    

    public function edit(Expense $expense)
    {
        $categories = Category::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'type' => 'required|in:0,1',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'note' => 'nullable|string|max:255',
        ]);

        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', '家計簿を更新しました');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', '家計簿を削除しました');
    }
}
