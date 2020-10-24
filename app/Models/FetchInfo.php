<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FetchInfo extends Model
{
    use HasFactory;

    protected $table = 'fetch_info';

    protected $guarded = [];

    protected $dates = ['created_at'];

    public $timestamps = false;
}
