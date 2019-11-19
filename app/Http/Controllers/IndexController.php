<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $query = request()->search;

        $suggestedVideos = collect();
        $videos = collect();
        $channels = collect();

        if($query){
            $videos = Video::where('title', 'LIKE', "%{$query}%")->orWhere('description', 'LIKE', "%{$query}%")->paginate(1);
            $channels = Channel::where('name', 'LIKE', "%{$query}%")->orWhere('description', 'LIKE', "%{$query}%")->paginate(1, ['*'],'channel_page');
        }else{
            $suggestedVideos = Video::paginate(12);
            // dd($suggestedVideos);
        }

        return view('welcome')->with([
            'suggestedVideos' => $suggestedVideos,
            'videos' => $videos,
            'channels' => $channels

        ]);
    }
    public static function number_format_short( $n ) {
        if ($n > 0 && $n < 1000) {
            // 1 - 999
            $n_format = floor($n);
            $suffix = '';
        } else if ($n >= 1000 && $n < 1000000) {
            // 1k-999k
            $n_format = floor($n / 1000);
            $suffix = 'K+';
        } else if ($n >= 1000000 && $n < 1000000000) {
            // 1m-999m
            $n_format = floor($n / 1000000);
            $suffix = 'M+';
        } else if ($n >= 1000000000 && $n < 1000000000000) {
            // 1b-999b
            $n_format = floor($n / 1000000000);
            $suffix = 'B+';
        } else if ($n >= 1000000000000) {
            // 1t+
            $n_format = floor($n / 1000000000000);
            $suffix = 'T+';
        }else{
            $n_format = floor($n);
            $suffix = '';
        }

        return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
    }
}
