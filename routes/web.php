<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {

    $newsSa = Cache::remember('newsSa', 900, function () {
        try{
            return Http::get('https://newsapi.org/v2/top-headlines?q=corona&country=za&pageSize=100&sortBy=publishedAt&apiKey=' . env('NEWS_API_KEY'))->body();
        }catch(\Exception $e){
            return [];
        }
        
    });
    $newsWorld = Cache::remember('newsWorld', 900, function () {
        try{
            return Http::get('https://newsapi.org/v2/top-headlines?q=corona&pageSize=100&language=en&page=1&sortBy=publishedAt&apiKey=' . env('NEWS_API_KEY'))->body();
        }catch(\Exception $e){
            return [];
        }       
    });

    $historicalData = Cache::remember('historicalData', 30000, function () {
        try{
            return Http::get('https://corona.lmao.ninja/v2/historical')->body();
        }catch(\Exception $e){
            return [];
        }  
    });

    // $saProvinces =  [
    //         'Gauteng' => 704,
    //         'Western Cape' => 454,
    //         'KwaZulu Natal' => 246,
    //         'Freestate' =>     87,
    //         'North West' => 11,
    //         'Mpumalanga' => 18,
    //         'Limpopo' => 19,
    //         'Easter Cape' => 25,
    //         'Northern Cape' => 8,
    //         'UnAllocated' => 77
    //     ];

    //Scrape provinces info of sa corona website
    $saProvinces = Cache::remember('saProvinces',30000, function () {
        try{    
            $info = [];
            $xmlData = simplexml_load_string(Http::get('https://sacoronavirus.co.za/feed/')->body());

            foreach ($xmlData->channel->item as $item) {
                if (strpos(strtolower($item->title), 'update of covid-19') !== false) {
                    $info['title'] = (string) $item->title;
                    $info['link'] = (string) $item->link;
                    $info['data'] = (string) $item->children('http://purl.org/rss/1.0/modules/content/')->encoded;
                    break;
                }
            }

            $pos1 = strpos($info['data'], '<table class="NormalTable">');
            $pos2 = strpos($info['data'], '</table>');

            $tstr = substr($info['data'], $pos1, $pos2 - $pos1);

            $remWord = array(
                '<table class="NormalTable">',
                PHP_EOL,
                '<tbody>',
                '</tbody>',
                '<td width="200">',
                '</td>',
                '</span>',
                '<span class="fontstyle0">',
                '<tr>',
                '</tr>',
            );
            $provincesStr = strtolower(str_replace($remWord, "", $tstr));
            $pg = preg_replace('/\d(?=[a-z])/', '$0,', $provincesStr);

            $pArr = explode(',', $pg);

            if(count($pArr) == '10'){
                $newArr = [];
                foreach ($pArr as $key => $value) {
                    $spl = preg_replace('/\s(?=\d)/',',',$value);
                    $arr = explode(',',$spl);
                   
                    $newArr[$arr[0]] = $arr[1];
                }           
                return $newArr;
            }else{
                return [];
            }
        }catch(\Exception $e){
            return [];
        }        
        
    });

    // $saCoronaUpdate = Cache::remember('saCoronaUpdate', 30000, function () {

    //     $info = [];
    //     $xmlData = simplexml_load_string(Http::get('https://sacoronavirus.co.za/feed/')->body());

    //     foreach ($xmlData->channel->item as $item) {
    //         if (strpos($item->title, 'Update of COVID-19') !== false) {
    //             $info['title'] = (string) $item->title;
    //             $info['link'] = (string) $item->link;
    //             $info['data'] = (string) $item->children('http://purl.org/rss/1.0/modules/content/')->encoded;
    //             break;
    //         }
    //     }

    //     return $info;
    // });

    return view('welcome',
        [
            'newsSa' => $newsSa,
            'newsWorld' => $newsWorld,
            'historicalData' => $historicalData,
            'saProvinces' => json_encode($saProvinces),
            //'saCoronaUpdate' => json_encode($saCoronaUpdate)
        ]);
});

Route::get('/symptoms', function () {
    return view('symptoms');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/social-media-feeds', function () {
    return view('social-media-feeds');
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
});
