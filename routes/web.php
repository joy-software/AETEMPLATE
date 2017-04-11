<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', 'HomeController@auth');

Route::get('/test', [
    'as' => 'test',
    'uses' => 'HomeController@index'
]);

Route::get('/','HomeController@index');

Route::get('/annuaire', [
    'as' => 'annuaire',
    'uses' => 'AnnuaireController@index'
]);

Route::get('/files', [
    'as' => 'files',
    'uses' => 'filesController@index'
]);

Route::get('/profile', [
    'as' => 'profile',
    'uses' => 'HomeController@profile'
]);

Auth::routes();



$middleware = array_merge(\Config::get('lfm.middlewares'), [
    '\Unisharp\Laravelfilemanager\middlewares\MultiUser',
    '\Unisharp\Laravelfilemanager\middlewares\CreateDefaultFolder'
]);
$prefix = \Config::get('lfm.prefix', 'laravel-filemanager');
$as = 'unisharp.lfm.';

// make sure authenticated
Route::group(compact('middleware', 'prefix', 'as'), function () {

    // Show LFM
    Route::get('/', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\LfmController@show',
        'as' => 'show'
    ]);

    // Show integration error messages
    Route::get('/errors', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\LfmController@getErrors',
        'as' => 'getErrors'
    ]);

    // upload
    Route::any('/upload', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\UploadController@upload',
        'as' => 'upload'
    ]);

    // list images & files
    Route::get('/jsonitems', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\ItemsController@getItems',
        'as' => 'getItems'
    ]);

    // folders
    Route::get('/newfolder', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\FolderController@getAddfolder',
        'as' => 'getAddfolder'
    ]);
    Route::get('/deletefolder', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\FolderController@getDeletefolder',
        'as' => 'getDeletefolder'
    ]);
    Route::get('/folders', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\FolderController@getFolders',
        'as' => 'getFolders'
    ]);

    // crop
    Route::get('/crop', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\CropController@getCrop',
        'as' => 'getCrop'
    ]);
    Route::get('/cropimage', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\CropController@getCropimage',
        'as' => 'getCropimage'
    ]);

    // rename
    Route::get('/rename', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\RenameController@getRename',
        'as' => 'getRename'
    ]);

    // scale/resize
    Route::get('/resize', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\ResizeController@getResize',
        'as' => 'getResize'
    ]);
    Route::get('/doresize', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\ResizeController@performResize',
        'as' => 'performResize'
    ]);

    // download
    Route::get('/download', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\DownloadController@getDownload',
        'as' => 'getDownload'
    ]);

    // delete
    Route::get('/delete', [
        'uses' => '\Unisharp\Laravelfilemanager\controllers\DeleteController@getDelete',
        'as' => 'getDelete'
    ]);

    Route::get('/demo', '\Unisharp\Laravelfilemanager\controllers\DemoController@index');
});

Route::post('/editProfile', [
    'as' => 'editProfile',
    'uses' => 'UserController@editProfile'
]);

Route::post('/editCredential', [
    'as' => 'editCredential',
    'uses' => 'UserController@editCredential'
]);

Route::get('/tester', [
    'as' => 'tester',
    'uses' => 'HomeController@tester'
]);


Auth::routes();

Route::get('/home', 'HomeController@index');
