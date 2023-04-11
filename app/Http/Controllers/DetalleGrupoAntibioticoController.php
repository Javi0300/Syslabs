<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antibiotico;
use App\Models\GrupoAntibiotico;
use App\Models\DetalleGrupoAntibiotico;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class DetalleGrupoAntibioticoController extends Controller
{
    public $updateMode = false, $pacienteSeleccionado;
    
    public function index(Request $request)
    {
        $id_select = $request->get('select');
        /* $buscapor = $request->get('buscar');
        $grupo_antibioticos = DB::table('grupo_antibioticos')->select('*')->where('descripcion', 'LIKE', '%'.$buscapor.'%')->get(); */
        $grupo_antibioticos = DB::table('grupo_antibioticos')->select('*')->get();
       
        return view('detallegrupoantibioticos.index',compact('grupo_antibioticos','id_select', ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function store(Request $request)
    {
        try{
            $g_antibioticos = new GrupoAntibiotico();        
            $g_antibioticos->descripcion = $request->get('descripcion');        
            $g_antibioticos->save();
            return redirect('/detallegrupoantibioticos');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
    public function show($id){}

    public function edit($id, Request $request)
    {
        $id =  Crypt::decrypt($id);
        return view('detallegrupoantibioticos.edit')->with([
            'grupo_antibiotico' => GrupoAntibiotico::findorFail($id), //Para datos de la tabla de Grupos de Antibioticos
            'antibioticos' => Antibiotico::select('*')->orderby('descripcion')->get(), //Para el select de antibioticos disponibles
            'detallesGA' => DetalleGrupoAntibiotico::select('*')->where('id_GrupoAntibiotico', '=', $id)->get()//Para el select de antibioticos asignados
        ]);
    }
    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $Antibiotico = GrupoAntibiotico::findorFail($id);
            $Antibiotico->descripcion = $request->get('descripcion');
            $Antibiotico->sucursal = session('SUCURSAL');
            $Antibiotico->save();

            $cont = 0;
            $cancelado = $request->get('cancelado');
            $idDetalleGrupoAntibiotico = $request->get('idDetalleGrupoAntibiotico');
            $id_Antibiotico = $request->get('id_Antibiotico');
            if($request->get('idDetalleGrupoAntibiotico'))
            {
                while($cont < count($idDetalleGrupoAntibiotico)){
                    $dg_antibioticos = DetalleGrupoAntibiotico::find($idDetalleGrupoAntibiotico[$cont]); 
                    if(is_null($dg_antibioticos)){ 
                        $dg_antibioticos = new DetalleGrupoAntibiotico();
                        $dg_antibioticos->id_GrupoAntibiotico= $id; 
                    }
                    if($cancelado[$cont]=='1') {
                        DB::select('DELETE FROM detalle_grupo_antibioticos WHERE idDetalleGrupoAntibiotico = ?',[$idDetalleGrupoAntibiotico[$cont]]);
                    }else{
                        $dg_antibioticos->id_Antibiotico= $id_Antibiotico[$cont];
                        $dg_antibioticos->sucursal= session('SUCURSAL');
                        $dg_antibioticos->save();
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
        return back();
    }


    public function destroy($id)
    {
        try
        {
            if(DB::select('SELECT * FROM detalle_grupo_antibioticos WHERE id_GrupoAntibiotico = ?', [$id]))
            {
                return redirect('/detallegrupoantibioticos')->with('grupos', 'Este grupo de antibióticos no puede ser eliminado ya que contiene antibióticos en el, borre su contenido antes de borrar el grupo.');
            }
            $detalleAntibiotico = GrupoAntibiotico::find($id);
            $detalleAntibiotico->delete();
        }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
        return redirect('/detallegrupoantibioticos')->with('eliminar', 'Echo');
    }
}
