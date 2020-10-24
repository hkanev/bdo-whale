<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPerDay extends Model
{
    use HasFactory;

    protected $table = 'item_per_day';

    protected $guarded = [];

    public function itemsPerDay() {
        return $this->belongsTo(Item::class);
    }

    public $timestamps = false;
}
