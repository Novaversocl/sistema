<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
// para limpiar la imagen
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // mediante las clases acceso web
        //crear una variable para consultar la información
        //entre corchetes es una variable para almacenar la informacion en la base de datos 
        //a partir del modelo Cliente

        $datos['clientes']=Cliente::paginate(5);

        return view('cliente.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mediante las clases acceso web
        return view('cliente.create');



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todos los registros que se envien se guarda en la variable y retorna los datos en json


// validaciones
$campos=[
    'Rut'=>'required|string|max:100',
    'Nombre'=>'required|string|max:100',
    'Apellidos'=>'required|string|max:100',
    'Correo'=>'required|email',
    'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
];

$mensaje=[
'required'=>'El :attribute es requerido',
'Foto.required'=>'la foto es requeridad'


];

$this->validate($request,$campos,$mensaje);




        
        $datosCliente=request()->except('_token');

        if($request->hasFile('Foto')){
        $datosCliente['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Cliente::insert($datosCliente);
        //ya no es necesario el json
      //  return response()->json($datosCliente);
      return redirect('cliente')->with('mensaje','Cliente agregado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cliente=Cliente::findOrFail($id);

return view('cliente.edit',compact('cliente'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
    $datosCliente=request()->except(['_token','_method']);

    if($request->hasFile('Foto')){
        $cliente=Cliente::findOrFail($id);
         /** limpiar la foto*/
        Storage::delete('public/'.$cliente->Foto);
        
        $datosCliente['Foto']=$request->file('Foto')->store('uploads','public');
        }

    Cliente::where('id','=',$id)->update($datosCliente);

    $cliente=Cliente::findOrFail($id);
   // return view('cliente.edit',compact('cliente'));
    return redirect('cliente')->with('mensaje','Cliente Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //para eliminar el archivo de la foto en la carpeta
        $cliente=Cliente::findOrFail($id);
        if(Storage::delete('public/'.$cliente->Foto)){

         Cliente::destroy($id);

        }
        return redirect('cliente')->with('mensaje','Cliente eliminado');
        //return redirect('cliente');
    }
}
