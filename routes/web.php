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




Route::get('/','HomeController@index');


Route::get('/annuaire', [
    'as' => 'annuaire',
    'uses' => 'AnnuaireController@index'
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

/**
 * Routes pour le profil
 */

Route::post('/editProfile', [
    'as' => 'editProfile',
    'uses' => 'UserController@editProfile'
]);

Route::post('/editCredential', [
    'as' => 'editCredential',
    'uses' => 'UserController@editCredential'
]);

/**
 * Routes pour les videos
 */

Route::get('/tester', [
    'as' => 'tester',
    'uses' => 'HomeController@tester'
]);


Route::post('/tester/upload', [
    'as' => 'post_tester_upload',
    'uses' => 'VideoController@uploadVideo'
]);

Route::get('/video/list', [
    'as' => 'video_list',
    'uses' => 'VideoController@listVideo'
]);

Route::post('/video/upload', [
    'as' => 'post_video_upload',
    'uses' => 'VideoController@uploadVideo'
]);

Route::get('/video/view/{id}', [
    'as' => 'video_view',
    'uses' => 'VideoController@viewVideo'
]);


/**
 * Route pour recupérer les tokens de l'api Google
 */

Route::get('/google/get_token', [
    'as' => 'google_get_token',
    'uses' => 'GoogleController@getToken'
]);



Route::get('/accueil', [
    'as' => 'accueil',
    'uses' => 'HomeController@index'
]);


Auth::routes();




Route::get('/home', 'HomeController@index');



/****
 *
 *  route pour les groupes.
 */

Route::get('/group/create_group', [
    'as'=>'create_group',
    'uses'=>'groupController@create_group'
]);

Route::get('/group/', [
    'as'=>'index',
    'uses'=>'groupController@index'
]);

Route::get('/group/search_group', [
    'as'=>'search_group',
    'uses'=>'groupController@search_group'
]);

Route::post('/group/post_create_group', [
    'as' =>'post_create_group',
    'uses'=>'groupController@post_create_group'
]);

//Route::get('/group/view_group', 'groupController@index');

Route::get('/group/view_group/{id}', [
    'as'=>'view_group',
    'uses'=>'groupController@view_group',
    'middleware' => 'group'
]);

Route::get('/group/meeting_group/{id}', [
    'as'=>'meeting_group',
    'uses'=>'groupController@meeting_group',
    'middleware' => 'group'
]);

Route::get('/group/view_group', 'groupController@index');

//Route::get('/group/valid_adhesion_group/{id_user}/{id_group}', 'groupController@valid_adhesion_group');
Route::post('/group/valid_adhesion_group', 'groupController@valid_adhesion_group');


Route::post('/group/del_adhesion_group', 'groupController@del_adhesion_group');


//Supprimer un groupe
Route::get('/group/del_group/{id}', [
    'as'=>'del_group',
    'uses'=>'groupController@del_group',
    'middleware' => 'group'
]);
Route::post('/group/valid_del_group', [
    'as'=>'valid_del_group',
    'uses'=>'groupController@valid_del_group',
    'middleware' => 'group'
]);
Route::get('/group/valid_del_group', 'groupController@search_group');
Route::get('/group/del_group', 'groupController@search_group');



//editer un groupe
Route::get('/group/edit_group/{id}', [
    'as'=>'edit_group',
    'uses'=>'groupController@edit_group',
    'middleware' => 'group'
]);
Route::post('/group/valid_edit_group',[
    'as'=> 'valid_edit_group',
    'uses'=>'groupController@valid_edit_group',
    'middleware' => 'group'
    ]);
Route::get('/group/edit_group', 'groupController@search_group');
Route::get('/group/valid_edit_group', 'groupController@search_group');


//demander une invitation à un groupe.
Route::get('/group/invitation_group/{id}', [
    'as'=>'invitation_group',
    'uses'=>'groupController@invitation_group',
    'middleware' => 'group'
]);
Route::get('/group/invitation_group', 'groupController@search_group');
Route::post('/group/valid_invitation_group', [
    'as'=>'valid_invitation_group',
    'uses'=>'groupController@valid_invitation_group'
]);
Route::get('/group/valid_invitation_group', 'groupController@search_group');

//Liste des membres d'un groupe.

Route::get('/group/member_group/{id}', [
    'as'=>'member_group',
    'uses'=>'groupController@member_group',
    'middleware' => 'group'
]);

Route::get('/group/member_group', 'groupController@index');

Route::get('/group/event_group/{id}', [
    'as'=>'event_group',
    'uses'=>'groupController@event_group',
    'middleware' => 'group'
]);
Route::get('/group/event_group', 'groupController@index');

/**
 * Ads et Event.
 */
Route::post('/group/post_ads', [
    'as'=>'post_ads',
    'uses'=>'groupController@post_ads',
]);

Route::get('/group/ads_group/{id}', [
    'as'=>'ads_group',
    'uses'=>'groupController@ads_group',
    'middleware' => 'group'
]);

Route::get('/group/ads_group', 'groupController@index');


Route::get('/group/ballot_group/{id}', [
    'as'=>'ballot_group',
    'uses'=>'groupController@ballot_group',
    'middleware' => 'group'
]);

Route::get('/group/ballot_group', 'groupController@index');

Route::get('/activation/key/{activation_key}', ['as' => 'activation', 'uses' => 'Auth\ActivationKeyController@activateKey']);
Route::get('activation/resend', [
    'as' =>  'activation_key_resend',
    'uses' => 'Auth\ActivationKeyController@showKeyResendForm'
]);

Route::post('activation/resend', [
    'as' =>  'activation_key_resend.post',
    'uses' => 'Auth\ActivationKeyController@resendKey'
]);

/**La route pour afficher toutes les notifications d'un utilsateur**/
Route::get('notifications', [
    'as' =>  'notifications',
    'uses' => 'UserController@notifications'
]);

/**La route pour marquer toutes les notifications affichées d'un utilsateur comme lues**/
Route::post('notifications', [
    'as' =>  'notificationsRead',
    'uses' => 'UserController@read_notifications'
]);

/**La route pour recharger les notifications affichées d'un utilsateur comme lues**/
Route::post('updatenotifications', [
    'as' =>  'notificationsUpdate',
    'uses' => 'UserController@update_notifications'
]);



/****
 *  Route pour la partie comptabilité.
 */

Route::get('/comptabilite', [
    'as'=>'comptabilite',
    'uses'=>'comptabiliteController@index'
]);

Route::get('/comptabilite/consult_contribution', [
    'as'=>'consult_contribution',
    'uses'=> 'comptabiliteController@consult_contribution'
]);

Route::post('/comptabilite/post_contribution_file',[
    'as'=>'post_contribution_file',
    'uses'=>'comptabiliteController@post_contribution_file'
]);

Route::post('/comptabilite/post_contribution',[
    'as'=>'post_contribution',
    'uses'=>'comptabiliteController@post_contribution'
]);

Route::post('/comptabilite/post_period',[
    'as'=>'post_period',
    'uses'=>'comptabiliteController@post_period'
]);

Route::post('/comptabilite/post_consult_contribution',[
    'as'=>'post_consult_contribution',
    'uses'=>'comptabiliteController@post_consult_contribution'
]);

Route::post('/comptabilite/contribution_user',[
    'as'=>'contribution_user',
    'uses'=>'comptabiliteController@contribution_user'
]);

Route::get('/contrib_user/{id}', 'comptabiliteController@contrib_user');

Route::post('/post_motif', [
    'as'=>'post_motif',
    'uses'=>'comptabiliteController@post_motif'
]);

Route::post('/contrib_user_email', [
    'as'=>'contrib_user_email',
    'uses'=>'comptabiliteController@contrib_user_email'
]);

Route::get('/comptabilite/export_contribution', [
    'as'=>'export_contribution',
    'uses'=>'comptabiliteController@export_contribution'
]);
Route::get('/comptabilite/del_period_motifs', [
    'as'=>'del_period_motifs',
    'uses'=>'comptabiliteController@del_period_motifs'
]);

Route::get('/comptabilite/contribution', [
    'as'=>'contribution',
    'uses'=> 'comptabiliteController@contribution'
]);

Route::post('/comptabilite/post_contribution_cash',[
    'as'=>'post_contribution_cash',
    'uses'=>'comptabiliteController@post_contribution_cash'
]);

Route::post('/comptabilite/post_contribution_cash/callback',[
    'as'=>'post_contribution_cash_callback',
    'uses'=>'comptabiliteController@callback'
]);

/****
 * Route pour l'administration
 */

Route::get('/admin', [
    'as'=>'admin',
    'uses'=>'adminController@index'
]);

Route::post('/admin/del_group', [
    'as'=>'admin_del_group',
    'uses'=>'adminController@del_group'
]);

Route::get('/admin/suspen_user/{id}', [
    'as'=>'admin_suspen_user',
    'uses'=>'adminController@suspen_user'
]);

Route::post('/admin/post_suspen_user', [
    'as'=>'admin_post_suspen_user',
    'uses'=>'adminController@post_suspen_user'
]);

Route::post('/admin/post_admin_user', [
    'as'=>'admin_post_admin_user',
    'uses'=>'adminController@post_admin_user'
]);

Route::get('/admin/roles', [
    'as'=>'admin_roles',
    'uses'=>'adminController@admin_roles'
]);

Route::post('/admin/post_role_compta', [
    'as'=>'post_role_compta',
    'uses'=>'adminController@post_role_compta'
]);

Route::post('/admin/post_remove_compta', [
    'as'=>'post_remove_compta',
    'uses'=>'adminController@post_remove_compta'
]);

Route::post('/admin/post_role_admin', [
    'as'=>'post_role_admin',
    'uses'=>'adminController@post_role_admin'
]);