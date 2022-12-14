<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos["empleados"] = Empleado::paginate(5);
        return view("empleado.index", $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("empleado.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if($request->hasFile("Foto"))
        {
            $datosEmpleado["Foto"] = $request->file("Foto")->store("uploads","public"); 
        }

        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado); Devuelve JSON con los datos almacenados en la BD
        return redirect('empleado')->with('mensaje', 'Empleado Agregado con Éxito');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view("empleado.edit", compact("empleado") );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosEmpleado = request()->except('_token','_method');

        //Si la edición seleccionan una foto diferente a la que existe
        if($request->hasFile("Foto"))
        {
            $empleado = Empleado::findOrFail($id); //Recupero Registro de BD
            
            Storage::delete('public/' . $empleado->Foto); //Elimino foto actual
            
            $datosEmpleado["Foto"] = $request->file("Foto")->store("uploads","public"); //Guarda la nueva foto
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado = Empleado::findOrFail($id);
        
        return view("empleado.edit", compact("empleado") );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        if(Storage::delete('public/' . $empleado->Foto))
        {
            Empleado::destroy($id);
        }

        
        return redirect("empleado")->with('mensaje', 'Empleado Eliminado con Éxito');
    }
}
