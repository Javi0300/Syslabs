<?php

namespace App\Http\Controllers;

use App\Models\Estxsol;
use App\Models\Solicitud;
use App\Models\Prueba;
use App\Models\Tomaxest;
use App\Models\Valoresreferencia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapturaResultadoController extends Controller
{
    public function index()
    {
        $estxsoles = DB::select('SELECT estxsol.idEstxSol, estxsol.id_solicitud, estxsol.id_estudio, estudios.Nombre FROM estxsol
        INNER JOIN estudios ON estxsol.id_estudio = estudios.idEstudio');
        $solicitudes = DB::select('SELECT * FROM solicitud');
        $tomaxest = DB::select('SELECT * FROM tomaxest');
        return view('captura_resultados.index', compact('estxsoles', 'solicitudes', 'tomaxest'));
    }

    public function CrearFormatoCaptura (Request $request){

        try
        {
            $solicitud= Solicitud::find($request->get('IdSolicitud'));
            $solicitud->Edad;
            $solicitud->EdadTipo;
            $solicitud->Fecha;
            $solicitud->Sexo;
            $estxsoles = DB::select('SELECT * FROM estxsol WHERE id_solicitud = ?',[$solicitud->IdSolicitud]);
            $tomaxest_actuales = DB::select('SELECT * FROM tomaxest 
            WHERE solicitud = ? AND Estatus IS NULL OR tomaxest.Estatus = "0"', [$solicitud->IdSolicitud]);

            if($tomaxest_actuales == null)
            {
                foreach($estxsoles as $estxsol)
                {                    
                    if(DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 0',[$estxsol->id_estudio]))
                    {
                        $estudiosX = DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 0',[$estxsol->id_estudio]);
                        foreach ($estudiosX as $estudio)
                        {
                            $formatos = DB::select('SELECT * FROM formatos WHERE id_estudio = ?',[$estudio->idEstudio]);
                            foreach($formatos as $formato)
                            {
                                $valoresreferencias = DB::select('SELECT * FROM valoresreferencia WHERE id_prueba = ? AND (Sexo = ? OR Sexo = "Indistinto")
                                AND (Edad = ? AND EdadMin <= ? AND EdadMax >= ?)', [$formato->id_prueba, $solicitud->Sexo, $solicitud->EdadTipo, $solicitud->Edad, $solicitud->Edad]);
                                $prueba = Prueba::findOrFail($formato->id_prueba);
                                $tomaxest = new Tomaxest();
                                $tomaxest->actualizar = "0";
                                $tomaxest->editor_texto = $prueba->editor_texto;
                                $tomaxest->formula = $prueba->formula;
                                $tomaxest->espaquete = $estudio->espaquete;
                                $tomaxest->id_estxsol = $estxsol->idEstxSol;
                                $tomaxest->sucursal = session('SUCURSAL');
                                $tomaxest->solicitud = $solicitud->IdSolicitud;
                                $tomaxest->MuestraID = "Default";
                                $tomaxest->Estudio = $estxsol->id_estudio;
                                $tomaxest->Toma = "1";
                                $tomaxest->Fecha = $solicitud->Fecha;
                                $tomaxest->ClavePrueba = $prueba->cveprueba;
                                $tomaxest->Prueba = $prueba->Descripcion;
                                //$tomaxest->Orden = ;
                                //$tomaxest->Estatus = ;
                                //$tomaxest->Importe = ;
                                //$tomaxest->Valores = ;
                                //$tomaxest->Medida = ;
                                //$tomaxest->TipoFormato = ;
                                //$tomaxest->autoanalizador = ;                                                    
                                //$tomaxest->Hora = ;
                                $tomaxest->word = "1";
                                $tomaxest->antibiograma = $prueba->antibiograma;
                                $tomaxest->save();
                                foreach($valoresreferencias as $valoresreferencia)
                                {
                                    $tomaxestss = Tomaxest::findOrFail($tomaxest->id);
                                    $tomaxestss->Valmin = $valoresreferencia->ValMin;
                                    
                                    $tomaxestss->ValMax = $valoresreferencia->ValMax;
                                    $tomaxestss->TextoValores = $valoresreferencia->TextoValores;
                                    $tomaxestss->save();
                                }
                            }
                        }
                    }
                    else{
                        $paquetesX = DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 1',[$estxsol->id_estudio]);
                        foreach ($paquetesX as $paquete)
                        {
                            $paquete_detalles = DB::select('SELECT * FROM paquete_detalle WHERE id_Estudio = ?',[$paquete->idEstudio]);
                            foreach($paquete_detalles as $paquete_detalle)
                            {
                                $formatos = DB::select('SELECT * FROM formatos WHERE id_estudio = ?',[$paquete_detalle->id_estudio_detalle]);
                                foreach($formatos as $formato)
                                {
                                    $valoresreferencias = DB::select('SELECT * FROM valoresreferencia WHERE id_prueba = ? AND (Sexo = ? OR Sexo = "Indistinto")
                                    AND (Edad = ? AND EdadMin <= ? AND EdadMax >= ?)', [$formato->id_prueba, $solicitud->Sexo, $solicitud->EdadTipo, $solicitud->Edad, $solicitud->Edad]);
                                    $prueba = Prueba::findOrFail($formato->id_prueba);

                                    $tomaxest = new Tomaxest();
                                    $tomaxest->actualizar = "0";
                                    $tomaxest->editor_texto = $prueba->editor_texto;
                                    $tomaxest->formula = $prueba->formula;
                                    $tomaxest->espaquete = $paquete->espaquete;
                                    $tomaxest->id_estxsol = $estxsol->idEstxSol;
                                    $tomaxest->sucursal = session('SUCURSAL');
                                    $tomaxest->solicitud = $solicitud->IdSolicitud;
                                    $tomaxest->MuestraID = "Default";
                                    $tomaxest->Estudio = $estxsol->id_estudio;
                                    $tomaxest->Toma = "1";
                                    $tomaxest->Fecha = $solicitud->Fecha;
                                    $tomaxest->ClavePrueba = $prueba->cveprueba;
                                    $tomaxest->Prueba = $prueba->Descripcion;
                                    //$tomaxest->Orden = ;
                                    //$tomaxest->Estatus = ;
                                    //$tomaxest->Importe = ;
                                    //$tomaxest->Valores = ;
                                    //$tomaxest->Medida = ;
                                    //$tomaxest->TipoFormato = ;
                                    //$tomaxest->autoanalizador = ;                                                            
                                    //$tomaxest->Hora = ;
                                    $tomaxest->word = "1";
                                    $tomaxest->antibiograma = $prueba->antibiograma;
                                    $tomaxest->save();

                                    foreach($valoresreferencias as $valoresreferencia)
                                    {
                                        $tomaxest_id = Tomaxest::find($tomaxest->id);
                                        $tomaxest_id->Valmin = $valoresreferencia->ValMin;
                                        $tomaxest_id->ValMax = $valoresreferencia->ValMax;
                                        $tomaxest_id->TextoValores = $valoresreferencia->TextoValores;                                
                                        $tomaxest_id->save();                                    
                                    }
                                }
                            }
                        }
                    }                    
                }
            }
            else
            {                
                foreach($tomaxest_actuales as $tomaxest_actual)
                {
                    $estxsol = Estxsol::where('idEstxSol', $tomaxest_actual->id_estxsol)->first();
                    $prueba = Prueba::where('cveprueba', '=', $tomaxest_actual->ClavePrueba)->first();
                    if(DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 0',[$estxsol->id_estudio]))
                    {
                        $valoresreferencias = DB::select('SELECT * FROM valoresreferencia WHERE id_prueba = ? AND (Sexo = ? OR Sexo = "Indistinto")
                        AND (Edad = ? AND EdadMin <= ? AND EdadMax >= ?)', [$prueba->idPrueba, $solicitud->Sexo, $solicitud->EdadTipo, $solicitud->Edad, $solicitud->Edad]);                    
                        $tomaxest = Tomaxest::find($tomaxest_actual->id);
                        $tomaxest->actualizar = "0";
                        $tomaxest->editor_texto = $prueba->editor_texto;
                        $tomaxest->formula = $prueba->formula;
                        $tomaxest->espaquete = "0";
                        $tomaxest->id_estxsol = $estxsol->idEstxSol;
                        $tomaxest->sucursal = session('SUCURSAL');
                        $tomaxest->solicitud = $solicitud->IdSolicitud;
                        $tomaxest->MuestraID = "Default";
                        $tomaxest->Estudio = $estxsol->id_estudio;
                        $tomaxest->Toma = "1";
                        $tomaxest->Fecha = $solicitud->Fecha;
                        $tomaxest->ClavePrueba = $prueba->cveprueba;
                        $tomaxest->Prueba = $prueba->Descripcion;                                
                        $tomaxest->Resultado = "";
                        $tomaxest->word = "1";
                        $tomaxest->antibiograma = $prueba->antibiograma;
                        $tomaxest->save();
                        foreach($valoresreferencias as $valoresreferencia)
                        {
                            $tomaxestss = Tomaxest::findOrFail($tomaxest_actual->id);
                            $tomaxestss->Valmin = $valoresreferencia->ValMin;
                                            
                            $tomaxestss->ValMax = $valoresreferencia->ValMax;
                            $tomaxestss->TextoValores = $valoresreferencia->TextoValores;
                            $tomaxestss->save();
                        }
                    }
                    else
                    {
                        $valoresreferencias = DB::select('SELECT * FROM valoresreferencia WHERE id_prueba = ? AND (Sexo = ? OR Sexo = "Indistinto")
                        AND (Edad = ? AND EdadMin <= ? AND EdadMax >= ?)', [$prueba->id_prueba, $solicitud->Sexo, $solicitud->EdadTipo, $solicitud->Edad, $solicitud->Edad]);
                        $tomaxest = Tomaxest::find($tomaxest_actual->id);
                        $tomaxest->actualizar = "0";
                        $tomaxest->editor_texto = $prueba->editor_texto;
                        $tomaxest->formula = $prueba->formula;
                        $tomaxest->espaquete = "1";
                        $tomaxest->id_estxsol = $estxsol->idEstxSol;
                        $tomaxest->sucursal = session('SUCURSAL');
                        $tomaxest->solicitud = $solicitud->IdSolicitud;
                        $tomaxest->MuestraID = "Default";
                        $tomaxest->Estudio = $estxsol->id_estudio;
                        $tomaxest->Toma = "1";
                        $tomaxest->Fecha = $solicitud->Fecha;
                        $tomaxest->ClavePrueba = $prueba->cveprueba;
                        $tomaxest->Prueba = $prueba->Descripcion;
                        $tomaxest->Resultado = "";
                        $tomaxest->word = "1";
                        $tomaxest->antibiograma = $prueba->antibiograma;
                        $tomaxest->save();
                        foreach($valoresreferencias as $valoresreferencia)
                        {
                            $tomaxest_id = Tomaxest::find($tomaxest_actual->id);
                            $tomaxest_id->Valmin = $valoresreferencia->ValMin;
                            $tomaxest_id->ValMax = $valoresreferencia->ValMax;
                            $tomaxest_id->TextoValores = $valoresreferencia->TextoValores;                                
                            $tomaxest_id->save();                                    
                        }
                    }             
                }
            }
            

            return back();
        }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
        
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

/* else
            {
                $estxsoles = DB::select('SELECT * FROM estxsol WHERE id_solicitud = ?',[$solicitud->IdSolicitud]);
                foreach($estxsoles as $estxsol)
                {
                    
                    if(DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 0',[$estxsol->id_estudio]))
                    {
                        $estudiosX = DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 0',[$estxsol->id_estudio]);
                        foreach ($estudiosX as $estudio)
                        {
                            $formatos = DB::select('SELECT * FROM formatos WHERE id_estudio = ?',[$estudio->idEstudio]);
                            foreach($formatos as $formato)
                            {
                                $valoresreferencias = DB::select('SELECT * FROM valoresreferencia WHERE id_prueba = ? AND (Sexo = ? OR Sexo = "Indistinto")
                                AND (Edad = ? AND EdadMin <= ? AND EdadMax >= ?)', [$formato->id_prueba, $solicitud->Sexo, $solicitud->EdadTipo, $solicitud->Edad, $solicitud->Edad]);
                                $prueba = Prueba::findOrFail($formato->id_prueba);
                                foreach($tomaxest_actuales as $tomaxest_actual)
                                {
                                    $tomaxest = Tomaxest::find($tomaxest_actual->id);
                                    $tomaxest->actualizar = "0";
                                    $tomaxest->editor_texto = $prueba->editor_texto;
                                    $tomaxest->formula = $prueba->formula;
                                    $tomaxest->espaquete = $estudio->espaquete;
                                    $tomaxest->id_estxsol = $estxsol->idEstxSol;
                                    $tomaxest->sucursal = session('SUCURSAL');
                                    $tomaxest->solicitud = $solicitud->IdSolicitud;
                                    $tomaxest->MuestraID = "Default";
                                    $tomaxest->Estudio = $estxsol->id_estudio;
                                    $tomaxest->Toma = "1";
                                    $tomaxest->Fecha = $solicitud->Fecha;
                                    $tomaxest->ClavePrueba = $prueba->cveprueba;
                                    $tomaxest->Prueba = $prueba->Descripcion;                                
                                    $tomaxest->word = "1";
                                    $tomaxest->antibiograma = $prueba->antibiograma;
                                    $tomaxest->save();
                                    foreach($valoresreferencias as $valoresreferencia)
                                    {
                                        $tomaxestss = Tomaxest::findOrFail($tomaxest->id);
                                        $tomaxestss->Valmin = $valoresreferencia->ValMin;
                                        
                                        $tomaxestss->ValMax = $valoresreferencia->ValMax;
                                        $tomaxestss->TextoValores = $valoresreferencia->TextoValores;
                                        $tomaxestss->save();
                                    }
                                }
                            }
                        }
                    }
                    else{
                        $paquetesX = DB::select('SELECT * FROM estudios WHERE idEstudio = ? AND espaquete = 1',[$estxsol->id_estudio]);
                        foreach ($paquetesX as $paquete)
                        {
                            $paquete_detalles = DB::select('SELECT * FROM paquete_detalle WHERE id_Estudio = ?',[$paquete->idEstudio]);
                            foreach($paquete_detalles as $paquete_detalle)
                            {
                                $formatos = DB::select('SELECT * FROM formatos WHERE id_estudio = ?',[$paquete_detalle->id_estudio_detalle]);
                                foreach($formatos as $formato)
                                {
                                    $valoresreferencias = DB::select('SELECT * FROM valoresreferencia WHERE id_prueba = ? AND (Sexo = ? OR Sexo = "Indistinto")
                                    AND (Edad = ? AND EdadMin <= ? AND EdadMax >= ?)', [$formato->id_prueba, $solicitud->Sexo, $solicitud->EdadTipo, $solicitud->Edad, $solicitud->Edad]);
                                    $prueba = Prueba::findOrFail($formato->id_prueba);

                                    foreach($tomaxest_actuales as $tomaxest_actual)
                                    {
                                        $tomaxest = Tomaxest::find($tomaxest_actual->id);
                                        $tomaxest->actualizar = "0";
                                        $tomaxest->editor_texto = $prueba->editor_texto;
                                        $tomaxest->formula = $prueba->formula;
                                        $tomaxest->espaquete = $paquete->espaquete;
                                        $tomaxest->id_estxsol = $estxsol->idEstxSol;
                                        $tomaxest->sucursal = session('SUCURSAL');
                                        $tomaxest->solicitud = $solicitud->IdSolicitud;
                                        $tomaxest->MuestraID = "Default";
                                        $tomaxest->Estudio = $estxsol->id_estudio;
                                        $tomaxest->Toma = "1";
                                        $tomaxest->Fecha = $solicitud->Fecha;
                                        $tomaxest->ClavePrueba = $prueba->cveprueba;
                                        $tomaxest->Prueba = $prueba->Descripcion;
                                        //$tomaxest->Orden = ;
                                        //$tomaxest->Estatus = ;
                                        //$tomaxest->Importe = ;
                                        //$tomaxest->Valores = ;
                                        //$tomaxest->Medida = ;
                                        //$tomaxest->TipoFormato = ;
                                        //$tomaxest->autoanalizador = ;                                                            
                                        //$tomaxest->Hora = ;
                                        $tomaxest->word = "1";
                                        $tomaxest->antibiograma = $prueba->antibiograma;
                                        $tomaxest->save();

                                        foreach($valoresreferencias as $valoresreferencia)
                                        {
                                            $tomaxest_id = Tomaxest::find($tomaxest->id);
                                            $tomaxest_id->Valmin = $valoresreferencia->ValMin;
                                            $tomaxest_id->ValMax = $valoresreferencia->ValMax;
                                            $tomaxest_id->TextoValores = $valoresreferencia->TextoValores;                                
                                            $tomaxest_id->save();                                    
                                        }
                                    }
                                }
                            }
                        }
                    }                 
                }
            } */
