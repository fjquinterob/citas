<?php


Route::get('/', function () {
    return view('welcome');
});	

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');	//{{ route('home') }} aqui se imprime el valor "home" ya que esa ruta tiene un nombre asignado

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
    			//	<< Specialty >>   vistas
	//Como estas rutas no tienen un nombre asignado, entonces debemos poner la ruta misma que presenta
	Route::get('/specialties', 'SpecialtyController@index');	//vista con listado de espacialidades
	Route::get('/specialties/create', 'SpecialtyController@create');//vista con el form de registro
	Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); //vista con el form de edicion de la especialidad seleccionada

	Route::post('/specialties', 'SpecialtyController@store');  //envio del formulario de registro de nuevas especialidades
	Route::put('/specialties/{specialty}', 'SpecialtyController@update'); //edicion de una especialidad determinada
	Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy'); //eliminar una especialidad

	// << Doctors >>
	Route::resource('doctors', 'DoctorController');

	// << Patients >>
	Route::resource('patients', 'PatientController');
});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
    
	Route::get('/schedule', 'ScheduleController@edit');
	Route::post('/schedule', 'ScheduleController@store');

});