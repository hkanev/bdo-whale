<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPerDay extends Model
{
    use HasFactory;

    protected $table = 'item_per_day';

    protected $guarded = [];

    protected $dates = ['date'];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public $timestamps = false;
}
