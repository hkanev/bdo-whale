<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Error\Error;

class ItemPerDay extends Model
{
    use HasFactory;

    protected $table = 'item_per_day';

    protected $guarded = [];

    protected $dates = ['date'];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public static function fetchTodayItems()
    {
        return self::whereDate('date', Carbon::now())->with('item')->orderBy('today_items', 'desc')->get();
    }

    public static function fetchYesterdayItems()
    {
        return self::whereDate('date', Carbon::now()->subDay())->with('item')->orderBy('today_items', 'desc')->get();
    }

    public static function fetchItemsForNDays($days) {
        if($days <= 0){
            throw new \Exception('Days must be positive number');
        }

        return  self::whereBetween('date', [Carbon::now()->subDays($days), Carbon::now()])
                ->selectRaw('sum(today_items) as today_items, item_id, max(total_items) as total_items')
                ->with('item')
                ->groupBy('item_id')
                ->orderBy('today_items', 'desc')
                ->get();
    }

    public $timestamps = false;
}
