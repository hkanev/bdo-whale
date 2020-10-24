<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $guarded = [];

    public function itemsPerDay() {
        return $this->hasMany(ItemPerDay::class);
    }

    public $timestamps = false;
}
