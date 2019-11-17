<?php

namespace App\Http\Controllers;


use App\Channel;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
        
        return view('home')->with([
            'suggestedVideos' => $suggestedVideos,
            'videos' => $videos,
            'channels' => $channels
            
        ]);
    }
}

/* APP_NAME=LeoTube
APP_ENV=local
APP_KEY=base64:OMCVTaUisj6STpY6ThJzBDvlK7jDWfSs7sJAyGi2ics=
APP_DEBUG=true
APP_URL=https://leotube.dev

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=remotemysql.com
DB_PORT=3306
DB_DATABASE=uxggt8k9Zh
DB_USERNAME=uxggt8k9Zh
DB_PASSWORD=bWTSXrTao9

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
 */
