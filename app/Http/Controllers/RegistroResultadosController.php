<?php

namespace App\Http\Controllers;

use App\Models\Antibiograma;
use App\Models\AntibiogramaDetalle;
use App\Models\Bacteria;
use App\Models\Depto;
use App\Models\Antibiotico;
use App\Models\GrupoAntibiotico;
use App\Models\DetalleGrupoAntibiotico;
use App\Models\Pacientes;
use App\Models\Estxsol;
use App\Models\geho_ordenes;
use App\Models\Tomaxest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RegistroResultadosController extends Controller
{
    public function index(Request $request)
    {
        $antibioticos = Antibiotico::all(); session(['antibioticos' => $antibioticos]);
        $antibiogramas = Antibiograma::select('*')->limit(0)->get();
        $bacterias = Bacteria::all(); session(['bacterias' => $bacterias]);
        $grupo_antibioticos = GrupoAntibiotico::all(); session(['grupo_antibioticos' => $grupo_antibioticos]);
        
        $hoy = Carbon::now()->addDays(0)->format('Y-m-d'); session(['hoy' => $hoy]);
        $deptos = Depto::select('*')->orderby('Depto')->get(); session(['deptos' => $deptos]);
        $encabezado = "";
        
        $pacientes = Pacientes::select('*')->orderby('Paciente')->get();
        DB::statement("SET SQL_MODE=''");
        $rresultados = DB::select('SELECT * FROM solicitud
        INNER JOIN pacientes ON solicitud.id_paciente=pacientes.idPaciente
        LIMIT 0');

        $estxsoles = DB::select('SELECT *, estudios.Nombre
        FROM tomaxest
        INNER JOIN estudios ON tomaxest.Estudio = estudios.idEstudio
        WHERE tomaxest.solicitud = 0');
        $tomaxest_editor = DB::select('SELECT *, estudios.Nombre
        FROM tomaxest
        INNER JOIN estudios ON tomaxest.Estudio = estudios.idEstudio
        WHERE tomaxest.solicitud = 0');

        if($request->get('validacion') == 1){

            $idPaciente = $request->get('BuscarPaciente');
            session(['idPaciente' => $idPaciente]);
            
            $fechaInic = $request->get('fechainic');
            session(['fechaInic' => $fechaInic]);
            $fechaFin = $request->get('fechafin');
            session(['fechaFin' => $fechaFin]);

            $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */ FROM solicitud
            INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
            /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
            WHERE solicitud.id_Paciente = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$idPaciente,$fechaInic,$fechaFin]);
            session(['rresultados' => $rresultados]);
            session(['modal_abierto' => 'no']);
            session(['editor_abierto' => 'no']);
            return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles'))
            ->with([
                'IdSolicitud' => '',
                'antibiogramas' => $antibiogramas,
                'bacterias' => $bacterias,
                'grupo_antibioticos' => $grupo_antibioticos,
                'antibioticos' => $antibioticos,
                'desplegado' => '1',
                'finicio' => $fechaInic,
                'ffin' => $fechaFin,
                'slcPaciente' => session('idPaciente'),
                'rresultados'=> session('rresultados'),
                'tomaxest_editor' => $tomaxest_editor,
                'idDepto' => ''
            ]);
        }
        if($request->get('validacion') == 2){

            $idPaciente = $request->get('BuscarPaciente');
            session(['idPaciente' => $idPaciente]);
            
            $fechaInic = $request->get('fechainic');
            session(['fechaInic' => $fechaInic]);
            $fechaFin = $request->get('fechafin');
            session(['fechaFin' => $fechaFin]);

            $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */ FROM solicitud
            INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
            /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
            WHERE solicitud.Fecha BETWEEN ? AND ? ',[$fechaInic,$fechaFin]);
            session(['rresultados' => $rresultados]);
            session(['modal_abierto' => 'no']);
            session(['editor_abierto' => 'no']);
            return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles'))
            ->with([
                'IdSolicitud' => '',
                'antibiogramas' => $antibiogramas,
                'bacterias' => $bacterias,
                'grupo_antibioticos' => $grupo_antibioticos,
                'antibioticos' => $antibioticos,
                'desplegado' => '2',
                'finicio' => $fechaInic,
                'ffin' => $fechaFin,
                'slcPaciente' => session('idPaciente'),
                'rresultados'=> session('rresultados'),
                'tomaxest_editor' => $tomaxest_editor,
                'idDepto' => ''
            ]);
        }
        if($request->get('validacion') == 3){
           
            $idDepto = $request->get('depto');
            session(['idDepto' => $idDepto]);
            
            $fechaInic = $request->get('fechainic');
            session(['fechaInic' => $fechaInic]);
            $fechaFin = $request->get('fechafin');
            session(['fechaFin' => $fechaFin]);

            $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente, estxsol.Depto
            FROM solicitud
            INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
            INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud
            WHERE estxsol.Depto = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$idDepto,$fechaInic,$fechaFin]);
            session(['modal_abierto' => 'no']);
            session(['editor_abierto' => 'no']);
            return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles','rresultados'))
            ->with([
                'IdSolicitud' => '',
                'antibiogramas' => $antibiogramas,
                'bacterias' => $bacterias,
                'grupo_antibioticos' => $grupo_antibioticos,
                'antibioticos' => $antibioticos,
                'desplegado' => '3',
                'finicio' => $fechaInic,
                'ffin' => $fechaFin,
                'slcPaciente' => '',
                'tomaxest_editor' => $tomaxest_editor,
                'idDepto' => session('idDepto')
            ]);
        }
        
        if($request->get('IdSolicitud')){
            
            $IdSolicitud = $request->get('IdSolicitud');
            
            $Validador = $request->get('inValidador');
            $Paciente = $request->get('selectPaciente');
            $fechaInic = $request->get('inFechaI');
            $fechaFin = $request->get('inFechaF');
            $Depto = $request->get('selectDepto');

            $estxsoles = DB::select('SELECT *, estudios.Nombre
            FROM tomaxest
            INNER JOIN estudios ON tomaxest.Estudio = estudios.idEstudio
            WHERE tomaxest.solicitud = ?', [$IdSolicitud]);

            if($Validador === "1")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */ FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
                WHERE solicitud.id_Paciente = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$Paciente,$fechaInic,$fechaFin]);
            }
            if($Validador === "2")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */
                FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
                WHERE solicitud.Fecha BETWEEN ? AND ? ',[$fechaInic,$fechaFin]);
            }
            if($Validador === "3")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente, estxsol.Depto
                FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud
                WHERE estxsol.Depto = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$Depto,$fechaInic,$fechaFin]);
            }
            session(['modal_abierto' => 'no']);
            session(['editor_abierto' => 'no']);
            return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles','rresultados'))
            ->with([
                'IdSolicitud' => $IdSolicitud,
                'antibiogramas' => $antibiogramas,
                'bacterias' => $bacterias,
                'grupo_antibioticos' => $grupo_antibioticos,
                'antibioticos' => $antibioticos,
                'desplegado' =>  $Validador,
                'finicio' => $fechaInic,
                'ffin' => $fechaFin,
                'slcPaciente' => $Paciente,
                'tomaxest_editor' => $tomaxest_editor,
                'idDepto' => $Depto
            ]);
        }
        if($request->get('btnAntibiograma') === "1"){
            session(['modal_abierto' => 'si']);
            session(['editor_abierto' => 'no']);
            $IdSolicitud = $request->get('modal_IdSolicitud');
            
            $Validador = $request->get('modal_inValidador');
            $Paciente = $request->get('modal_selectPaciente');
            $fechaInic = $request->get('modal_inFechaI');
            $fechaFin = $request->get('modal_inFechaF');
            $Depto = $request->get('modal_selectDepto');

            $estxsoles = DB::select('SELECT *, estudios.Nombre
            FROM tomaxest
            INNER JOIN estudios ON tomaxest.Estudio = estudios.idEstudio
            WHERE tomaxest.solicitud = ?', [$IdSolicitud]);
            session(['estxsoles' => $estxsoles]);
            $id_bacteria = Bacteria::select('*')->first();
            if(is_null($id_bacteria)){ 
                $bacteria = new Bacteria();
                $bacteria->descrpcion= "Bacteria nueva"; 
                $bacteria->sucursal= session('SUCURSAL');
                $bacteria->save();
            }
            $antibiograma_ID = $request->get('modal_tomaxest_id');
            
            $tomaxest = Tomaxest::findOrFail($request->get('modal_tomaxest_id'));
            if($tomaxest->actualizar == "0" || $tomaxest->actualizar == "")
            {
                DB::select('INSERT INTO antibiograma (id_tomaxest, id_bacteria, num_bacteria, actualizado, sucursal) VALUES (?, ?, ?, ?, ?)', 
                [$antibiograma_ID,$id_bacteria->idBacteria,1,0,session('SUCURSAL')]);
                DB::select('INSERT INTO antibiograma (id_tomaxest, id_bacteria, num_bacteria, actualizado, sucursal) VALUES (?, ?, ?, ?, ?)', 
                [$antibiograma_ID,$id_bacteria->idBacteria,2,0,session('SUCURSAL')]);
                DB::select('INSERT INTO antibiograma (id_tomaxest, id_bacteria, num_bacteria, actualizado, sucursal) VALUES (?, ?, ?, ?, ?)', 
                [$antibiograma_ID,$id_bacteria->idBacteria,3,0,session('SUCURSAL')]);
                
            }
            $tomaxest->actualizar = 1;
            $tomaxest->update();
            
            $antibiogramas = Antibiograma::select('antibiograma.idAntibiograma','antibiograma.id_bacteria','antibiograma.num_bacteria','bacterias.idBacteria','bacterias.descripcion','antibiograma.datos_extra')
            ->join('bacterias','bacterias.idBacteria','=','antibiograma.id_bacteria')
            ->where('id_tomaxest', '=', $antibiograma_ID)
            ->orderby('antibiograma.num_bacteria', 'asc')->get();
            session(['antibiogramas' => $antibiogramas]);
            $detallesGA = DB::select('SELECT antibioticos.descripcion AS Antibiotico FROM detalle_grupo_antibioticos
                INNER JOIN antibioticos ON antibioticos.idAntibiotico = detalle_grupo_antibioticos.id_Antibiotico
                WHERE id_GrupoAntibiotico = 0');
            session(['detallesGA' => $detallesGA]);
            if($Validador === "1")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */ FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
                WHERE solicitud.id_Paciente = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$Paciente,$fechaInic,$fechaFin]);
            }
            if($Validador === "2")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */
                FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
                WHERE solicitud.Fecha BETWEEN ? AND ? ',[$fechaInic,$fechaFin]);
            }
            if($Validador === "3")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente, estxsol.Depto
                FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud
                WHERE estxsol.Depto = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$Depto,$fechaInic,$fechaFin]);
            }
            
            
            return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles','rresultados'))
            ->with([
                'IdSolicitud' => $IdSolicitud,
                'antibiogramas' => $antibiogramas,
                'bacterias' => $bacterias,
                'grupo_antibioticos' => $grupo_antibioticos,
                'antibioticos' => $antibioticos,
                'desplegado' =>  $Validador,
                'finicio' => $fechaInic,
                'ffin' => $fechaFin,
                'slcPaciente' => $Paciente,
                'tomaxest_editor' => $tomaxest_editor,
                'idDepto' => $Depto
            ]);
        }
        if($request->get('btnEditorTexto') === "1"){
            $IdSolicitud = $request->get('modal_IdSolicitud');
            $Validador = $request->get('modal_inValidador');
            $Paciente = $request->get('modal_selectPaciente');
            $fechaInic = $request->get('modal_inFechaI');
            $fechaFin = $request->get('modal_inFechaF');
            $Depto = $request->get('modal_selectDepto');
            $estxsoles = DB::select('SELECT *, estudios.Nombre
            FROM tomaxest
            INNER JOIN estudios ON tomaxest.Estudio = estudios.idEstudio
            WHERE tomaxest.solicitud = ?', [$IdSolicitud]);
            //$tomaxest_id = $request->get('modal_tomaxest_id');
            $tomaxest_editor = Tomaxest::findOrFail($request->get('modal_tomaxest_id'));
            //Bacteria::select('*')->where('sucursal', '=', session('SUCURSAL'))->first();
            if($Validador === "1")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */ FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
                WHERE solicitud.id_Paciente = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$Paciente,$fechaInic,$fechaFin]);
            }
            if($Validador === "2")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente/* , estxsol.Depto */
                FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                /* INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud */
                WHERE solicitud.Fecha BETWEEN ? AND ? ',[$fechaInic,$fechaFin]);
            }
            if($Validador === "3")
            {
                $rresultados = DB::select('SELECT *, DATE_FORMAT(solicitud.Fecha, "%d/%m/%Y") AS solicitudFecha,solicitud.Estudios AS solicitudEstudios,pacientes.Paciente, estxsol.Depto
                FROM solicitud
                INNER JOIN pacientes ON solicitud.id_paciente = pacientes.idPaciente
                INNER JOIN estxsol ON estxsol.id_solicitud = solicitud.IdSolicitud
                WHERE estxsol.Depto = ? AND solicitud.Fecha BETWEEN ? AND ? ',[$Depto,$fechaInic,$fechaFin]);
            }
            session(['modal_abierto' => 'no']);
            session(['editor_abierto' => 'si']);
            return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles','rresultados'))
            ->with([
                'IdSolicitud' => $IdSolicitud,
                'antibiogramas' => $antibiogramas,
                'bacterias' => $bacterias,
                'grupo_antibioticos' => $grupo_antibioticos,
                'antibioticos' => $antibioticos,
                'desplegado' =>  $Validador,
                'finicio' => $fechaInic,
                'ffin' => $fechaFin,
                'slcPaciente' => $Paciente,
                'tomaxest_editor' => $tomaxest_editor,
                'idDepto' => $Depto
            ]);
        }
        session(['modal_abierto' => 'no']);
        session(['editor_abierto' => 'no']);
        return view('registro_resultados.index', compact('encabezado','deptos','pacientes','estxsoles','rresultados'))
        ->with([
            'IdSolicitud' => '',
            'antibiogramas' => $antibiogramas,
            'bacterias' => $bacterias,
            'grupo_antibioticos' => $grupo_antibioticos,
            'antibioticos' => $antibioticos,
            'desplegado' => 'no',
            'finicio' => session('fechaInic'),
            'ffin' => session('fechaFin'),
            'slcPaciente' => session('idPaciente'),
            'tomaxest_editor' => $tomaxest_editor,
            'idDepto' => session('idPaciente')
        ]);
    }

    public function create(){}

    public function store(Request $request)
    {
        try{
            if($request->get('editor'))
            {
                //obtenemos el nombre del archivo
                $file = $request->get('editor');
                $tomaxest_ckeditor = Tomaxest::find($request->get('tomaxest_id'));
                $tomaxest_ckeditor->editor_archivo =  $file;
                $tomaxest_ckeditor->update();
                return back();
            }
            DB::beginTransaction();
            $resultados = $request->get('Resultado');
            $Estado = $request['Estado'];
            $cont = 0;
            if($resultados = $request->get('Resultado'))
            {
                while($cont < count($resultados))
                { 
                    $tomaxest = Tomaxest::findOrFail($request->get('id')[$cont]);
                    $tomaxest->Resultado =  $resultados[$cont];
                    if($resultados[$cont] >= $tomaxest->Valmin && $resultados[$cont] <= $tomaxest->ValMax)
                    {
                        $tomaxest->DentroLimite = 1;
                    }
                    else{
                        $tomaxest->DentroLimite = 0;
                    }
                    if($resultados[$cont] > $tomaxest->ValMax)
                    {
                        $tomaxest->altobajo = 2;
                    }
                    if($resultados[$cont] < $tomaxest->Valmin)
                    {
                        $tomaxest->altobajo = 1;
                    }
                    $tomaxest->Estatus = $Estado[$cont];
                    $tomaxest->update();
                    
                    $cont=$cont+1;            
                }    
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        session(['modal_abierto' => 'no']);
        session(['modal_cerrado' => 'si']);
        return redirect('registro_resultados');
    }
    
    public function antibiogramaGA(Request $request)
    {
        try{
            DB::beginTransaction();
            $cont = 0;
            $cont1 = 0;
            $idAntibiograma = $request->get('idAntibiograma');
            $slcBacteria = $request->get('slcBacteria');
            $txtDatosExtra = $request->get('txtDatosExtra');
            $cancelado=$request->get('cancelado');
            $textoidAntibiograma = $request->get('textoidAntibiograma');
            $textoAntibiotico = $request->get('textoAntibiotico');
            $textoResultado = $request->get('textoResultado');
            $textoUnidad = $request->get('textoUnidad');
            $idAntibiogramaDetalle = $request->get('idAntibiogramaDetalle');
            while($cont < count($idAntibiograma))
            {
                $antibiograma = Antibiograma::findOrFail($request->get('idAntibiograma')[$cont]);
                $antibiograma->id_bacteria = $slcBacteria[$cont];
                $antibiograma->datos_extra = $txtDatosExtra[$cont];
                $antibiograma->actualizado = 1;
                $antibiograma->sucursal= session('SUCURSAL');  
                $antibiograma->update();
                
                $cont=$cont+1;
            }
            if($request->filled('textoAntibiotico'))
            {
                while($cont1 < count($textoAntibiotico))
                {
                    $antibiograma_dtll = AntibiogramaDetalle::find($idAntibiogramaDetalle[$cont1]);
                    if(is_null($antibiograma_dtll)){ 
                        $antibiograma_dtll = new AntibiogramaDetalle(); //SI no lo encuentra agregar (insert) // delo contrario hace un update
                        $antibiograma_dtll->id_Antibiograma = $textoidAntibiograma[$cont1];
                    }
                    //Si esta marcado con canceadoe=1 eliminar registro
                    if($cancelado[$cont1]=='1') {
                        DB::delete('DELETE FROM antibiograma_detalle WHERE idAntibiogramaDetalle = ?',[$idAntibiogramaDetalle[$cont1]]);
                    }
                    else{
                        $antibiograma_dtll->id_Antibiograma = $textoidAntibiograma[$cont1];
                        $antibiograma_dtll->antibiotico =  $textoAntibiotico[$cont1];
                        $antibiograma_dtll->resultado = $textoResultado[$cont1];
                        $antibiograma_dtll->unidad = $textoUnidad[$cont1];
                        $antibiograma_dtll->sucursal = session('SUCURSAL');  
                        $antibiograma_dtll->save();
                    }
                    $cont1=$cont1+1;
                }
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return back();
    }

    public function guardarPDF(Request $request)
    {
        
        $key = $request->header('X-key');
        $sender = $request->header('X-password');

        if ($this->ValidaKey($key, $sender) == true) {        
            $this->validate($request, [
                'PDF_resultado' => 'required|mimes:pdf'
            ]);

            if ($request->hasfile('PDF_resultado')) {
                $sucursal = $request->sucursal;
                $folio = $request->folio;

                $orden = DB::table('geho_ordenes as o')
                    ->select('o.id','o.sucursal','o.folio')
                    ->where('o.sucursal','=',$sucursal)
                    ->where('o.folio','=',$folio)
                    ->first();

                if (is_null($orden)) {
                    $orden = new geho_ordenes();
                }
                else {
                    $orden = geho_ordenes::find($orden->id);
                }
                
                $orden->sucursal = $sucursal;
                $orden->folio = $folio;
                $orden->estatus = 'PENDIENTE';
                $blob = file_get_contents($request->PDF_resultado);
                $orden->PDF_resultados = $blob;
                $orden->save();
            }
            return response()->json([
                'status' => 'OK',
                'message' => 'Archivo recibido. Orden ' . $sucursal . '-' . $folio
            ]);
        }
        return back();
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('registro_resultados.antibiograma');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        //
    }
}
