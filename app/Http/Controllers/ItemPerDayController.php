<?php

namespace App\Http\Controllers;

use App\Models\ItemPerDay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemPerDayController extends Controller
{
    public function today() {
        $itemsToday = ItemPerDay::fetchTodayItems();
        return view('tracker',  ['items' => $itemsToday, 'period' => 'Today']);
    }

    public function yesterday() {
        $itemsToday = ItemPerDay::fetchYesterdayItems();
        return view('tracker',  ['items' => $itemsToday, 'period' => 'Yesterday']);
    }

    public function lastThreeDays(){
        $itemsToday = ItemPerDay::fetchItemsForNDays(3);
        return view('tracker',  ['items' => $itemsToday, 'period' => 'Last 3 Days']);
    }

    public function lastWeek(){
        $itemsToday = ItemPerDay::fetchItemsForNDays(7);
        return view('tracker',  ['items' => $itemsToday, 'period' => 'Last Week']);
    }

    public function lastMonth() {
        $itemsToday = ItemPerDay::fetchItemsForNDays(3);
        return view('tracker',  ['items' => $itemsToday, 'period' => 'Last Month']);
    }
}
