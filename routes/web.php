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
    
    return view('welcome',
        ['newsSa' => $newsSa, 
        'newsWorld' => $newsWorld, 
        'historicalData' => $historicalData]);
});

Route::get('/symptoms', function () {    
    return view('symptoms');
});

Route::get('/contacts', function () {    
    return view('contacts');
});
