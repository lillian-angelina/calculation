<?php

namespace Database\Seeders;

// database/seeders/TransactionSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // テストデータの作成
        Transaction::insert([
            [
                'type' => '収入',
                'category' => '給与',
                'amount' => 100000,
                'description' => '月給',
                'date' => '2025-03-01',
            ],
            [
                'type' => '支出',
                'category' => '食費',
                'amount' => 20000,
                'description' => 'ランチ代',
                'date' => '2025-03-05',
            ],
            [
                'type' => '支出',
                'category' => '交通費',
                'amount' => 5000,
                'description' => '通勤費',
                'date' => '2025-03-10',
            ],
            [
                'type' => '収入',
                'category' => '副業',
                'amount' => 30000,
                'description' => 'フリーランスの報酬',
                'date' => '2025-03-15',
            ],
        ]);
    }
}
