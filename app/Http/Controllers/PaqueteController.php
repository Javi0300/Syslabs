<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use App\Models\PaqueteDetalle;
use App\Models\Estudio;
use App\Models\Depto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquetes = Estudio::all()->where('espaquete', '=', '1');
        
        return view('paquetes.index')->with('paquetes', $paquetes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estudios = Estudio::all()->where('espaquete', '=', '0');
        return view('paquetes.create', [
            'estudios'=>$estudios,
            'defecto' => Estudio::select('idEstudio')->first()
        ]);
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $paquetes = new Estudio();
            $paquetes->Abreviatura = $request->get('abreviatura');
            $paquetes->Nombre = $request->get('descripcion');
            $paquetes->Indicaciones = $request->get('indicaciones');
            $paquetes->Notas_Internas = $request->get('notas_internas');
            $paquetes->Dias = $request->get('dias');
            $paquetes->Horas = $request->get('horas');
            $paquetes->Minutos = $request->get('minutos');
            $id = Depto::select('id')->where('Depto', '=', 'Paquete')->first();
            $paquetes->depto = $id->id;
            $paquetes->sucursal = session('SUCURSAL');
            $paquetes->espaquete = 1;
            $paquetes->eliminar = 0;
            $paquetes->SucProceso = session('SUCURSAL');
            $paquetes->save();

            $estudioNombre = $request->get('estudioNombre');
            $separador = $request->get('separador');
            $cont = 0;
            if($request->filled('estudioNombre'))
            {
                while($cont < count($estudioNombre))
                { 
                    $paquetedetalle = new PaqueteDetalle();
                    $paquetedetalle->id_Estudio = $paquetes->idEstudio;
                    $paquetedetalle->id_estudio_detalle = $request->get('id_estudio')[$cont];
                    
                    if($separador[$cont] == '1')
                    {
                        $paquetedetalle->esseparador = $separador[$cont];
                    }else{
                        $paquetedetalle->esseparador = "0";
                    }
                    $paquetedetalle->Estudio = $estudioNombre[$cont];
                    $paquetedetalle->Orden = $cont;
                    $paquetedetalle->sucursal = session('SUCURSAL');
                    $paquetedetalle->save();
                    
                    $cont=$cont+1;            
                }
                
            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return redirect('/paquetes');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id =  Crypt::decrypt($id);
        return view('paquetes.edit')->with([
            'estudios' => Estudio::all()->where('espaquete', '=', '0'),
            'defecto' => Estudio::select('idEstudio')->first(),
            'paquete' => Estudio::findorFail($id),
            'paquetedetalles' => DB::select('SELECT * FROM paquete_detalle WHERE id_Estudio = ? ORDER BY Orden ASC;', [$id])
        ]);
    }

    public function update(Request $request, $id)
    {
       try{
            DB::beginTransaction();
            $paquete = Estudio::find($id);
            $paquete->Abreviatura = $request->get('abreviatura');
            $paquete->Nombre = $request->get('descripcion');
            $paquete->Indicaciones = $request->get('indicaciones');
            $paquete->Notas_Internas = $request->get('notas_internas');
            $paquete->Dias = $request->get('dias');
            $paquete->Horas = $request->get('horas');
            $paquete->Minutos = $request->get('minutos');
            $paquete->sucursal = session('SUCURSAL');
            $paquete->espaquete = 1;
            $paquete->eliminar = 0;
            $paquete->SucProceso = session('SUCURSAL');
            $paquete->save();

            $cancelado = $request->get('cancelado');
            $idPaqueteDetalle = $request->get('idPaqueteDetalle');
            $estudioNombre = $request->get('estudioNombre');
            $id_estudio = $request->get('id_estudio');
            $cont = 0;
            $separador = $request->get('separador');
            if($request->get('idPaqueteDetalle'))
            {
                while($cont < count($idPaqueteDetalle))
                {
                    $paquetedetalle = PaqueteDetalle::find($idPaqueteDetalle[$cont]);
                    if(is_null($paquetedetalle)){ 
                        $paquetedetalle = new PaqueteDetalle();
                        $paquetedetalle->id_Estudio = $id;  
                    }
                    if($cancelado[$cont]=='1') {
                        DB::select('DELETE FROM paquete_detalle WHERE idPaqueteDetalle = ?',[$idPaqueteDetalle[$cont]]);
                    }else{
                        $paquetedetalle->id_estudio_detalle = $id_estudio[$cont];
                        if($separador[$cont] == '1')
                        {
                            $paquetedetalle->esseparador = $separador[$cont];
                        }else{
                            $paquetedetalle->esseparador = "0";
                        }
                        $paquetedetalle->Estudio = $estudioNombre[$cont];
                        $paquetedetalle->Orden = $cont;
                        $paquetedetalle->sucursal = session('SUCURSAL');
                        $paquetedetalle->save();
                    }        
                    $cont=$cont+1;            
                }
            }
            DB::commit();
        }
         catch(Exception $e){
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return redirect('/paquetes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(DB::select('SELECT * FROM estxsol WHERE id_estudio = ?', [$id])){
                return redirect('/paquetes')->with('infoestxsol', 'Este paquete y su contenido esta siendo usado por un registro de una solicitud.');
            }
            if(DB::select('SELECT * FROM precios_detalle WHERE id_Estudio = ?', [$id])){
                return redirect('/paquetes')->with('infoprecios_detalle', 'Este paquete y su contenido esta siendo usado en una lista de precios.');
            }
            if(DB::select('SELECT * FROM tarifas WHERE id_estudio = ?', [$id])){
                return redirect('/paquetes')->with('infotarifas', 'Este paquete y su contenido esta registrado en el área de tarifas.');
            }
            if(DB::select('SELECT * FROM monedero_estudios_exclusiones WHERE id_estudio = ? AND sucursal = ?', [$id, session('SUCURSAL')])){
                return redirect('/paquetes')->with('infomonedero_estudios', 'Este paquete y su contenido ha sido registrado en el monedero para estudios');
            }else{
                DB::select('DELETE FROM monedero_estudios_exclusiones WHERE id_estudio = ?', [$id]);
            }
            $paquete = Estudio::find($id);
            $paquete->delete();
            
            DB::select('DELETE FROM paquete_detalle WHERE id_Estudio = ?', [$id]);
            
            return redirect('/paquetes')->with('eliminar', 'echo');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
