<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudio;
use App\Models\Monedero;
use App\Models\Monedero_Empresa;
use App\Models\Monedero_Estudios;
use App\Models\Prueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MonederoController extends Controller
{
    public function index()
    {
        $empresas = Empresa::select('*')->orderby('Nombre')->get();
        $estudios = Estudio::select('*')->orderby('Nombre')->get();
        $monedero = Monedero::select('*')->where('sucursal', '=', session('SUCURSAL'))->first();
        
        $monedero_empresa = Monedero_Empresa::select('*')->where('sucursal', '=', session('SUCURSAL'))->get();
        $monedero_estudios = Monedero_Estudios::select('*')->where('sucursal', '=', session('SUCURSAL'))->get();
        return view('monedero.index')->with([
            'empresas' => $empresas,
            'estudios' => $estudios,
            'monedero' => $monedero,
            'monedero_empresa' => $monedero_empresa,
            'monedero_estudios' => $monedero_estudios
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $IdMonedero = $request->get('IdMonedero'); 
            $monedero = Monedero::find($IdMonedero);
            if(is_null($monedero)){ 
                $monedero = new Monedero(); //SI no lo encuentra agregar (insert) // delo contrario hace un update
            }
            $monedero->minimocompra = $request->get('minimocompra');
            $monedero->porcentajeregalo = $request->get('porcentajeregalo');
            $monedero->duracionmeses = $request->get('duracionmeses');
            if($request->filled('activo'))
            {
                $monedero->activo = 1;
            }else
            {
                $monedero->activo = 0;
            }
            $monedero->sucursal = session('SUCURSAL');
            $monedero->save();
            //-----------------------------Secuencia para la tabla monedero_empresas-------------------------------------
            $monedero_id = $request->get('monedero_id');
            $monedero_id_empresa = $request->get('monedero_id_empresa');
            $cancelado = $request->get('cancelado');
            $contA = 0;
            if($request->get('monedero_id'))
            {
                while($contA < count($monedero_id)){                    
                    $monedero_empresa = Monedero_Empresa::find($monedero_id[$contA]); 
                    if(is_null($monedero_empresa)){ 
                        $monedero_empresa = new Monedero_Empresa(); //SI no lo encuentra agregar (insert) // delo contrario hace un update
                        $monedero_empresa->id_empresa= $monedero_id_empresa[$contA]; 
                        if(is_null($monedero_empresa->id_empresa = $monedero_id_empresa[$contA])){ 
                            DB::select('DELETE FROM monedero_empresas WHERE id = ?',[$monedero_empresa->id]);
                        }
                    }
                    //Si esta marcado con canceadoe=1 eliminar registro
                    if($cancelado[$contA]=='1') {
                        DB::select('DELETE FROM monedero_empresas where id = ?',[$monedero_id[$contA]]);
                    }else{
                        $monedero_empresa->sucursal= session('SUCURSAL');
                        $monedero_empresa->save();                        
                    }
                    $contA=$contA+1;
                }
            }
            //-----------------------------Secuencia para la tabla monedero_estudios-------------------------------------
            $monedero_estudios_id = $request->get('monedero_estudios_id');
            $monedero_estudios_id_estudio = $request->get('monedero_estudios_id_estudio');
            $canceladoEst = $request->get('canceladoEst');
            $contB = 0;
            if($request->get('monedero_estudios_id'))
            {
                while($contB < count($monedero_estudios_id)){
                    $monedero_estudios = Monedero_Estudios::find($monedero_estudios_id[$contB]); 
                    if(is_null($monedero_estudios)){ 
                        $monedero_estudios = new Monedero_Estudios();
                        $monedero_estudios->id_estudio= $monedero_estudios_id_estudio[$contB]; 
                    }
                    if($canceladoEst[$contB]=='1') {
                        DB::select('DELETE FROM monedero_estudios_exclusiones where id = ?',[$monedero_estudios_id[$contB]]);
                    }else{
                        $monedero_estudios->sucursal= session('SUCURSAL');
                        $monedero_estudios->save();
                    }
                    $contB=$contB+1;
                }
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        if(DB::select('SELECT id_empresa, COUNT(*) Total FROM monedero_empresas WHERE sucursal = ? GROUP BY id_empresa HAVING COUNT(*) > 1',[session('SUCURSAL')]) &&
            DB::select('SELECT id_estudio, COUNT(*) Total FROM monedero_estudios_exclusiones WHERE sucursal = ? GROUP BY id_estudio HAVING COUNT(*) > 1',[session('SUCURSAL')]))
        {
                DB::rollback();
                $mensaje = "Datos repetidos.";
                return back()->with('duplicidad', $mensaje);
        }
        if(DB::select('SELECT id_empresa, COUNT(*) Total FROM monedero_empresas WHERE sucursal = ? GROUP BY id_empresa HAVING COUNT(*) > 1',[session('SUCURSAL')]))
        {
            DB::rollback();
            $mensajeEmp = "Datos repetidos.";
            return back()->with('duplicidadEmp', $mensajeEmp);                            
        }
        if(DB::select('SELECT id_estudio, COUNT(*) Total FROM monedero_estudios_exclusiones WHERE sucursal = ? GROUP BY id_estudio HAVING COUNT(*) > 1',[session('SUCURSAL')]))
        {
            DB::rollback();
            $mensajeEst = "Datos repetidos.";
            return back()->with('duplicidadEst', $mensajeEst);
        }
        return back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
