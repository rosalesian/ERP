<?php
Route::group(['namespace'=> 'Modules\JobOrder\Controller'], function(){

	Route::resource('joborder', 'JobOrderController');
	
});


