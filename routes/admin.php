<?php

Route::group(['middleware' => ['auth', 'role:admin'], 'namespace' => 'Admin'], function () {
    Route::get('index', 'IndexController@index')->name('admin.index');
    Route::resource('users', 'UserController')->except(['show','update','destroy','edit']);
    Route::get('user/delete','UserController@delete')->name('user.remove');
    Route::get('user/edit','UserController@edit')->name('user.edit');
    Route::resource('courses/quizzes', 'Course\QuizController')->except(['show','update']);
    Route::resource('courses', 'Course\CourseController')->except(['show','update']);
    Route::resource('groups', 'GroupController')->except(['show','update']);
    Route::resource('certificates', 'CertificateController')->except(['show','update']);
    Route::resource('notifications', 'NotificationController')->except(['show','update']);
    Route::resource('lessons', 'LessonController')->except(['show','update']);

    Route::resource('transport/road', 'RoadController')->only(['index','create','store']);
    Route::get('transport/road/delete','RoadController@delete')->name('road.remove');
    Route::get('transport/road/edit','RoadController@edit')->name('road.edit');
    Route::resource('transport/sea', 'SeaController')->only(['index','create','store']);


    // ajax requests
    Route::post('/changeusergroup', 'UserController@changegroup')->name('users.changegroup');
});
