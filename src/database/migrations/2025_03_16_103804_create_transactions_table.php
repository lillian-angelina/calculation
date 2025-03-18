<?php

// database/migrations/xxxx_xx_xx_create_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 収入 or 支出
            $table->string('category'); // カテゴリ (例: 食費, 交通費, 給与)
            $table->integer('amount'); // 金額
            $table->text('description')->nullable(); // 説明
            $table->date('date'); // 日付
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
