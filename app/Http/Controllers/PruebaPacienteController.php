<?php

namespace App\Http\Controllers;

use App\Models\CfdiParametro;
use App\Models\Paciente;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Empresas;
use App\Models\Pacientes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PruebaPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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


    	$pacientes=DB::table('pacientes')/* ->where('sucursal','=',session('SUCURSAL'))
        ->orderBy("idPaciente","desc") */
        ->get();
        
        $doctores=Doctor::all();
        /* $doctores=DB::table('doctores')->where('sucursal','=',session('SUCURSAL'))->get(); */
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
    

        $selectFecNac = $request->get('tFecNac10'); 
        $selectFecNac  = date('d/m/Y', strtotime($selectFecNac));
        $selectEdad = $request->get('tEdad10'); 
        $selectTipoEdad = $request->get('tTipoEdad10'); 
        $selectSexo = $request->get('tSexo10');
        $selectTelefono = $request->get('tTelefono10');
        $selectempresa = $request->get('tidEmpresa10');
        return view("solicitudes.solicitud.create",
            ["pacientes"=>$pacientes,"estudios"=>$estudios,"doctores"=>$doctores,"empresas"=>$empresas, "midPaciente"=>$idPacienteElegido,
            "midEmpresa"=>$selectempresa,"midDoctor"=>$selectdoctor,
            "mSexo"=>$selectSexo,"mFecNac"=>$selectFecNac,"mEdad"=>$selectEdad,"mTelefono"=>$selectTelefono,
            "mFecha"=>$mFecha,"mFechaEntrega"=>$mFechaEntrega,"midTipoToma"=>$selectTipotoma,"mNotas"=>$selectNotas,
            "mTipoEdad"=>$selectTipoEdad,"mchkCotizacion"=>$selectchkCotizacion,
            "cfdi_parametros"=> $cfdi_parametros
            ]);
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
