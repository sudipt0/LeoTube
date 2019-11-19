@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if($video->editable())
                    <form action="{{ route('videos.update', $video->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                @endif

                    <div class="card-header">{{ $video->title }}</div>

                    <div class="card-body p-0">
                        <video-js id="video" class="vjs-default-skin vjs-big-play-centered" controls preload="auto" width="640" height="300"
                        poster="{{ asset(Storage::url("thumbnails/{$video->id}.png")) }}">
                            <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL">
                        </video-js>
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mt-3">
                                        @if($video->editable())
                                            <input type="text" class="form-control" value="{{ $video->title }}" name="title">
                                        @else
                                            {{ $video->title }}
                                        @endif
                                    </h4>
                                    {{ $video->views }} {{ str_plural('view', $video->views) }}
                                </div>

                                <votes :default_votes='{{ $video->votes }}' entity_id="{{ $video->id }}" entity_owner="{{ $video->channel->user_id }}"> </votes>
                            </div>

                            <hr>

                            <div>
                                @if($video->editable())
                                    <textarea name="description" cols="3" rows="3" class="form-control">{{ $video->description }}</textarea>

                                    <div class="text-right mt-4">
                                            <button class="btn btn-info btn-sm" type="submit">Update video details</button>
                                    </div>
                                @else
                                    {{ $video->description }}
                                @endif
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <div class="media">
                                    <img class="rounded-circle" src="https://picsum.photos/id/42/200/200" width="50" height="50" class="mr-3" alt="...">
                                    <div class="media-body ml-2">
                                        <h5 class="mt-0 mb-0">
                                            {{ $video->channel->name }}
                                        </h5>
                                        <span class="small">Published on {{ $video->created_at->toFormattedDateString() }}</span>
                                    </div>
                                </div>

                                <subscribe-button :channel="{{ $video->channel }}" :initial-subscriptions="{{ $video->channel->subscriptions }}" />
                            </div>
                        </div>
                    </div>
                @if($video->editable())
                </form>
                @endif
            </div>

            <comments :video="{{ $video }}"></comments>

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
        #video *{
            outline: none;
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
        .w-full {
            width: 100% !important;
        }
        .w-80 {
            width: 80% !important;
        }
        .video-js .vjs-big-play-button {
            border: none;
        }

        .vjs-big-play-button {
            background-color: #B37D5B;
            opacity: .6;
            border: none;
            border-radius: 50%;
        }


    </style>
@endsection

@section('scripts')
<!-- <script src="https://vjs.zencdn.net/7.5.5/video.js"></script> -->

<script src="https://unpkg.com/video.js/dist/video.min.js"></script>
<script src="{{ asset('js/videojs/videojs.hotkeys.min.js') }}"></script>
<script src="https://unpkg.com/videojs-flash/dist/videojs-flash.min.js"></script>
<script src="https://unpkg.com/videojs-contrib-quality-levels/dist/videojs-contrib-quality-levels.min.js"></script>
<script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.min.js"></script>

    <script>
        window.CURRENT_VIDEO = '{{ $video->id }}'
    </script>
    <script src="{{ asset('js/player.js') }}"></script>
@endsection
