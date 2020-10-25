<?php

namespace App\Http\Controllers;

use App\Models\ItemPerDay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function header() {
//        $itemsToday = ItemPerDay::fetchItemsForNDays(7);
        $itemsToday = ItemPerDay::fetchTodayItems();
//        return new JsonResponse($itemsToday);
        return view('tracker',  ['items' => $itemsToday]);
    }
}
