<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;

class SpecialtyController extends Controller
{
    
	public function __construct()
	{
		$this->middleware('auth'); //minimo debe haber inicado sesion o lo redirecciona a login para autenticarse
	}

	public function index()
	{
		$specialties = Specialty::all();
		return view('specialties.index', compact('specialties'));
	}

	public function create()
	{
		return view('specialties.create');
	}

	private function performValidation(Request $request)
	{
		$rules = [
			'name' => 'required|min:3'
		];
		$messages = [		
			'name.required' => 'Es necesario ingresar un nombre.',
			'name.min' => 'Como mínimo el nombre debe tener 3 caracteres.'
		];
		 //seccion que se encarga de validad
		$this->validate($request, $rules, $messages);
	}

	  //Este metodo es el encargado de registrar nuevas especialidades
	public function store(Request $request)
	{
		//dd($request->all());
		$this->performValidation($request);

		 //registros de una nueva especialidad
		$specialty = new Specialty();
		$specialty->name = $request->input('name');
		$specialty->description = $request->input('description');
		$specialty->save(); //INSERT

		$notification = 'La especialidad se ha registrado correctamente.';
		return redirect('specialties')->with(compact('notification')); //la variable notification va a contener el mensaje de notificacion que se mostrar en la lista
	}

	public function edit(Specialty $specialty)
	{

		return view('specialties.edit', compact('specialty'));
	}

	public function update(Request $request, Specialty $specialty)
	{
		//dd($request->all());
		$this->performValidation($request);
		
		$specialty->name = $request->input('name');
		$specialty->description = $request->input('description');
		$specialty->save(); //UPDATE

		$notification = 'La especialidad se ha actualizado correctamente.';
		return redirect('specialties')->with(compact('notification'));
	}

	public function destroy(Specialty $specialty)
	{
		$deletedSpecialty = $specialty->name;
		$specialty->delete();

		$notification = 'La especialidad '. $deletedSpecialty .' se ha eliminado correctamente.';
		return redirect('specialties')->with(compact('notification'));
	
	}
}
