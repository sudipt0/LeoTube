@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <channel-uploads inline-template :channel="{{ $channel }}">
            <div class="col-md-8">
                <div class="card p-3 d-flex justify-content-center align-items-center" v-if="!selected">
                    <svg onclick="document.getElementById('video-files').click()" width="70px" height="70px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m341.159 342.767c0-47.059 38.095-85.344 84.919-85.344 21.848 0 41.789 8.339 56.854 22.009v-190.369c0-3.395-2.766-6.175-6.145-6.175h-470.643c-3.38 0-6.144 2.78-6.144 6.175v309.954c0 3.396 2.765 6.175 6.144 6.175h362.113c-16.654-15.591-27.098-37.8-27.098-62.425z" fill="#3d5959"/><path d="m32.451 399.018v-309.955c0-3.395 2.764-6.175 6.145-6.175h-32.452c-3.38 0-6.144 2.78-6.144 6.175v309.954c0 3.396 2.765 6.175 6.144 6.175h32.451c-3.38 0-6.144-2.778-6.144-6.174z" fill="#374949"/><path d="m341.159 342.767c0-29.813 15.3-56.088 38.412-71.354v-188.524h-276.211v322.304h264.897c-16.654-15.592-27.098-37.801-27.098-62.426z" fill="#8c9ba7"/><path d="m103.36 82.889h31.985v322.304h-31.985z" fill="#798b97"/><path d="m186.925 179.459c0-2.835 1.987-3.961 4.417-2.503l115.871 69.557c2.429 1.459 2.429 3.845 0 5.304l-115.871 69.553c-2.43 1.458-4.417.332-4.417-2.503z" fill="#fd646f"/><path d="m218.913 193.508-27.571-16.552c-2.43-1.458-4.417-.332-4.417 2.503v139.407c0 2.835 1.987 3.961 4.417 2.503l27.571-16.551z" fill="#fc4755"/><g fill="#fff"><path d="m69.537 152.656c0 1.702-1.391 3.093-3.091 3.093h-27.814c-1.7 0-3.091-1.391-3.091-3.093v-27.832c0-1.702 1.391-3.093 3.091-3.093h27.814c1.7 0 3.091 1.391 3.091 3.093z"/><path d="m69.537 222.755c0 1.701-1.391 3.093-3.091 3.093h-27.814c-1.7 0-3.091-1.392-3.091-3.093v-27.833c0-1.701 1.391-3.093 3.091-3.093h27.814c1.7 0 3.091 1.392 3.091 3.093z"/><path d="m69.537 292.853c0 1.701-1.391 3.092-3.091 3.092h-27.814c-1.7 0-3.091-1.391-3.091-3.092v-27.833c0-1.701 1.391-3.092 3.091-3.092h27.814c1.7 0 3.091 1.391 3.091 3.092z"/><path d="m69.537 362.951c0 1.701-1.391 3.093-3.091 3.093h-27.814c-1.7 0-3.091-1.392-3.091-3.093v-27.833c0-1.701 1.391-3.093 3.091-3.093h27.814c1.7 0 3.091 1.392 3.091 3.093z"/><path d="m448.644 152.656c0 1.702-1.39 3.093-3.091 3.093h-27.814c-1.7 0-3.09-1.391-3.09-3.093v-27.832c0-1.702 1.39-3.093 3.09-3.093h27.814c1.701 0 3.091 1.391 3.091 3.093z"/><path d="m448.644 222.755c0 1.701-1.39 3.093-3.091 3.093h-27.814c-1.7 0-3.09-1.392-3.09-3.093v-27.833c0-1.701 1.39-3.093 3.09-3.093h27.814c1.701 0 3.091 1.392 3.091 3.093z"/></g><ellipse cx="426.08" cy="342.767" fill="#00c184" rx="85.92" ry="86.345"/><path d="m372.41 342.767c0-42.144 30.055-77.216 69.795-84.804-5.227-.996-10.611-1.54-16.127-1.54-47.45 0-85.919 38.659-85.919 86.344 0 47.688 38.469 86.345 85.919 86.345 5.516 0 10.9-.543 16.127-1.541-39.74-7.588-69.795-42.659-69.795-84.804z" fill="#07b17b"/><path d="m416.292 396.371c-2.276 0-4.121-1.846-4.121-4.123v-55.476h-19.383c-1.625 0-3.098-.957-3.762-2.44-.663-1.482-.395-3.218.688-4.432l33.29-37.294c.782-.876 1.899-1.377 3.073-1.377s2.292.501 3.074 1.377l33.29 37.294c1.083 1.214 1.352 2.949.688 4.432s-2.137 2.44-3.762 2.44h-19.383v55.476c0 2.277-1.846 4.123-4.121 4.123z" fill="#fff"/></svg>
                    <input type="file" multiple id="video-files" style="display: none" ref="videos" @change="upload">
                    <p class="text-center">Upload Videos</p>
                </div>
                <div class="card p-3" v-else>
                    <div class="my-4" v-for="video in videos">
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="{ width: `${video.percentage || progress[video.name]}%` }" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                @{{ video.percentage ? video.percentage === 100 ? 'Video Processing completed.' : 'Processing' : 'Uploading' }}
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div v-if="!video.thumbnail" class="d-flex justify-content-center align-items-center" style="height: 180px; color: white; font-size: 18px; background: #808080;">
                                        Loading thumbnail ...
                                </div>
                                <img v-else :src="video.thumbnail" style="width: 100%" alt="">
                            </div>
        
                            <div class="col-md-4">
                                <a v-if="video.percentage && video.percentage === 100" target="_blank" :href="`/videos/${video.id}`">
                                    @{{ video.title }}
                                </a>
                                <h4 v-else class="text-center">
                                   @{{ video.title ||  video.name}}
                                </h4>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </channel-uploads> 
    </div>
</div>
@endsection
