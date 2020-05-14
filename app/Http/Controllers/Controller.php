<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Alumno;
use App\Grupo;

class Controller extends BaseController
{

    public function index(){
        $alumnos = DB::select(
            'SELECT 	alumnos.id_alumno,	alumnos.nombre, alumnos.apellido_p, alumnos.apellido_m, alumnos.correo, alumnos.edad, 
            alumnos.telefono, grupos.semestre, grupos.grupo, grupos.turno
            FROM alumnos
	        INNER JOIN 	grupos 	ON  alumnos.grupo = grupos.id_grupo
            WHERE alumnos.grupo = grupos.id_grupo'
        );
        return view('inicio',compact('alumnos'));
    }

    public function registro(){
        $grupos=Grupo::all();
        return view('registro', compact('grupos'));
    }

    public function registro_datos(Request $request){   
        $validatedData = $request->validate([
            'nombre' => 'required|max:50', 
            'apellido_p' => 'required|max:50', 
            'apellido_m' => 'max:50', 
            'edad' => 'required|max:2',
            'telefono' => 'max:50', 
            'correo' => 'required|max:50',  
            'grupo' => 'required',
        ]);

        $alumno= new Alumno();
        $alumno->nombre= $request->nombre;
        $alumno->apellido_p= $request->apellido_p;
        $alumno->apellido_m= $request->apellido_m;
        $alumno->edad= $request->edad;
        $alumno->telefono= $request->telefono;
        $alumno->correo= $request->correo;
        $alumno->grupo= $request->grupo;
        $alumno->save();
        return redirect('/');
    }

    public function registrogrupo() {
        return view('registrogrupo');
    }
    public function registrogrupo_datos(Request $request){   
        $validatedData = $request->validate([
            'grupo' => 'required|max:50', 
            'semestre' => 'required',
            'turno' => 'required'
        ]);

        $grupo= new Grupo;
        $grupo->grupo= $request->grupo;
        $grupo->semestre= $request->semestre;
        $grupo->turno= $request->turno;
        $grupo->save();
        return redirect('/');

    }

    public function editaalumno( $id_alumno)   {
        $alumno = Alumno::where('id_alumno', $id_alumno)->first();
        return view('editar',['alumno' => $alumno,]);
    }

    public function update(Request $request, $id_alumno)  {
        /*$datos=request()->except(['_token','_method']);
        Alumno::where('id_alumno','=',$id_alumno)->update($datos);

        $estudiante=Alumno::findOrFail($id_alumno);
        return redirect('/'); */

         $validatedData = $request->validate([
            'id_alumno' => 'required',
            'nombre' => 'required|max:50', 
            'apellido_p' => 'required|max:50', 
            'apellido_m' => 'max:50', 
            'edad' => 'required|max:2',
            'telefono' => 'max:50', 
            'correo' => 'required|max:50',  
        ]);
        
        Alumno::find($id_alumno)->update([
            'nombre'=> $request->nombre,
            'apellido_p'=> $request->apellido_p,
            'apellido_m'=> $request->apellido_m,
            'edad'=> $request->edad,
            'telefono'=> $request->telefono,
            'correo'=> $request->correo,
            'grupo'=> $request->grupo

        ]);
        return redirect('/');
    }

    public function borrar($id_estudiante)
    {
        Alumno::destroy($id_estudiante);
        return redirect('/');
    }
}
