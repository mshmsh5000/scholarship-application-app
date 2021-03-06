<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/

# Registration
Route::get('register', ['as' => 'registration.create', 'uses' => 'RegistrationController@create'])->before('guest');
Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);

# Authentication
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

# Password Reminder
Route::controller('password', 'RemindersController');

# Pages
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

# Profile
Route::resource('profile', 'ProfilesController', ['before' => 'auth']);

# Application
Route::resource('application', 'ApplicationController', ['before' => 'auth']);

# Status
Route::get('status', ['as' => 'status', 'uses' => 'StatusController@status', 'before' => 'auth']);
# this should be a post.
Route::get('resend-email', ['as' => 'resend', 'uses' => 'StatusController@resendEmailRequest']);

# Review
Route::get('review/{id}', ['as' => 'review', 'uses' => 'StatusController@review', 'before' => 'auth']);
Route::post('review', ['as' => 'review.store', 'uses' => 'StatusController@submit', 'before' => 'auth']);

# Recomendation
Route::resource('recommendation', 'RecommendationController');

# Nomination
Route::post('nomination', ['as' => 'nomination.create', 'uses' => 'NominationController@store']);

# Admin
Route::group(['before' => 'role:administrator', 'prefix' => 'admin'], function()
{
  Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

  # Search
  Route::post('search', ['as' => 'search', 'uses' => 'AdminController@search']);

  # Applications management
  Route::get('applications', ['as' => 'applications.index', 'uses' => 'AdminController@applicationsIndex']);
  Route::get('applications/export', ['as' => 'export', 'uses' => 'AdminController@export']);
  Route::post('applications/export', ['as' => 'export.csv', 'uses' => 'AdminController@export_results']);
  Route::get('applications/{id}', ['as' => 'applications.show', 'uses' => 'AdminController@applicationsShow']);
  Route::get('applications/{id}/edit', ['as' => 'admin.application.edit', 'uses' => 'AdminController@applicationsEdit']);

  Route::post('applicaiton/rate', ['as' => 'applications.rate', 'uses' => 'AdminController@rate']);

  # Winners
  Route::resource('winner', 'WinnerController');

  # Scholarship management
  Route::resource('scholarship', 'ScholarshipController');

  # Static Content Pages
  Route::resource('page', 'PagesController');

  # Settings
  Route::get('settings', ['as' => 'settings', 'uses' => 'AdminController@settings']);
  Route::get('settings/general', ['as' => 'general.edit', 'uses' => 'SettingsController@editGeneral']);
  Route::post('settings/general', ['as' => 'general.update', 'uses' => 'SettingsController@updateGeneral']);
  Route::get('settings/appearance', ['as' => 'appearance.edit', 'uses' => 'SettingsController@editAppearance']);
  Route::post('settings/appearance', ['as' => 'appearance.update', 'uses' => 'SettingsController@updateAppearance']);
  Route::get('settings/meta-data', ['as' => 'meta-data.edit', 'uses' => 'SettingsController@editMetaData']);
  Route::post('settings/meta-data', ['as' => 'meta-data.update', 'uses' => 'SettingsController@updateMetaData']);

  # Emails
  Route::get('email', ['as' => 'emails', 'uses' => 'EmailController@index']);
  Route::post('email', ['as' => 'emails.update', 'uses' => 'EmailController@update']);

});



# Pages
// This route needs to be the last route in the list that is hit
// because the wildcard catches anything after the root and routes
// to the Pages controller for static pages.
Route::get('{page}', 'PagesController@show');
