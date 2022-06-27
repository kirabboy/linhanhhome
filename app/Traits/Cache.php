<?php
namespace App\Traits;
use Illuminate\Support\Facades\Cache;

function forgetModel(){
    Cache::forget('blog_index');
    Cache::forget('blog_building');
    Cache::forget('room_home');
    Cache::forget('building_home');
    return true;
}