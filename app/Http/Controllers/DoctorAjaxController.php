<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Doctor;
use Illuminate\Http\Request;
class DoctorAjaxController extends Controller
{
    const PAGINACION= 1000;
    
    public function index()
    {
        $doctores = Doctor::all();
        if(request()->ajax()) {
            return datatables()->of(Doctor::select('*'))
            ->addColumn('action', 'doctoresajax.edit2')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('doctoresajax.index')->with('doctores',$doctores);
        
        
    }

    public function store(Request $request)
    {  
 
        $doctorId = $request->id;
 
        $doctor   =   Doctor::updateOrCreate(
                    [
                     'idDoctor' => $doctorId
                    ],
                    [
                    'doctor' => $request->Doctor, 
                    /* 'Paterno' => $request->paterno, 
                    'Materno' => $request->materno,  */
                    'FecNac' => $request->fecnac,
                    'Especialidad1' => $request->especialidad1,
                    'Especialidad1' => $request->especialidad1,
                    'CedProf' => $request->cedprof,
                    'Centro' => $request->centro,
                    'Sexo' => $request->sexo,
                    'Tels' => $request->tels,
                    'email' => $request->Email,
                    'Direccion' => $request->direccion,
                    'Colonia' => $request->colonia,
                    'cp' => $request->Cp,
                    'Estado' => $request->estado,                            
                    'Municipio' => $request->municipio,
                    ]);    
                         
        return Response()->json($doctor);
 
    }
 

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {   
        $where = array('idDoctor' => $request->id);
        $doctores  = Doctor::where($where)->first();
      
        return Response()->json($doctores);
    }
    
    public function destroy(Request $request)
    {
        $doctor = Doctor::where('idDoctor',$request->id)->delete();
      
        return Response()->json($doctor);
    }


    public function reportePDF()
    {
        $siemprehoy = Carbon::now()->toDateString();
        $actualhora = Carbon::now()->isoFormat('H:mm:ss A');
        $doctores = Doctor::latest()->paginate(10);
        $pdf = Pdf::loadView('reporteDoctores', compact('doctores', 'siemprehoy', 'actualhora'))->setPaper(array(0,0,1280.00,1500), 'portrait');
        return $pdf->stream('REPORTE');
    }
}