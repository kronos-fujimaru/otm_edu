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

// Admin
Route::resource('/admin/instructors', 'Admin\InstructorsController', ['except' => ['show']]);
Route::resource('/admin/companies', 'Admin\CompaniesController', ['except' => ['show']]);
Route::resource('/admin/trainings', 'Admin\TrainingsController', ['except' => ['show']]);
Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['index', 'show']]);
Route::resource('/admin/exams', 'Admin\ExamsController', ['except' => ['index', 'show']]);
Route::resource('/admin/questions', 'Admin\QuestionsController', ['except' => ['index', 'show']]);
Route::resource('/admin/supports', 'Admin\SupportsController', ['except' => ['index', 'show']]);
Route::resource('/admin/managers', 'Admin\ManagersController', ['except' => ['index', 'show']]);
Route::resource('/admin/participants', 'Admin\ParticipantsController', ['except' => ['index', 'show']]);
Route::resource('/admin/analysis', 'Admin\AnalysisController', ['except' => ['show']]);
Route::resource('/admin/examinations', 'Admin\ExaminationsController', ['except' => ['show']]);

Route::get('/admin/messages/file/{id}', 'Admin\MessagesController@file');
Route::resource('/admin/messages', 'Admin\MessagesController');
Route::get('/admin/communications/{id}', 'Admin\CommunicationsController@create');
Route::post('/admin/communications', 'Admin\CommunicationsController@store');
Route::delete('/admin/communications/{id}', 'Admin\CommunicationsController@destroy');

Route::get('/admin/participants/api_scores/{id}', 'Admin\ParticipantsController@api_scores');
Route::get('/admin/participants/api_cycles/{id}', 'Admin\ParticipantsController@api_cycles');

Route::get('/admin/dailyreport/{id}/edit', 'Admin\DailyReportController@edit');
Route::put('/admin/dailyreport/{id}', 'Admin\DailyReportController@update');
Route::get('/admin/dailywork/file/{id}', 'Admin\DailyWorkController@file');

Route::resource('/admin/notes', 'Admin\NotesController', ['except' => ['index', 'show']]);
Route::resource('/admin/raitings', 'Admin\RaitingsController', ['except' => ['index', 'show']]);
Route::resource('/admin/scores', 'Admin\ScoresController', ['except' => ['index', 'show']]);
Route::resource('/admin/scores/show', 'Admin\ScoresController@show');
Route::resource('/admin/works', 'Admin\WorksController', ['except' => ['index', 'show']]);
Route::resource('/admin/absences', 'Admin\AbsencesController', ['except' => ['index', 'show']]);

Route::get('/admin/companies/api/participants', 'Admin\CompaniesController@apiParticipants');
Route::get('/admin/companies/api/managers', 'Admin\CompaniesController@apiManagers');

Route::get('/admin', 'Admin\ProcessController@index');
Route::get('/admin/process/trainings/{id}', 'Admin\ProcessController@trainings');
Route::get('/admin/process/participants/{id}', 'Admin\ProcessController@participants');
Route::get('/admin/process/total/create/{id}', 'Admin\ProcessController@participants');

// Route::get('/admin/setting/email', 'Admin\SettingController@showEmail');
Route::get('/admin/setting/password', 'Admin\SettingController@showPassword');
// Route::post('/admin/setting/email', 'Admin\SettingController@updateEmail');
Route::post('/admin/setting/password', 'Admin\SettingController@updatePassword');
Route::get('/admin/setting', 'Admin\SettingController@index');


// Participant
Route::get('/participant/question', 'Participant\QuestionController@index');

// Merge
Route::get('/participant/exam/{id}', 'Participant\ExamController@show');
Route::post('/participant/exam/{id}', 'Participant\ExamController@store');

Route::get('/participant/exam/api/score', 'Participant\ExamController@api_score');
Route::get('/participant/exam', 'Participant\ExamController@index');

Route::resource('/participant/report', 'Participant\ReportController', ['except' => ['show']]);

Route::get('/participant/dailywork/file/{id}', 'Participant\DailyWorkController@file');
Route::delete('/participant/dailywork/{id}', 'Participant\DailyWorkController@destroy');
Route::resource('/participant/dailyreport', 'Participant\DailyReportController', ['except' => ['show']]);

// Route::get('/participant/setting/email', 'Participant\SettingController@showEmail');
Route::get('/participant/setting/password', 'Participant\SettingController@showPassword');
// Route::post('/participant/setting/email', 'Participant\SettingController@updateEmail');
Route::post('/participant/setting/password', 'Participant\SettingController@updatePassword');
Route::get('/participant/setting', 'Participant\SettingController@index');
Route::get('/participant', 'Participant\TopController@index');
Route::post('/participant', 'Participant\TopController@store');


// Authentication routes...
Route::get('/auth/login', 'Auth\OpsAuthController@getLogin');
Route::post('/auth/login', 'Auth\OpsAuthController@postLogin');
Route::get('/auth/logout', 'Auth\OpsAuthController@getLogout');


Route::get('/errors/session/expired', 'ErrorsController@sessionExpired');

// // Registration routes...
// Route::get('/auth/register', 'Auth\OpsAuthController@getRegister');
// Route::post('/auth/register', 'Auth\OpsAuthController@postRegister');

// Manager
Route::get('/manager', 'Manager\TopController@index');

Route::get('/manager/messages/file/{id}', 'Manager\MessagesController@file');
Route::resource('/manager/messages', 'Manager\MessagesController');

Route::get('/manager/support', 'Manager\SupportController@index');
Route::get('/manager/participant/{id}', 'Manager\ParticipantController@show');

Route::get('/manager/scores/{id}', 'Manager\ScoresController@show');

Route::get('/manager/participant/api_score/{id}', 'Manager\ParticipantController@api_score');
Route::get('/manager/participant/api_cycle/{id}', 'Manager\ParticipantController@api_cycle');

Route::get('/manager/dailyreport/{id}/edit', 'Manager\DailyReportController@edit');
Route::put('/manager/dailyreport/{id}', 'Manager\DailyReportController@update');
Route::get('/manager/dailywork/file/{id}', 'Manager\DailyWorkController@file');

// Route::get('/manager/setting/email', 'Manager\SettingController@showEmail');
Route::get('/manager/setting/password', 'Manager\SettingController@showPassword');
// Route::post('/manager/setting/email', 'Manager\SettingController@updateEmail');
Route::post('/manager/setting/password', 'Manager\SettingController@updatePassword');
Route::get('/manager/setting', 'Manager\SettingController@index');

Route::get('/manager/livecamera/{id?}', 'Manager\LiveCameraController@index');
Route::get('/manager/communications/{id}', 'Manager\CommunicationsController@create');
Route::post('/manager/communications', 'Manager\CommunicationsController@store');
Route::delete('/manager/communications/{id}', 'Manager\CommunicationsController@destroy');
