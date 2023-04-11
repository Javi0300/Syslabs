<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prueba;
use App\Models\Depto;
use App\Models\Metodo;
use App\Models\Valoresreferencia;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pruebas = Prueba::all();
        return view('pruebas.index')->with('pruebas', $pruebas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deptos = DB::select('SELECT * FROM deptos ORDER BY Depto ASC');
        $metodos = DB::select('SELECT * FROM metodos ORDER BY descripcion ASC');
        return view('pruebas.create', compact('metodos'))->with('deptos', $deptos);
    }

    /* public function store(Request $request)
    {
        try{
            $pruebas = new Prueba();
        $pruebas->cveprueba = $request->get('cveprueba');
        $pruebas->abreviatura = $request->get('abreviatura');
        $pruebas->descripcion = $request->get('descripcion');
        $pruebas->Prueba = $request->get('Prueba');
        $pruebas->hoja_trabajo = $request->get('hoja_trabajo');
        $pruebas->id_Departamento = $request->get('departamento');
        $pruebas->TipoMuestra = $request->get('TipoMuestra');
        $pruebas->id_Metodo = $request->get('metodo');
        $pruebas->impr_metodo_Resultado = $request->get('impr_metodo_resultado');
        $pruebas->formula = $request->get('formula');
        $pruebas->imprimir_negritas = $request->get('imprimir_negritas');
        $pruebas->antibiograma = $request->get('antibiograma');
        $pruebas->medida = $request->get('medida');
        $pruebas->sexo = $request->get('sexo');
        $pruebas->TipoResultado = $request->get('TipoResultado');
        $pruebas->Resultado_default = $request->get('Resultado_default');
        $pruebas->Tipo_Valor = $request->get('Tipo_Valor');
        $pruebas->valor_restringido = $request->get('valor_restringido');        
        $pruebas->Decimales = $request->get('Decimales');
        $pruebas->dias = $request->get('dias');
        $pruebas->horas = $request->get('horas');
        $pruebas->minutos = $request->get('minutos');
        $pruebas->indicaciones = $request->get('indicaciones');
        $pruebas->notas = $request->get('notas');
        $pruebas->impr_Nota_Resultado = $request->get('impr_nota_resultado');
        $pruebas->notas_internas = $request->get('notas_internas');
        $pruebas->tipo_valor_normalidad = $request->get('tipo_valor_normalidad');
        //$pruebas->tipo_valor_normalidad = $request->get('resultado22');
        $pruebas->valor_normalidad_texto = $request->get('valor_normalidad_texto');
        $pruebas->sucursal = "00";
        $pruebas->save();


        $opcion = $request->input('tipo_valor_normalidad');
        if($opcion === "Rango númerico")
        {
            $valores = new Valoresreferencium();
            $valores->claveprueba = $pruebas->id;
            $valores->Sexo = $request->get('sexo2');
            $valores->Edad = $request->get('Edad');
            $valores->EdadMin = $request->get('EdadMin');
            $valores->EdadMax = $request->get('EdadMax');
            $valores->ValMin = $request->get('RefMin');
            $valores->ValMax = $request->get('RefMax');
            $valores->sucursal = 00;
            $valores->save();
            return redirect()->route('pruebas.edit', $pruebas->id)->with('redireccionar', 'tabla');
        }
        
        


        return redirect()->route('pruebas.edit', $pruebas->id);
        }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }

    } */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $pruebas = new Prueba();
            $pruebas->cveprueba = $request->get('cveprueba');
            $pruebas->abreviatura = $request->get('abreviatura');
            $pruebas->Descripcion = $request->get('descripcion');
            $pruebas->Prueba = $request->get('Prueba');
            $pruebas->hoja_trabajo = $request->get('hoja_trabajo');
            $pruebas->id_Departamento = $request->get('departamento');
            $pruebas->TipoMuestra = $request->get('TipoMuestra');
            $pruebas->id_Metodo = $request->get('metodo');
            $pruebas->impr_metodo_Resultado = $request->get('impr_metodo_resultado');
            $pruebas->formula = $request->get('formula');
            $pruebas->imprimir_negritas = $request->get('imprimir_negritas');
            $pruebas->editor_texto = $request->get('editor_texto');
            $pruebas->antibiograma = $request->get('antibiograma');
            $pruebas->Medida = $request->get('medida');
            $pruebas->sexo = $request->get('sexo');
            $pruebas->TipoResultado = $request->get('TipoResultado');
            $pruebas->Resultado_default = $request->get('Resultado_default');
            $pruebas->Tipo_Valor = $request->get('Tipo_Valor');
            $pruebas->valor_restringido = $request->get('valor_restringido');        
            $pruebas->Decimales = $request->get('Decimales');
            $pruebas->dias = $request->get('dias');
            $pruebas->horas = $request->get('horas');
            $pruebas->minutos = $request->get('minutos');
            $pruebas->indicaciones = $request->get('indicaciones');
            $pruebas->notas = $request->get('notas');
            $pruebas->impr_Nota_Resultado = $request->get('impr_nota_resultado');
            $pruebas->notas_internas = $request->get('notas_internas');
            $pruebas->tipo_valor_normalidad = $request->get('tipo_valor_normalidad');
            $pruebas->valor_normalidad_texto = $request->get('valor_normalidad_texto');
            $pruebas->sucursal = session('SUCURSAL');

            $pruebas->save();
            if("Rango númerico" === $pruebas->tipo_valor_normalidad = $request->get('tipo_valor_normalidad'))
            {
                $SexoValRef = $request->get('sexovalref1');
                $Edad = $request->get('Edad1');
                $EdadMin = $request->get('EdadMin1');
                $EdadMax = $request->get('EdadMax1');
                $ValMin = $request->get('RefMin1');
                $ValMax = $request->get('RefMax1');
                $TextoValores = $request->get('TextoValores');

                $cont = 0;
                if($request->filled('sexovalref1')){
                    while($cont < count($SexoValRef)){ 
                        $valores = new Valoresreferencia();
                        $valores->id_prueba= $pruebas->idPrueba;
                        $valores->Sexo = $SexoValRef[$cont];
                        $valores->Edad= $Edad[$cont];
                        $valores->EdadMin= $EdadMin[$cont];
                        $valores->EdadMax= $EdadMax[$cont];
                        $valores->ValMin= $ValMin[$cont];
                        $valores->ValMax= $ValMax[$cont];
                        $valores->TextoValores= $TextoValores[$cont];
                        $valores->sucursal=session('SUCURSAL');  
                        $valores->save();
                        $cont=$cont+1;            
                    }
                }
            }
            DB::commit();
            return redirect('/pruebas');
        }
        catch(Exception $e){
            DB::rollback();
            return $e->getMessage();
        }       
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id =  Crypt::decrypt($id);
        return view('pruebas.edit')->with([
            'prueba' => Prueba::findorFail($id),
            'deptos' => DB::select('SELECT * FROM deptos ORDER BY Depto ASC'),
            'metodos' => DB::select('SELECT * FROM metodos ORDER BY descripcion ASC'),
            'valoresreferancias' => Valoresreferencia::all()->where('id_prueba', '=', $id)
        ]);
    }

    public function update(Request $request, $id)
    {
        try
        {
            /* if(DB::select('SELECT cveprueba FROM pruebas WHERE cveprueba = ? AND idPrueba = ?', [$request->get('idss'), $id]))
            {
                return back()->with('duplicidadClave', 'Código similar, piense en otro.');
            } */
            DB::beginTransaction();            
            $prueba = Prueba::find($id);
            $prueba->cveprueba = $request->get('idss');
            $prueba->abreviatura = $request->get('abreviatura');
            $prueba->Descripcion = $request->get('descripcion');
            $prueba->Prueba = $request->get('Prueba');
            $prueba->hoja_trabajo = $request->get('hoja_trabajo');
            $prueba->id_Departamento = $request->get('departamento');
            $prueba->TipoMuestra = $request->get('TipoMuestra');
            $prueba->id_Metodo = $request->get('metodo');
            $prueba->impr_metodo_Resultado = $request->get('impr_metodo_resultado');        
            $prueba->formula = $request->get('formula');
            $prueba->imprimir_negritas = $request->get('imprimir_negritas');
            $prueba->antibiograma = $request->get('antibiograma');
            $prueba->editor_texto = $request->get('editor_texto');
            $prueba->Medida = $request->get('medida');
            $prueba->sexo = $request->get('sexo');
            $prueba->TipoResultado = $request->get('TipoResultado');
            $prueba->Resultado_default = $request->get('Resultado_default');
            $prueba->Tipo_Valor = $request->get('Tipo_Valor');
            $prueba->valor_restringido = $request->get('valor_restringido');   
            $prueba->Decimales = $request->get('Decimales');
            $prueba->dias = $request->get('dias');
            $prueba->horas = $request->get('horas');
            $prueba->minutos = $request->get('minutos');
            $prueba->indicaciones = $request->get('indicaciones');
            $prueba->notas = $request->get('notas');
            $prueba->impr_Nota_Resultado = $request->get('impr_nota_resultado');
            $prueba->notas_internas = $request->get('notas_internas');
            $prueba->tipo_valor_normalidad = $request->get('tipo_valor_normalidad');
            $prueba->valor_normalidad_texto = $request->get('valor_normalidad_texto');
            $prueba->sucursal = session('SUCURSAL');
            $prueba->save();
                
            if("Rango númerico" === $prueba->tipo_valor_normalidad)
            {
                $id_valoref = $request->get('id_valoref');
                $SexoValRef = $request->get('sexovalref1');
                $Edad = $request->get('Edad1');
                $EdadMin = $request->get('EdadMin1');
                $EdadMax = $request->get('EdadMax1');
                $ValMin = $request->get('RefMin1');
                $ValMax = $request->get('RefMax1');
                $TextoValores = $request->get('TextoValores');
                $cancelado = $request->get('cancelado');
                $cont = 0;
                if($request->get('id_valoref'))
                {
                    while($cont < count($id_valoref))
                    {
                        $valores = Valoresreferencia::find($id_valoref[$cont]);
                        if(is_null($valores)){ 
                            $valores = new Valoresreferencia();
                            $valores->id_prueba= $id; 
                        }
                        if($cancelado[$cont]=='1') {
                            DB::select('DELETE FROM valoresreferencia WHERE idValorReferencia = ?', [$id_valoref[$cont]]);
                        }else{
                            $valores->Sexo = $SexoValRef[$cont];
                            $valores->Edad= $Edad[$cont];
                            $valores->EdadMin= $EdadMin[$cont];
                            $valores->EdadMax= $EdadMax[$cont];
                            $valores->ValMin= $ValMin[$cont];
                            $valores->ValMax= $ValMax[$cont];
                            $valores->TextoValores= $TextoValores[$cont];
                            $valores->sucursal= session('SUCURSAL');  
                            $valores->save();   
                        }
                        $cont=$cont+1;
                    }
                }
            }
            DB::commit();
            return redirect('/pruebas');
        }
        catch(Exception $e){
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            if(DB::select('SELECT * FROM formatos WHERE id_prueba = ?', [$id]))
            {
                return redirect('/pruebas')->with('formatos', 'Esta prueba esta registrada como formato de algún estudio.');
            }
            DB::select('DELETE FROM valoresreferencia WHERE id_prueba = ?', [$id]);
            $prueba = Prueba::find($id);
            $prueba->delete();            
        }
        catch(Exception $e)
        {
            return back()->with('errorforaneo', $e->getMessage());
        }
        return redirect('/pruebas')->with('eliminar', 'echo');
    }    
}
