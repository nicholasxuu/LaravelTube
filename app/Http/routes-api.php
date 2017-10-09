<?php

Route::group(['prefix' => 'api'], function () {
    //Api Videos
    Route::get('videos', 'api\VideoController@getAllVideos');
    Route::get('videos/best', 'api\VideoController@getBestVideos');
    Route::get('videos/user/{id}', 'api\VideoController@getVideosUser');
    Route::get('videos/category/{name}', 'api\VideoController@getVideosForCategory');
    Route::get('videos/search/{name}', 'api\VideoController@getVideosForSearch');
    Route::post('videos', 'api\VideoController@store');
    Route::get('videos/{id}', 'api\VideoController@show');
    Route::put('videos/{id}', 'api\VideoController@update');
    Route::delete('videos/{id}', 'api\VideoController@destroy');

    //Likes
    Route::get('videos/{id}/likes', 'api\LikeDislikeController@getLikes');
    Route::get('videos/{id}/likes/count', 'api\LikeDislikeController@getLikesCount');
    Route::get('videos/{id}/dislikes', 'api\LikeDislikeController@getDislikes');
    Route::get('videos/{id}/dislikes/count', 'api\LikeDislikeController@getDislikesCount');
    Route::post('videos/{id}/like-dislike', 'api\LikeDislikeController@store');

    //User
    Route::get('users/', 'api\UserController@getAllUsers');
    Route::get('users/{id}', 'api\UserController@show');
    Route::post('users/{id}', 'api\UserController@update');
    Route::delete('users/{id}', 'api\UserController@delete');

    //Comments
    Route::get('videos/{id}/comments', 'api\CommentController@getComments');
    Route::post('videos/{id}/comments', 'api\CommentController@store');
    Route::put('videos/{video_id}/comments', 'api\CommentController@update');
    Route::delete('videos/{video_id}/comments', 'api\CommentController@delete');

    // Categories
    Route::get('categories', 'api\CategoryController@getAll');
    Route::get('categories/{id}', 'api\CategoryController@show');
    Route::post('categories', 'api\CategoryController@store');
    Route::post('categories/{id}', 'api\CategoryController@update');
    Route::delete('categories/{id}', 'api\CategoryController@destroy');
});
