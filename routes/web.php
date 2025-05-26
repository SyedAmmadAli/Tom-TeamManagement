<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\autoEnhanced\AutoEnhancedController;
use App\Http\Controllers\GPT\GptController;
use App\Http\Controllers\media\MediaController;
use App\Http\Controllers\notification\NotificaionController;
use App\Http\Controllers\social\SocialController;
use App\Http\Controllers\tasks\TaskController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\UserAccess;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;


Route::view('/404', 'dashboard.404')->name('error404');
Route::view('/403', 'dashboard.403')->name('error403');

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'Login')->name('login');
    Route::post('/process-login', 'ProcessLogin')->name('process-login');
    Route::get('/logout', 'Logout')->name('logout');

    Route::middleware(ValidUser::class)->group(function () {
        Route::get('/index', 'Index')->name('dashboard');
        Route::get('/profile', 'Profile')->name('profile');
        Route::post('/update-profile', 'UpdateProfile')->name('updateProfile');
        Route::get('/change-password', 'ChangePassword')->name('changePassword');
        Route::post('/process-changepassword', 'ProcessChangePassword')->name('processChangePass');
        Route::post('/upload-profile', 'Upload')->name('profile.upload');
    });
});

Route::controller(AdminController::class)
    ->middleware(ValidUser::class)
    ->group(function () {
        Route::get('/create-user', 'CreateUser')->name('createUser')->middleware(AdminAccess::class);
        Route::post('/process-createuser', 'ProcessCreateUser')->name('processCreateUser')->middleware(AdminAccess::class);
        Route::get('/view-users', 'ViewUsers')->name('viewUsers')->middleware(AdminAccess::class);
        Route::get('/edit-user/{id}', 'EditUser')->name('editUser')->middleware(AdminAccess::class);
        Route::post('/process-edituser/{id}', 'ProcessEditUser')->name('processEditUser')->middleware(AdminAccess::class);
        Route::get('/delete-user/{id}', 'DeleteUser')->name('deleteUser')->middleware(AdminAccess::class);
        Route::get('/calender', 'Calender')->name('calender')->middleware(UserAccess::class);
    });

Route::controller(TaskController::class)
    ->middleware(ValidUser::class)

    ->group(function () {
        Route::get('/create-task', 'CreateTask')->name('createTask')->middleware(UserAccess::class);
        Route::post('/process-createtask', 'ProcessCreateTask')->name('process-CreateTask');
        Route::get('/view-tasks', 'ViewTasks')->name('viewTasks')->middleware(UserAccess::class);
        Route::get('/view-taskdetails/{id}', 'ViewTaskDetails')->name('viewTaskDetails')->middleware(UserAccess::class);;
        Route::get('/change-taskstatus/{id}', 'ChangeTaskStatus')->name('changeTaskStatus')->middleware(UserAccess::class);
        Route::get('/change-taskstatusOpen/{id}', 'ChangeTaskStatusOpen')->name('changeTaskStatusOpen');
        Route::get('/edit-task/{id}', 'EditTask')->name('editTask')->middleware(UserAccess::class);
        Route::post('/process-edittask/{id}', 'ProcessEditTask')->name('processEditTask');
        Route::get('/delete-task/{id}', 'DeleteTask')->name('deleteTask')->middleware(AdminAccess::class);
        Route::post('/remove-attachment','removeAttachment')->name('remove.attachment');
        Route::get('/tasks/events', 'getTasks')->name('tasks.events')->middleware(UserAccess::class);;
        Route::get('/tasks/calender', 'GetData')->name('getdata');
    });


// Route::post('/send-notification', [NotificaionController::class, 'sendNotification'])->middleware(ValidUser::class)->name('send.notification');
// Route::get('/notifications', [NotificaionController::class, 'fetchNotifications'])->middleware(ValidUser::class)->name('notifications.fetch');
// Route::post('/notifications/mark-as-read', [NotificaionController::class, 'markAsRead'])->middleware(ValidUser::class)->name('notifications.markAsRead');

Route::controller(NotificaionController::class)
    ->middleware(ValidUser::class)

    ->group(function () {
        Route::post('/send-notification', 'sendNotification')->name('send.notification');
        Route::get('/notifications', 'fetchNotifications')->name('notifications.fetch');
        Route::post('/notifications/mark-as-read', 'markAsRead')->name('notifications.markAsRead');
        Route::post('/notifications/mark-as-read', 'MarkAsReadNoti')->name('notifications.markAsRead');
    });


Route::controller(MediaController::class)
    ->middleware(ValidUser::class)

    ->group(function () {
        Route::get('/view-media', 'ViewMedia')->name('viewMedia')->middleware(UserAccess::class);
        Route::get('/upload-media', 'UploadMedia')->name('uploadMedia')->middleware(UserAccess::class);;
        Route::post('/process-uploadMedia', 'ProcessUploadMedia')->name('processUploadMedia');
        Route::delete('/media/{id}', 'destroy')->name('media.delete')->middleware(UserAccess::class);;
        Route::post('/process-upload-media', 'ProcessUploadTaskMedia')->name('processUploadTaskMedia');
        Route::post('/media/ajax-upload', 'ajaxUpload')->name('media.upload');
        Route::get('/media-gallery', 'getMediaGallery')->name('media-gallery');
        Route::get('/media/filter', 'filterByCategory')->name('media.filter.byCategory');
    });


// use App\Http\Controllers\social\SocialController;

Route::controller(SocialController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('facebook.login');
    // Route::get('auth/facebook/callback', 'handleFacebookCallback')->name('facebook.callback');
    Route::get('facebook/callback', 'handleFacebookCallback');
    Route::get('facebook/login-check', 'FacebookLoginCheck')->name('facebook.login.check');
    Route::post('/facebook/post', 'postToPage')->name('facebook.post');
    Route::get('/privacy-policy', 'PrivacyPolicy')->name('privacyPolicy');

    Route::get('/instagram/post', 'CreateInstaPost')->name('instagram.post')->middleware(UserAccess::class);
    Route::post('/instagram/upload', 'postToInstagram')->name('instagram.upload');

    Route::get('/fb-data-deletion', 'dataDeletion');

    // Route::post('/instagram/posttoInsta', 'PosttoInsta')->name('instagram.upload');

});

// 👇 Public route for redirect and callback (no login required)
// Route::get('/facebook/login', [SocialController::class, 'redirectToFacebook'])->name('facebook.login');
// Route::get('/facebook/callback', [SocialController::class, 'handleFacebookCallback'])->name('facebook.callback');
// // Post to Facebook Page
// Route::post('/facebook/post', [SocialController::class, 'postToPage'])->name('facebook.post');

Route::controller(AutoEnhancedController::class)
    ->middleware(ValidUser::class)

    ->group(function () {

        Route::get('/autoenhanced/upload', 'AutoEnhanceForm')->name('autoenhanced.upload');
        Route::get('/autoenhanced/uploadJS', 'AutoEnhanceFormJS')->name('autoenhanced.uploadjs')->middleware(UserAccess::class);
        Route::post('/autoenhanced/enhance', 'enhanceImage')->name('enhance.image');
        // Route::get('/autoenhanced/view', 'ViewAutoEnhanced')->name('autoenhanced.view');
        Route::get('/preview-enhanced-image/{imageId}', 'previewEnhancedImage')->name('preview.enhanced.image');
    });


Route::controller(GptController::class)
    ->middleware(ValidUser::class)

    ->group(function () {
        Route::get('/chatgpt', 'index')->name('chatgpt');
        // Route::post('/ask-chatgpt', 'ask')->name('ask.chatgpt');
        Route::get('/property-Details-Generator', 'PropDetails')->name('propertyDetailsGenerator')->middleware(UserAccess::class);
        Route::post('/property-Detail-Response', 'PropertyDetailsResponse')->name('propertyDetailResponse');
        Route::post('/generate-prompt', 'generatePromptFromImage')->name('generate.prompt');
    });
