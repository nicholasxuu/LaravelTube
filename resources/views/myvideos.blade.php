@extends('layouts.app')

@section('htmlheader_title')
    My Videos
@endsection

@section('customs_scripts')
    <script src="{{ asset('js/my-videos.js') }}"></script>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="listMyVideos" class="col-md-12">
                <ul class="list-inline videoListCard">
                    <li v-for="video in videos">
                        <div class="card videoList">
                            <a class="videoLink" href="{{url('/#!/videos/')}}@{{video.id}}">
                                <video class="video-js videoCard">
                                    <source :src=video.path+'.webm' type='video/webm'>
                                    <source :src=video.path+'.mp4' type='video/mp4'>
                                </video>
                            </a>
                            <div class="card-block">
                                <input type="text" class="form-control" name="name" id="name@{{video.id}}" value=@{{video.name}}>
                                <select class="form-control" name="category" id="category@{{video.id}}">
                                    <optgroup label="Current">
                                        <option value=@{{video.category.id}}>@{{video.category.name}}</option>
                                    </optgroup>
                                    <optgroup label="Categories">
                                        <option v-for="category in categories" value=@{{category.id}}>@{{category.name}}</option>
                                    </optgroup>
                                </select>
                                <button type="button" class="btn btn-success pull-left updateVideo" @click="updateVideo(video.id)"><i class="fa fa-pencil" aria-hidden="true"></i>Update</button>
                                <button type="button" class="btn btn-danger pull-right deleteVideo" @click="deleteVideo(video.id)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection