<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
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
    
    $newsSa = Cache::remember('newsSa',900, function () {
        return Http::get('https://newsapi.org/v2/top-headlines?q=corona&country=za&pageSize=100&sortBy=publishedAt&apiKey='.env('NEWS_API_KEY'))->body();
    });   
    $newsWorld = Cache::remember('newsWorld',900, function () {
        return Http::get('https://newsapi.org/v2/top-headlines?q=corona&pageSize=100&language=en&page=1&sortBy=publishedAt&apiKey='.env('NEWS_API_KEY'))->body();
    });  
    
    $historicalData = Cache::remember('historicalData',30000, function () {
        return Http::get('https://corona.lmao.ninja/v2/historical')->body();
    });   

    $saCoronaUpdate =  Cache::remember('saCoronaUpdate',30000, function () {

        $info = [];
        $xmlData = simplexml_load_string(Http::get('https://sacoronavirus.co.za/feed/')->body());

        foreach ($xmlData->channel->item as $item){
            if (strpos($item->title, 'Update of COVID-19') !== false) {
                $info['title'] =(string)$item->title;
                $info['link'] = (string)$item->link;
                $info['data'] = (string)$item->children('http://purl.org/rss/1.0/modules/content/')->encoded;
                break;
            }     
        }

       return $info;
    });   
      
       
    
    return view('welcome',
        ['newsSa' => $newsSa, 
        'newsWorld' => $newsWorld, 
        'historicalData' => $historicalData,
        'saCoronaUpdate' => json_encode($saCoronaUpdate)]);
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
