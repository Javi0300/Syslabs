<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctores = DB::select('SELECT idDoctor, doctor, DATE_FORMAT(FecNac, "%d/%m/%Y") AS FecNacFormateada, DATE_FORMAT(FecNac, "%Y-%m-%d") as FecNac, Especialidad1, Especialidad2, CedProf, Centro,
        Sexo, Tels, email, Direccion, Colonia, cp, Pais, Estado, Municipio FROM doctores');
        return view('doctores.index')->with('doctores', $doctores);
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
        $doctores = new Doctor();
        $doctores->doctor = $request->get('DoctorCreate');
        $doctores->FecNac = $request->get('FecNacCreate');
        $doctores->Especialidad1 = $request->get('Especialidad1Create');
        $doctores->Especialidad2 = $request->get('Especialidad2Create');
        $doctores->CedProf = $request->get('CedProfCreate');
        $doctores->Sexo = $request->get('SexoCreate');
        $doctores->Tels = $request->get('TelsCreate');
        $doctores->email = $request->get('emailCreate');
        $doctores->Direccion = $request->get('DireccionCreate');
        $doctores->cp = $request->get('cpCreate');
        $doctores->Pais = $request->get('PaisCreateDoctor');
        $doctores->Estado = $request->get('EstadoCreate');
        $doctores->Municipio = $request->get('MunicipioCreate');
        $doctores->sucursal = session('SUCURSAL');
        $doctores->save();


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

        return redirect('doctores');
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
       
        $doctor = Doctor::find($id);
        $doctor->doctor = $request->get('DoctorEdit');
        $doctor->FecNac = $request->get('FecNacEdit');
        $doctor->Especialidad1 = $request->get('Especialidad1Edit');
        $doctor->Especialidad2 = $request->get('Especialidad2Edit');
        $doctor->CedProf = $request->get('CedProfEdit');
        $doctor->Sexo = $request->get('SexoEdit');
        $doctor->Tels = $request->get('TelsEdit');
        $doctor->email = $request->get('emailEdit');
        $doctor->Direccion = $request->get('DireccionEdit');
        $doctor->cp = $request->get('cpEdit');
        $doctor->Pais = $request->get('PaisEditDoctor');
        $doctor->Estado = $request->get('EstadoEdit');
        $doctor->Municipio = $request->get('MunicipioEdit');
        $doctor->sucursal = session('SUCURSAL');
        $doctor->save();

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
            /* Crypt::encrypt($metodo->id) */
            return view("solicitudes.solicitud.create",
            ["pacientes"=>$pacientes,"estudios"=>$estudios,"doctores"=>$doctores,"empresas"=>$empresas, "midPaciente"=>$idPacienteElegido,
            "midEmpresa"=>$selectempresa,"midDoctor"=>$selectdoctor,
            "mSexo"=>$selectSexo,"mFecNac"=>$selectFecNac,"mEdad"=>$selectEdad,"mTelefono"=>$selectTelefono,
            "mFecha"=>$mFecha,"mFechaEntrega"=>$mFechaEntrega,"midTipoToma"=>$selectTipotoma,"mNotas"=>$selectNotas,
            "mTipoEdad"=>$selectTipoEdad,"mchkCotizacion"=>$selectchkCotizacion,
            "cfdi_parametros"=> $cfdi_parametros
            ]);
        
        }

        return redirect('doctores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect('/doctores')->with('eliminar', 'Echo');
    }

    public function reportePDF()
    {
        $siemprehoy = Carbon::now()->toDateString();
        $actualhora = Carbon::now()->isoFormat('H:mm:ss A');
        $doctores = Doctor::latest()->paginate(21);
        $cfdi = DB::table('cfdi_parametros')->select('CFDIRFC','CFDITEL','CFDIFCALLE', 'CFDIFNEXT', 'CFDIFNINT','CFDIFCOL','CFDISUCURSAL','CFDIFPAIS', 'CFDIFESTADO', 'CFDIFMUNICIPIO')
        ->where('id','=','1')->first();
        $pdf = Pdf::loadView('doctores.reporteDoctores', compact('cfdi','doctores', 'siemprehoy', 'actualhora'))->setPaper(array(0,0,1000.00,1000), 'portrait');
        return $pdf->stream('REPORTE');
    }
}
