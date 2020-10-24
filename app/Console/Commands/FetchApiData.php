<?php

namespace App\Console\Commands;

use App\Models\FetchInfo;
use App\Models\Item;
use App\Models\ItemPerDay;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

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
        $start = microtime(true);

        if(!$this->isValid()){
            dump('Validation failed');
            return;
        }

        $fetchInfo = FetchInfo::create([
            'processed' => 0,
            'created_at' =>  Carbon::now(),
        ]);

        $data = $this->fetchData();

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

        $fetchInfo->execution_time = microtime(true) - $start;
        $fetchInfo->item_count = count($data);
        $fetchInfo->finished_at = Carbon::now();
        $fetchInfo->processed = 1;
        $fetchInfo->save();
        DB::commit();
    }

    protected function fetchData() {
        $url = 'https://bdowhaletracker.com/market-data-eu.json';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($curl);
        curl_close ($curl);

        return array_filter(\json_decode($response, true)['data'], static function ($item) {
            return $item['lastHour'] > 0;
        });
    }

    protected function isValid() {
        $workingCommand = FetchInfo::firstWhere('processed', 0);

        if($workingCommand){
            return false;
        }

        $lastUpdate =FetchInfo::orderBy('created_at', 'desc')->first();
        $lastUpdate->created_at = $lastUpdate->created_at->set('minute', 0);
        $lastUpdate->created_at = $lastUpdate->created_at->set('second', 0);
        return !($lastUpdate->created_at->diffInHours(Carbon::now()) === 0);
        return true;
    }
}
