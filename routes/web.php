<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::get('/set',function (Request $request){
    $old_ip = Cache::get("ip");
    $ip = $request->ip();
    if (strcmp($old_ip, $ip) != 0) {
        Log::debug('IP changed to' . $ip);
    }
    Cache::put("ip", $ip);
    return $ip;
});

Route::get('/', function (Request $request){
    return redirect()->away("http://" . Cache::get("ip"));
});