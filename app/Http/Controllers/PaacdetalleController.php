<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paac;
use App\Paacdetalle;
use DB;

class PaacdetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $paac = Paacdetalle::findorFail($id);
      return view('paacs.editdetalle',compact('paac'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
        $detalle = Paacdetalle::findorFail($id);
        $total=$request->enero+$request->febrero+$request->marzo+$request->abril+$request->mayo+$request->junio+$request->julio+$request->agosto+$request->septiembre+$request->octubre+$request->noviembre+$request->diciembre;
        $detalle->fill($request->All());
        $detalle->subtotal=$total;
        $detalle->save();

        $detalles = Paacdetalle::where('paac_id',$detalle->paac_id)->get();
        $totalito=0;
        foreach($detalles as $valor){
          $totalito=$totalito+$valor->subtotal;
        }
        $paac = Paac::findorFail($detalle->paac_id);
        $paac->total=$totalito;
        $paac->save();
        DB::commit();
        return redirect('paacs/'.$paac->id)->with('mensaje','Actualizado con exito');
      }catch (\Exception $e){
        DB::rollback();
        return redirect('paacdetalles/'.$id.'/edit')->with('error','Paac con error '.$e->getMessage());
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle = Paacdetalle::findorFail($id);
        $paac = Paac::findorFail($detalle->paac_id);
        $total=$paac->total;
        $paac->total=$total-$detalle->subtotal;
        $paac->save();
        $detalle->delete();
        return redirect('paacs/'.$paac->id)->with('mensaje','Actualizado con exito');
    }
}
