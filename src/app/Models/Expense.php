<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Expense;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'date', 'title', 'amount', 'category_id', 'note'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}