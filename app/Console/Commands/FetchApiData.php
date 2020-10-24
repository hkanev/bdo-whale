<?php

namespace App\Console\Commands;

use App\Models\FetchInfo;
use App\Models\Item;
use App\Models\ItemPerDay;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching data from bdo whale api';
    /**
     * @var string
     */
    protected $date;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->date = Carbon::today()->addDay()->toDateString();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lastUpdate =FetchInfo::orderBy('created_at', 'desc')->first();
        if($lastUpdate->created_at->diffInHours(Carbon::now()) === 0){
            return;
        }

        $start = microtime(true);
        $data = array_filter($this->fetchData(), static function ($item) {
            return $item['lastHour'] > 0;
        });
        DB::beginTransaction();
        foreach ($data as $count => $jsonItem) {
            $item = Item::firstOrCreate(['ref' => $jsonItem['mainKey'], 'name' => $jsonItem['name']]);

            $todayItem = ItemPerDay::firstOrNew([
                'date' => $this->date,
                'item_id' => $item->id,
            ]);

            $todayItem->today_items += $jsonItem['lastHour'];
            $todayItem->total_items += $jsonItem['totalSumCount'];
            $todayItem->save();
        }
        DB::commit();

        FetchInfo::create([
            'execution_time' => microtime(true) - $start,
            'item_count' => count($data),
            'created_at' =>  $this->date = Carbon::now(),
        ]);
    }

    protected function fetchData() {
        $url = 'https://bdowhaletracker.com/market-data-eu.json';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($curl);
        curl_close ($curl);
        return \json_decode($response, true)['data'];
    }
}
