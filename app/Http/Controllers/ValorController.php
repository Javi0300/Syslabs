<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\Valoresreferencium;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValorController extends Controller
{
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

    public function store(Request $request)
    {
        try{
        $valores = new Valoresreferencium();
        $valores->claveprueba = $request->get('idss');
        $valores->Sexo = $request->get('sexo2');
        $valores->Edad = $request->get('Edad');
        $valores->EdadMin = $request->get('EdadMin');
        $valores->EdadMax = $request->get('EdadMax');
        $valores->ValMin = $request->get('RefMin');
        $valores->ValMax = $request->get('RefMax');
        $valores->sucursal = 00;
        $valores->save();

        $prueba = Prueba::find($request->get('idss'));
        $prueba->tipo_valor_normalidad = "Rango númerico";
        $prueba->save();

        return redirect()->to(app('url')->previous()."#valoresref");
        }
        catch(Exception $e)
        {
            return back()->with('campoFaltante', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    /* public function edit($id)
    {
        $valor = Valoresreferencium::find($id);
        return response()->json([
            'status' => 200,
            'valor' => $valor
        ]);
    } */

    public function update(Request $request, $id)
    {
        $valor = Valoresreferencium::find($id);
        $valor->claveprueba = $request->get('idss2');
        $valor->Sexo = $request->get('sexo2');
        $valor->Edad = $request->get('Edad2');
        $valor->EdadMin = $request->get('EdadMin2');
        $valor->EdadMax = $request->get('EdadMax2');
        $valor->ValMin = $request->get('RefMin2');
        $valor->ValMax = $request->get('RefMax2');
        $valor->sucursal = 00;
        $valor->save();

        $prueba = Prueba::find($request->get('idss2'));
        $prueba->tipo_valor_normalidad = "Rango númerico";
        $prueba->save();
        return redirect()->to(app('url')->previous()."#valoresref");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       
        
        $valor = Valoresreferencium::find($id);
        $valor->delete();
        
        DB::select('DELETE FROM valoresreferencia WHERE claveprueba = ?;', [$id]);
        return redirect()->to(app('url')->previous()."#valoresref");

    }
}
