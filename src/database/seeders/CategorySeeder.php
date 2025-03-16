<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['保険料', '水道光熱費', '通信費', '自動車費', '借用返済費', '食費', '日用品費', '交通費', '医療費', '特別費', 'その他'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
