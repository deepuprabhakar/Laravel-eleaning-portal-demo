<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['web']], function () {

    // Home Page - Dashboard
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);
    
    // Authorization
    Route::get('/login', ['as' => 'auth.login.form', 'uses' => 'Auth\SessionController@getLogin']);
    Route::post('/login', ['as' => 'auth.login.attempt', 'uses' => 'Auth\SessionController@postLogin']);
    Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionController@getLogout']);

    // Password Reset
    Route::get('password/reset/{code}', ['as' => 'auth.password.reset.form', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('password/reset/{code}', ['as' => 'auth.password.reset.attempt', 'uses' => 'Auth\PasswordController@postReset']);
    Route::get('password/reset', ['as' => 'auth.password.request.form', 'uses' => 'Auth\PasswordController@getRequest']);
    Route::post('password/reset', ['as' => 'auth.password.request.attempt', 'uses' => 'Auth\PasswordController@postRequest']);

    // Users
    Route::resource('users', 'UserController');

    // Roles
    Route::resource('roles', 'RoleController');

    /**
     * EL Admin Routes
     */
    
    Route::group(['prefix' => 'admin'], function(){

        Route::post('courses/{id}', ['as' => 'admin.courses.storeInfo', 'uses' => 'Admin\CourseController@storeInfo']);
        Route::resource('courses', 'Admin\CourseController');
        Route::resource('subjects', 'Admin\SubjectController');
        Route::resource('news', 'Admin\NewsController');
        Route::resource('students', 'Admin\StudentController');

        // Messages
        Route::get('messages/sent', ['as' => 'admin.messages.sent', 'uses' => 'Admin\MessageController@sent']);
        Route::get('messages/sent/{id}', ['as' => 'admin.messages.sentmessages', 'uses' => 'Admin\MessageController@sentmessages']);
        Route::post('messages/destroyMany', ['as' => 'admin.messages.destroyMany', 'uses' => 'Admin\MessageController@destroyMany']);
        Route::delete('messages/destroySent/{id}', ['as' => 'admin.messages.destroySent', 'uses' => 'Admin\MessageController@destroySent']);
        Route::post('messages/reply', ['as' => 'admin.messages.reply', 'uses' => 'Admin\MessageController@reply']);
        Route::resource('messages', 'Admin\MessageController');

        // Projects
        Route::resource('projects','Admin\ProjectController');

        // Units
        Route::get('{subject}/createunits/{id}',['as' => 'admin.units.create', 'uses' => 'Admin\UnitsController@create']);

        Route::get('admin/subject/{subject}/{id}',['as' => 'admin.units.index', 'uses' => 'Admin\UnitsController@index']);

        Route::resource('units','Admin\UnitsController', ['only' =>['index','show','store','edit','destroy','update']]);

        //Quiz
        Route::get('{subject}/quiz', ['as' => 'admin.quiz.index', 'uses' => 'Admin\QuizController@index']);
        Route::get('editquiz/{id}',['as' => 'admin.quiz.edit', 'uses' => 'Admin\QuizController@edit']);
        Route::patch('updatequiz/{id}',['as' => 'admin.quiz.update', 'uses' => 'Admin\QuizController@update']);
        Route::delete('deletequiz/{id}',['as' => 'admin.quiz.destroy', 'uses' => 'Admin\QuizController@destroy']);

        //Gallery
        Route::get('gallery', ['as' => 'admin.gallery', 'uses' => 'Admin\GalleryController@index']);
        Route::post('uploadImages', ['as' => 'admin.gallery.upload', 'uses' => 'Admin\GalleryController@upload']);
        Route::post('searchImages', ['as' => 'admin.gallery.search', 'uses' => 'Admin\GalleryController@search']);
    });

    /**
     * end of EL Admin Routes
     */
    
    // Ajax Fetch for Select2
    Route::post('/fetchBatch', 'Admin\StudentController@fetchBatch');
    Route::post('/fetchSem', 'Admin\SubjectController@fetchSem');
    Route::post('createDiscussion','Admin\DiscussionPromptController@create');
    Route::post('createQuiz','Admin\QuizController@create');


    /**
     * EL User Routes
     */
    //news
    Route::get('news', ['as' => 'news', 'uses' => 'User\NewsController@newsView']);
    Route::get('news/{id}', ['as' =>'news.show', 'uses' =>'User\NewsController@newsShow']);

    //articles
    Route::get('articles/list', ['as' => 'listArticles', 'uses' => 'User\ArticleController@listArticles']);
    Route::get('articles/deleteFile/{id}', ['as' => 'deleteFile', 'uses' => 'User\ArticleController@deleteFile']);
    Route::resource('articles', 'User\ArticleController');

    //modules
    Route::get('modules/semester/{id}',['as' => 'modules.index', 'uses' => 'User\ModulesController@index']);

    Route::get('modules/semester/{sem}/{subject}',['as' => 'modules.show', 'uses' => 'User\ModulesController@show']);
    Route::get('modules/semester/{sem}/{subject}/Quiz',['as' => 'modules.create', 'uses' => 'User\ModulesController@create' ]);

    Route::post('modules/semester/{sem}/{subject}/discussion',['as' => 'modules.store', 'uses' => 'User\ModulesController@store' ]);

    //profile
    Route::get('profile', ['as' =>'profile', 'uses' => 'User\ProfileController@profileView']);
    Route::patch('profile/{id}', ['as' => 'profile.update', 'uses' => 'User\ProfileController@update']);

    //messages
    Route::get('messages/sent', ['as' => 'messages.sent', 'uses' => 'User\MessageController@sent']);
    Route::get('messages/sent/{id}', ['as' => 'messages.sentmessages', 'uses' => 'User\MessageController@sentmessages']);
    Route::post('messages/destroyMany', ['as' => 'messages.destroyMany', 'uses' => 'User\MessageController@destroyMany']);
    Route::delete('messages/destroySent/{id}', ['as' => 'messages.destroySent', 'uses' => 'User\MessageController@destroySent']);
    Route::post('messages/reply', ['as' => 'messages.reply', 'uses' => 'User\MessageController@reply']);
    Route::resource('messages', 'User\MessageController');

    //quiz
    Route::get('quiz', ['as' => 'quiz', 'uses' => 'User\QuizController@quiz']);
    Route::post('quiz', ['as' => 'quiz.store', 'uses' => 'User\QuizController@store']);

    //course info
    Route::get('courseInfo', ['as' => 'courseInfo.index', 'uses' => 'User\CourseInfoController@index']);

    /**
     * end of EL User Routes
     */

});
