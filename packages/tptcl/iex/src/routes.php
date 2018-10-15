<?php
Route::group(['middleware' => ['web', 'auth']], function(){
Route::get('/task', ['as'=>'task.index','uses'=>'Tptcl\Iex\Controller\TptclIexController@index']);
Route::post('/task/store', 'Tptcl\Iex\Controller\TptclIexController@store');
Route::any('/task/delete/{id}', 'Tptcl\Iex\Controller\TptclIexController@destroy');
Route::get('/task/edit/{id}', 'Tptcl\Iex\Controller\TptclIexController@edit');

Route::any('/task/update/{id}', 'Tptcl\Iex\Controller\TptclIexController@update');
// Route::get('demo/test', function () {
//     return 'Tesasdfasdasdfasdasdfasdt';
// });
});