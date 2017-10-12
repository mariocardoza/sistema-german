<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Http\Requests\ProveedorRequest;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //echo $request->get('name');
        $proveedores = Proveedor::paginate(10);
        $count = $proveedores->count();
       
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorRequest $request)
    {
        Proveedor::create($request->All());
        bitacora('Registro un Proveedor');
        return redirect('/proveedores')->with('mensaje','Registro almacenado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Proveedor::findorFail($id);

        return view('proveedores.show',compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        return view('proveedores.edit',compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorRequest $request, $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->fill($request->All());
        $proveedor->save();
        bitacora('Modificó un Proveedor');
        return redirect('/proveedores')->with('mensaje','Registro modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor=Proveedor::find($id);
        $proveedor->delete();
        bitacora('Eliminó un Proveedor');
        return redirect('/proveedores');
        

    }

    public function eliminados()
    {
        $proveedores = Proveedor::onlyTrashedorFail()->paginate(10);
        return view('proveedores.eliminados', compact('proveedores'));

    }

    public function restore($id)
    {
        $proveedor=Proveedor::withTrashed()->where('id', '=', $id)->first();
        $proveedor->restore();
        bitacora('Restauró un Proveedor');
        return redirect('/proveedores');
    }
}
