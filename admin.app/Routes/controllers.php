<?php
Route::post('option-read/{id}', 'OptionController@read');
Route::post('option-save', 'OptionController@save');
Route::post('option-delete/{id}', 'OptionController@delete');
Route::post('option-all', 'OptionController@realAll');

Route::post('post-read/{id}', 'PostController@read');
Route::post('post-save', 'PostController@save');
Route::post('post-delete/{id}', 'PostController@delete');
Route::post('post-all', 'PostController@realAll');
Route::post('post-upload', 'PostController@Upload');

Route::post('page-read/{id}', 'PageController@read');
Route::post('page-save', 'PageController@save');
Route::post('page-delete/{id}', 'PageController@delete');
Route::post('page-all', 'PageController@realAll');

Route::post('menu-read/{id}', 'MenuController@read');
Route::post('menu-save', 'MenuController@save');
Route::post('menu-delete/{id}', 'MenuController@delete');
Route::post('menu-all', 'MenuController@realAll');

Route::post('lang-read/{id}', 'LangController@read');
Route::post('lang-save', 'LangController@save');
Route::post('lang-delete/{id}', 'LangController@delete');
Route::post('lang-all', 'LangController@realAll');

Route::post('postmeta-read/{id}', 'PostMetaController@read');
Route::post('postmeta-save', 'PostMetaController@save');
Route::post('postmeta-delete/{id}', 'PostMetaController@delete');
Route::post('postmeta-all', 'PostMetaController@realAll');

Route::post('current', 'CurrentController@currentLang');

