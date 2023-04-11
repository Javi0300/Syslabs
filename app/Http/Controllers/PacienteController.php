<?php

namespace App\Http\Controllers;

use App\Models\CfdiParametro;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\Empresas;
use App\Models\Pacientes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class PacienteController extends Controller
{
    /* protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    } */

    public function index()
    {
        
        $empresas = DB::select('SELECT * FROM empresas');
        $pacientes2 = Pacientes::all();
        $pacientes = DB::select('SELECT idPaciente,Paciente, email, DATE_FORMAT(FecNac, "%d/%m/%Y") AS FecNacFormateada, DATE_FORMAT(FecNac, "%Y-%m-%d") as FecNac, Sexo, id_Empresa, 
        Rfc, Calle, Numero, Colonia, Cp, Pais, Estado, Municipio, Telefono FROM pacientes;');

        
        return view('pacientes.index')->with([
            'empresas' => $empresas,
            'pacientes2' => $pacientes2,
            'pacientes' => $pacientes
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $siemprehoy = Carbon::now();
        
        $Pacientes = new Pacientes();
        $Pacientes->Paciente = $request->get('PacienteCreate');
        $Pacientes->FecNac = $request->get('FecNacCreate');
        $Pacientes->Sexo = $request->get('SexoCreate');
        $Pacientes->id_Empresa = $request->get('EmpresaCreate');
        $Pacientes->Telefono = $request->get('TelefonoCreate');
        $Pacientes->email = $request->get('emailCreate');
        $Pacientes->Rfc = $request->get('rfcCreate');
        $Pacientes->Cp = $request->get('CpCreate');
        $Pacientes->Calle = $request->get('calleCreate');
        $Pacientes->Numero = $request->get('NumeroCreate');
        $Pacientes->Colonia = $request->get('ColoniaCreate');
        $Pacientes->Pais = $request->get('paisCreate');
        $Pacientes->Estado = $request->get('EstadoCreate');
        $Pacientes->Municipio = $request->get('MunicipioCreate');
        $Pacientes->sucursal = session('SUCURSAL');
        $Pacientes->suc_empresa = session('SUCURSAL');
        $Pacientes->save();
        
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
        $idPacienteElegido = $Pacientes->idPaciente;
         



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
    

        
        if($request->has('redireccionador')){
            
            return view("solicitudes.solicitud.create",
            ["pacientes"=>$pacientes,"estudios"=>$estudios,"doctores"=>$doctores,"empresas"=>$empresas, "midPaciente"=>$idPacienteElegido,
            "midEmpresa"=>$selectempresa,"midDoctor"=>$selectdoctor,
            "mSexo"=>$selectSexo,"mFecNac"=>$selectFecNac,"mEdad"=>$selectEdad,"mTelefono"=>$selectTelefono,
            "mFecha"=>$mFecha,"mFechaEntrega"=>$mFechaEntrega,"midTipoToma"=>$selectTipotoma,"mNotas"=>$selectNotas,
            "mTipoEdad"=>$selectTipoEdad,"mchkCotizacion"=>$selectchkCotizacion,
            "cfdi_parametros"=> $cfdi_parametros
            ]);
        
        }
        return redirect('/pacientes');
        session()->flash('message', 'Paciente Successfully created.');
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

    public function edit(Request $request)
    {   
        $where = array('idPaciente' => $request->idPaciente);
        $pacientes  = Pacientes::where($where)->first();
      
        return Response()->json($pacientes);
    }

    public function update(Request $request, $id)
    {
        $siemprehoy = Carbon::now();
        $Paciente = Pacientes::find($id);
        $Paciente->Paciente = $request->get('PacienteEdit');
        $Paciente->FecNac = $request->get('FecNacEdit');
        $Paciente->Sexo = $request->get('SexoEdit');
        $Paciente->id_Empresa = $request->get('EmpresaEdit');
        $Paciente->Telefono = $request->get('TelefonoEdit');
        $Paciente->email = $request->get('emailEdit');
        $Paciente->Rfc = $request->get('rfcEdit');
        $Paciente->Cp = $request->get('CpEdit');
        $Paciente->Calle = $request->get('calleEdit');
        $Paciente->Numero = $request->get('NumeroEdit');
        $Paciente->Colonia = $request->get('ColoniaEdit');
        $Paciente->Pais = $request->get('paisEdit');
        $Paciente->Estado = $request->get('EstadoEdit');
        $Paciente->Municipio = $request->get('MunicipioEdit');
        $Paciente->sucursal = session('SUCURSAL');
        $Paciente->suc_empresa = session('SUCURSAL');
        $Paciente->save();

        /*----------------------------------------------------------------------------------*/
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
        $idPacienteElegido = $id;
         



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
        return redirect('/pacientes');
        session()->flash('message', 'Paciente Successfully actualizado.');
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
            $paciente = Pacientes::find($id);
            $paciente->delete();
            return redirect('/pacientes')->with('eliminar', 'Echo');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function reportePDF()
    {
        $siemprehoy = Carbon::now()->toDateString();
        $actualhora = Carbon::now()->isoFormat('H:mm:ss A');
        $pacientes = Pacientes::orderBy('Paciente', 'asc')->latest()->paginate(20);
        $cfdi = DB::table('cfdi_parametros')->select('CFDIRFC','CFDITEL','CFDIFCALLE', 'CFDIFNEXT', 'CFDIFNINT','CFDIFCOL','CFDISUCURSAL','CFDIFPAIS', 'CFDIFESTADO', 'CFDIFMUNICIPIO')
        ->where('id','=','1')->first();
        $pdf = Pdf::loadView('pacientes.reportepacientes',["cfdi"=>$cfdi, "pacientes"=>$pacientes] /* compact('cfdi','pacientes','actualhora','siemprehoy') */)
		->setPaper(array(0,0,1000.00,1000), 'portrait');
        return $pdf->stream('REPORTE');
    }
}
