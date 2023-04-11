<?php

namespace App\Http\Controllers;

use App\Models\Depto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use PhpParser\Node\Expr;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $departamentos = DB::select('SELECT id, Depto FROM deptos');
        return view('deptos.index')->with('departamentos', $departamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $deptos = new Depto();
        $deptos->Depto = $request->get('depto');
        $deptos->sucursal = session('SUCURSAL');
        $deptos->save();
        return redirect('/deptos');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
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
        try{
            $depto = Depto::find($id);
        $depto->Depto = $request->get('deptoEdit');
        $depto->sucursal = session('SUCURSAL');
        $depto->save();
        return redirect('/deptos');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
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
        try
        {
            if(DB::select('SELECT * FROM estudios WHERE depto = ?', [$id]))
            {
                return redirect('/deptos')->with('estudios', 'El registro de este departamento esta siendo utilizado por un estudio.');
            }
            if(DB::select('SELECT * FROM pruebas WHERE id_Departamento = ?', [$id]))
            {
                return redirect('/deptos')->with('pruebas', 'El registro de este departamento esta siendo utilizado por una prueba.');
            }
            $depto = Depto::find($id);
            $depto->delete();
        
        }
        catch(Exception $e){
            return back()->with('integrityviolation', $e->getMessage());
        }
        return redirect('/deptos')->with('eliminar', 'Echo');
    }

    public function reportePDF()
    {
        $siemprehoy = Carbon::now()->format('d/m/Y');
        $actualhora = Carbon::now()->isoFormat('H:mm:ss A');
        $deptos = Depto::latest()->paginate(21);
        $cfdi = DB::table('cfdi_parametros')->select('CFDIRFC','CFDITEL','CFDIFCALLE', 'CFDIFNEXT', 'CFDIFNINT','CFDIFCOL','CFDISUCURSAL','CFDIFPAIS', 'CFDIFESTADO', 'CFDIFMUNICIPIO')
        ->where('id','=','1')->first();
        $pdf = Pdf::loadView('deptos.reporteDeptos',  compact('cfdi','deptos', 'siemprehoy', 'actualhora'))
        ->setPaper(array(0,0,1000.00,1000), 'portrait');
        return $pdf->stream('REPORTE');
    }
}
