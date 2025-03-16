<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::create([
            'type' => 0,
            'date' => now()->subDays(2),
            'title' => '電気代',
            'amount' => 5000,
            'category_id' => 2,
            'note' => '毎月の電気代'
        ]);

        Expense::create([
            'type' => 1,
            'date' => now()->subDays(1),
            'title' => '給与',
            'amount' => 300000,
            'category_id' => 1,
            'note' => '会社からの給与'
        ]);
    }
}
