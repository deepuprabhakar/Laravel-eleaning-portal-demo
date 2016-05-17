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
    Route::get('', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);
    
    // Authorization
    Route::get('/login', ['as' => 'auth.login.form', 'uses' => 'Auth\SessionController@getLogin']);
    Route::post('/login', ['as' => 'auth.login.attempt', 'uses' => 'Auth\SessionController@postLogin']);
    Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionController@getLogout']);

    // Registration
    Route::get('register', ['as' => 'auth.register.form', 'uses' => 'Auth\RegistrationController@getRegister']);
    Route::post('register', ['as' => 'auth.register.attempt', 'uses' => 'Auth\RegistrationController@postRegister']);

    // Activation
    Route::get('activate/{code}', ['as' => 'auth.activation.attempt', 'uses' => 'Auth\RegistrationController@getActivate']);
    Route::get('resend', ['as' => 'auth.activation.request', 'uses' => 'Auth\RegistrationController@getResend']);
    Route::post('resend', ['as' => 'auth.activation.resend', 'uses' => 'Auth\RegistrationController@postResend']);

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

        // Units
        Route::get('{subject}/createunits/{id}',['as' => 'admin.units.create', 'uses' => 'Admin\UnitsController@create']);

        Route::get('admin/subject/{subject}/{id}',['as' => 'admin.units.index', 'uses' => 'Admin\UnitsController@index']);

        Route::resource('units','Admin\UnitsController', ['only' =>['index','show','store','edit','destroy','update']]);

        //Quiz
        Route::get('{subject}/quiz', ['as' => 'admin.quiz.index', 'uses' => 'Admin\QuizController@index']);
        Route::get('editquiz/{id}',['as' => 'admin.quiz.edit', 'uses' => 'Admin\QuizController@edit']);
        Route::patch('updatequiz/{id}',['as' => 'admin.quiz.update', 'uses' => 'Admin\QuizController@update']);
        Route::delete('deletequiz/{id}',['as' => 'admin.quiz.destroy', 'uses' => 'Admin\QuizController@destroy']);
        
        //Assignment
        Route::post('assignment/save/{id}', ['as' => 'admin.assignment.create', 'uses' => 'Admin\AssignmentController@create']);
        
        //Gallery
        Route::get('gallery', ['as' => 'admin.gallery', 'uses' => 'Admin\GalleryController@index']);
        Route::post('uploadImages', ['as' => 'admin.gallery.upload', 'uses' => 'Admin\GalleryController@upload']);
        Route::post('searchImages', ['as' => 'admin.gallery.search', 'uses' => 'Admin\GalleryController@search']);

        //Projects
        Route::get('projects', ['as' => 'admin.projects', 'uses' => 'Admin\ProjectController@viewProjects']);
        Route::post('/projects', 'Admin\ProjectController@saveMarks');

        //progress
        Route::get('progress', ['as' => 'admin.progress', 'uses' => 'Admin\ProgressController@progress']);

           


    });

    /**
     * end of EL Admin Routes
     */
    
    // Ajax Fetch 
    Route::post('/fetchBatch', 'Admin\StudentController@fetchBatch');
    Route::post('/fetchSem', 'Admin\SubjectController@fetchSem');
    Route::post('createDiscussion','Admin\DiscussionPromptController@create');
    Route::post('createQuiz','Admin\QuizController@create');
    Route::post('/fetchProjects', 'Admin\ProjectController@fetchProjects');
    Route::post('/fetchSubjects', 'Admin\ProgressController@fetchSubjects');
    Route::post('/fetchProgress', 'Admin\ProgressController@fetchProgress');
    Route::post('/uploadProfilePic', 'User\ProfileController@uploadProfilePic');
    Route::post('/cropImage', 'User\ProfileController@cropImage');
    Route::post('/deleteProfilePhoto', 'User\ProfileController@deleteProfilePhoto');


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

    // Assignment create
    Route::post('modules/createAssignment',['as' => 'modules.createAssignment', 'uses' => 'User\AssignmentsController@createAssignment' ]);
    Route::post('fetchAssignments', 'User\AssignmentsController@fetch');
    Route::post('assignment/{id}',['as' => 'modules.destroy', 'uses' => 'User\AssignmentsController@destroy' ]);


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

    //progress
        Route::get('progress/semester/{id}', ['as' => 'progress.index', 'uses' => 'User\ProgressController@index']);
    


    //project
    Route::resource('project', 'User\ProjectController');


    /**
     * end of EL User Routes
     */

});
