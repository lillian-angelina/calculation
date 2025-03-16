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

    // 月ごとの収支
    public function monthly()
    {
        // すべての支出と収入を取得
        $expenses = Expense::with('category')->get();

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

        // 月ごとの集計データをビューに渡す
        return view('monthly.index', compact('monthlySums', 'monthlyExpenses'));
    }

    // 週ごとの収支
    public function weekly()
    {
        // すべての支出と収入を取得
        $expenses = Expense::with('category')->get();

        // 週ごとの収入と支出を集計
        $weeklyExpenses = $expenses->groupBy(function ($expense) {
            return Carbon::parse($expense->date)->format('Y-W'); // 年-週番号形式でグループ化
        });

        $weeklySums = $weeklyExpenses->map(function ($expenses) {
            $incomeTotal = $expenses->where('type', 1)->sum('amount'); // 収入の合計
            $expenseTotal = $expenses->where('type', 0)->sum('amount'); // 支出の合計
            $balance = $incomeTotal - $expenseTotal; // 収支差額
            return [
                'incomeTotal' => $incomeTotal,
                'expenseTotal' => $expenseTotal,
                'balance' => $balance
            ];
        });

        // 週ごとの集計データをビューに渡す
        return view('weekly.index', compact('weeklySums'));
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
