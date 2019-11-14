@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $video->title}}</div>

                <div class="card-body">
                    <video-js id="video" class="vjs-default-skin" controls preload="auto" width="640" height="268" data-setup='{"playbackRates": [1, 1.5, 2] }'>
                        <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL">
                    </video-js>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <style>
        .vjs-default-skin {
            width: 100%;
        }
        .thumbs-up, .thumbs-down {
            width: 20px;
            height: 20px;
            cursor: pointer;
            fill: currentColor;
        }
        .thumbs-down-active, .thumbs-up-active {
            color: #3EA6FF;
        }
        .thumbs-down {
            margin-left: 1rem;
        }
    </style>

    <style>
        .w-full {
            width: 100% !important;
        }
        .w-80 {
            width: 80% !important;
        }
    </style>
@endsection

@section('scripts')
<script src="https://unpkg.com/video.js/dist/video.js"></script>
<script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>

    <script>
        window.CURRENT_VIDEO = '{{ $video->id }}'
    </script>
    <script src='{{ asset('js/player.js') }}'></script>
@endsection