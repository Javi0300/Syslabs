<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = DB::select('SELECT idEmpresa, sucursal, Nombre, tel1, tel2, rfc, direccion, cp, pais, Entidad, Ciudad FROM empresas');
        return view('empresas.index')->with('empresas', $empresas);
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $empresas = new Empresa();
        $empresas->Nombre = $request->get('NombreCreate');
        $empresas->tel1 = $request->get('tel1Create');
        $empresas->tel2 = $request->get('tel2Create');
       /*  $empresas->Nombre = $request->get('Tipo_EmpresaCreate'); */
        $empresas->rfc = $request->get('rfcCreate');
        $empresas->direccion = $request->get('direccionCreate');
        $empresas->cp = $request->get('CpCreate');
        $empresas->pais = $request->get('paisCreate');
        $empresas->Entidad = $request->get('EstadoCreate');
        $empresas->Ciudad = $request->get('MunicipioCreate');
        $empresas->sucursal = session('SUCURSAL');
        $empresas->tipo_tarifa = session('SUCURSAL');
        $empresas->save();

        /*----------------------------------------------------------*/
        $idPaciente = $request->get('idPacienteSelect');
        $datosPaciente=explode("_", $idPaciente ); 
        $idPacienteElegido=$datosPaciente[0]; 
        $selectdoctor = $request->get('idDoctorSelect');
        $selectempresa = $request->get('idEmpresaSelect');
        $selectSexo = $request->get('tSexo'); 
        $selectFecNac = $request->get('tFecNac'); 
        $selectEdad = $request->get('tEdad'); 
        $selectTipoEdad = $request->get('tTipoEdad'); 
        $selectTelefono = $request->get('tTelefono'); 
        $selectchkCotizacion = $request->get('tchkCotizacion'); 

        $selectTipotoma = $request->get('idTipoTomaSelect');
        $selectNotas = $request->get('txtNotas');
        $selectFechaEntrega = $request->get('tFechaEntrega'); 

        if ($selectempresa == ""){$selectempresa = "1";}

        $mFecha = Carbon::now()->addDays(0)->format('Y-m-d');
        $mFechaEntrega = Carbon::now()->addDays(1)->format('Y-m-d');



        $selectFecNac = $request->get('tFecNac10'); 
        $selectFecNac  = date('d/m/Y', strtotime($selectFecNac));
        $selectEdad = $request->get('tEdad10'); 
        $selectTipoEdad = $request->get('tTipoEdad10'); 
        $selectSexo = $request->get('tSexo10');
        $selectTelefono = $request->get('tTelefono10');
        $selectempresa = $request->get('tidEmpresa10');
        $selectdoctor = $request->get('tidDoctor10');
        //$idPacienteElegido = $Pacientes->idPaciente;
         



    	$pacientes=DB::table('pacientes')->where('sucursal','=',session('SUCURSAL'))
        ->orderBy("idPaciente","desc")
        ->get();
        $doctores=DB::table('doctores')->where('sucursal','=',session('SUCURSAL'))->get();
        $empresas=DB::table('empresas')->where('sucursal','=',session('SUCURSAL'))->get();
    	$estudios = DB::table('estudios as est')
            ->join('tarifas as t','est.idEstudio','=','t.id_estudio')
            ->select(DB::raw('CONCAT(est.Abreviatura, " ",est.Nombre) AS NombreEstudio'),'est.idEstudio','est.Abreviatura','est.Nombre','est.Tomas','t.id_empresa','t.tarifa',
            'est.TiempoProceso','est.Tubo','est.depto'
            )
            ->where('t.id_empresa','=',$selectempresa)
            ->get();
        $cfdi_parametros=DB::table('cfdi_parametros')
        ->Select ('cfdisucursal','cfdiimp','cfdiretisr','cfdiretisrprct','cfdiretenciones','cfdiretivaprct')
        ->where('sucursal','=',session('SUCURSAL'))->first();
    

        
        if($request->filled('redireccionador')){
            
            return view("solicitudes.solicitud.create",
            ["pacientes"=>$pacientes,"estudios"=>$estudios,"doctores"=>$doctores,"empresas"=>$empresas, "midPaciente"=>$idPacienteElegido,
            "midEmpresa"=>$selectempresa,"midDoctor"=>$selectdoctor,
            "mSexo"=>$selectSexo,"mFecNac"=>$selectFecNac,"mEdad"=>$selectEdad,"mTelefono"=>$selectTelefono,
            "mFecha"=>$mFecha,"mFechaEntrega"=>$mFechaEntrega,"midTipoToma"=>$selectTipotoma,"mNotas"=>$selectNotas,
            "mTipoEdad"=>$selectTipoEdad,"mchkCotizacion"=>$selectchkCotizacion,
            "cfdi_parametros"=> $cfdi_parametros
            ]);
        
        }

        return redirect('/empresas');
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
        $empresa = Empresa::find($id);
        $empresa->Nombre = $request->get('NombreEdit');
        $empresa->tel1 = $request->get('tel1Edit');
        $empresa->tel2 = $request->get('tel2Edit');
       /*  $empresas->Nombre = $request->get('Tipo_EmpresaCreate'); */
        $empresa->rfc = $request->get('rfcEdit');
        $empresa->direccion = $request->get('direccionEdit');
        $empresa->cp = $request->get('CpEdit');
        $empresa->pais = $request->get('paisEdit');
        $empresa->Entidad = $request->get('EstadoEdit');
        $empresa->Ciudad = $request->get('MunicipioEdit');
        $empresa->sucursal = session('SUCURSAL');
        $empresa->tipo_tarifa = session('SUCURSAL');
        $empresa->save();

        /*----------------------------------------------------------*/
        $idPaciente = $request->get('idPacienteSelect');
        $datosPaciente=explode("_", $idPaciente ); 
        $idPacienteElegido=$datosPaciente[0]; 
        $selectdoctor = $request->get('idDoctorSelect');
        $selectempresa = $request->get('idEmpresaSelect');
        $selectSexo = $request->get('tSexo'); 
        $selectFecNac = $request->get('tFecNac'); 
        $selectEdad = $request->get('tEdad'); 
        $selectTipoEdad = $request->get('tTipoEdad'); 
        $selectTelefono = $request->get('tTelefono'); 
        $selectchkCotizacion = $request->get('tchkCotizacion'); 

        $selectTipotoma = $request->get('idTipoTomaSelect');
        $selectNotas = $request->get('txtNotas');
        $selectFechaEntrega = $request->get('tFechaEntrega'); 

        if ($selectempresa == ""){$selectempresa = "1";}

        $mFecha = Carbon::now()->addDays(0)->format('Y-m-d');
        $mFechaEntrega = Carbon::now()->addDays(1)->format('Y-m-d');



        $selectFecNac = $request->get('tFecNac10'); 
        $selectFecNac  = date('d/m/Y', strtotime($selectFecNac));
        $selectEdad = $request->get('tEdad10'); 
        $selectTipoEdad = $request->get('tTipoEdad10'); 
        $selectSexo = $request->get('tSexo10');
        $selectTelefono = $request->get('tTelefono10');
        $selectempresa = $request->get('tidEmpresa10');
        $selectdoctor = $request->get('tidDoctor10');
        //$idPacienteElegido = $Pacientes->idPaciente;
         



    	$pacientes=DB::table('pacientes')->where('sucursal','=',session('SUCURSAL'))
        ->orderBy("idPaciente","desc")
        ->get();
        $doctores=DB::table('doctores')->where('sucursal','=',session('SUCURSAL'))->get();
        $empresas=DB::table('empresas')->where('sucursal','=',session('SUCURSAL'))->get();
    	$estudios = DB::table('estudios as est')
            ->join('tarifas as t','est.idEstudio','=','t.id_estudio')
            ->select(DB::raw('CONCAT(est.Abreviatura, " ",est.Nombre) AS NombreEstudio'),'est.idEstudio','est.Abreviatura','est.Nombre','est.Tomas','t.id_empresa','t.tarifa',
            'est.TiempoProceso','est.Tubo','est.depto'
            )
            ->where('t.id_empresa','=',$selectempresa)
            ->get();
        $cfdi_parametros=DB::table('cfdi_parametros')
        ->Select ('cfdisucursal','cfdiimp','cfdiretisr','cfdiretisrprct','cfdiretenciones','cfdiretivaprct')
        ->where('sucursal','=',session('SUCURSAL'))->first();
    

        
        if($request->filled('redireccionador')){
            
            return view("solicitudes.solicitud.create",
            ["pacientes"=>$pacientes,"estudios"=>$estudios,"doctores"=>$doctores,"empresas"=>$empresas, "midPaciente"=>$idPacienteElegido,
            "midEmpresa"=>$selectempresa,"midDoctor"=>$selectdoctor,
            "mSexo"=>$selectSexo,"mFecNac"=>$selectFecNac,"mEdad"=>$selectEdad,"mTelefono"=>$selectTelefono,
            "mFecha"=>$mFecha,"mFechaEntrega"=>$mFechaEntrega,"midTipoToma"=>$selectTipotoma,"mNotas"=>$selectNotas,
            "mTipoEdad"=>$selectTipoEdad,"mchkCotizacion"=>$selectchkCotizacion,
            "cfdi_parametros"=> $cfdi_parametros
            ]);
        
        }

        return redirect('/empresas');
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
            $empresa = Empresa::find($id);
            $empresa->delete();
            return redirect('/empresas')->with('eliminar', 'Echo');
        }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
            //return $e->getMessage();
        }
    }

    public function reportePDF()
    {
        $siemprehoy = Carbon::now()->format('d/m/Y');
        $actualhora = Carbon::now()->isoFormat('H:mm:ss A');
        $empresas = Empresa::latest()->paginate(21);
        $cfdi = DB::table('cfdi_parametros')->select('CFDIRFC','CFDITEL','CFDIFCALLE', 'CFDIFNEXT', 'CFDIFNINT','CFDIFCOL','CFDISUCURSAL','CFDIFPAIS', 'CFDIFESTADO', 'CFDIFMUNICIPIO')
        ->where('id','=','1')->first();
        $pdf = Pdf::loadView('empresas.reporteEmpresas', compact('cfdi', 'empresas', 'siemprehoy', 'actualhora'))
        ->setPaper(array(0,0,1000.00,1000), 'portrait');
        return $pdf->stream('REPORTE');
    }
}
