<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Tarifa;
use App\Models\Precio;
use App\Models\Estudio;
use App\Models\PrecioDetalle;
use Illuminate\Http\Request;
use Exception;
use Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Exports\ListaExport;
use App\Imports\ListaImport;
use Maatwebsite\Excel\Facades\Excel;

class PrecioDetalleController extends Controller
{
    public function index(Request $request)
    {
        $deptos = DB::select('SELECT * FROM deptos ORDER BY Depto');
        $listasprecios = DB::select('SELECT * FROM precios');
        $idPrecio = $request->get('iptidPrecio');
        session(['idPrecioDetalle' => $idPrecio]);
        $PrecioDescripcion = $request->get('iptPrecioDescripcion');
        session(['PrecioDescripcion' => $PrecioDescripcion]);
        $preciosdetalle = DB::select('SELECT deptos.Depto,  estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
        LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
        INNER JOIN deptos ON estudios.depto=deptos.id
        WHERE estudios.sucursal = ?', [$idPrecio, session('SUCURSAL')]);

        if($request->get('slcprecios')){
            $idPrecio = $request->get('idPrecio');
            $PrecioDescripcion = $request->get('PrecioDescripcion');

            $listaId = $request->get('slcprecios');
            
            DB::select('DELETE FROM precios_detalle WHERE id_Precio = ?', [$idPrecio]);
            $tablafuente = DB::select('SELECT estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
            LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
            WHERE estudios.sucursal = ? AND precios_detalle.precio != 0', [$listaId, session('SUCURSAL')]);
            foreach($tablafuente as $fuente){
                DB::select('INSERT INTO precios_detalle(id_Precio,id_Estudio,sucursal, precio)VALUES(?,?,?,?)',[$idPrecio,$fuente->idEstudio, session('SUCURSAL'),$fuente->precio]);
            }
            $preciosdetalle = DB::select('SELECT deptos.Depto,  estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
        LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
        INNER JOIN deptos ON estudios.depto=deptos.id
        WHERE estudios.sucursal = ?', [$idPrecio, session('SUCURSAL')]);
            return view('precios_detalle.index')->with(
            [
                'preciosdetalle'=>$preciosdetalle,
                'sumatoria' => $numero = 0,
                'sumatoriaCheckbox' => $numero2 = 0,
                'sumatoriaFuncion' => $numero3 = 0,
                'sumatoriaFuncion2' => $numero33 = 0,
                'sumatoriaidPrecioDetalle' => $numero4 = 0,
                'funcionIndicatoria' => $numero5 = 0,
                'PrecioDescripcion' => $PrecioDescripcion,

                'departamento' => $departamento = 1,
                'listaId' => $listaId,
                'deptos' => $deptos,
                'listasprecios' => $listasprecios,
                'activarfiltrador1' => 'no',
                'activarfiltrador2' => 'no',
                'activarfiltrador3' => 'si',
                'iptidPrecio' => $idPrecio
            ]);
        }

        if($request->get('filtrador') === "departamento"){
            $idPrecio = $request->get('idPrecio');
            $PrecioDescripcion = $request->get('PrecioDescripcion');
            $departamento = $request->get('slcfiltrador');
            $preciosdetalle = DB::select('SELECT deptos.Depto, estudios.idEstudio, estudios.espaquete, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
            LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
            INNER JOIN deptos ON estudios.depto=deptos.id
            WHERE estudios.sucursal = ? AND estudios.depto = ?', [$idPrecio, session('SUCURSAL'),$departamento]);
            
            
            return view('precios_detalle.index')->with(
            [
                'preciosdetalle'=>$preciosdetalle,
                'sumatoria' => $numero = 0,
                'sumatoriaCheckbox' => $numero2 = 0,
                'sumatoriaFuncion' => $numero3 = 0,
                'sumatoriaFuncion2' => $numero33 = 0,
                'sumatoriaidPrecioDetalle' => $numero4 = 0,
                'funcionIndicatoria' => $numero5 = 0,
                'PrecioDescripcion' => $PrecioDescripcion,

                'departamento' => $departamento,
                'listaId' => $listaId = 1,
                'deptos' => $deptos,
                'listasprecios' => $listasprecios,
                'activarfiltrador1' => 'no',
                'activarfiltrador2' => 'si',
                'activarfiltrador3' => 'no',
                'iptidPrecio' => $idPrecio
            ]);
        }
        
        if($request->get('filtrador') === "todo"){
            $idPrecio = $request->get('idPrecio');
            $PrecioDescripcion = $request->get('PrecioDescripcion');
            $preciosdetalle = DB::select('SELECT deptos.Depto,  estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
            LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
            INNER JOIN deptos ON estudios.depto=deptos.id
            WHERE estudios.sucursal = ?', [$idPrecio, session('SUCURSAL')]);
            
            
            return view('precios_detalle.index')->with(
            [
                'preciosdetalle'=>$preciosdetalle,
                'sumatoria' => $numero = 0,
                'sumatoriaCheckbox' => $numero2 = 0,
                'sumatoriaFuncion' => $numero3 = 0,
                'sumatoriaFuncion2' => $numero33 = 0,
                'sumatoriaidPrecioDetalle' => $numero4 = 0,
                'funcionIndicatoria' => $numero5 = 0,
                'PrecioDescripcion' => $PrecioDescripcion,

                'departamento' => $departamento = 1,
                'listaId' => $listaId = 1,
                'deptos' => $deptos,
                'listasprecios' => $listasprecios,
                'activarfiltrador1' => 'si',
                'activarfiltrador2' => 'no',
                'activarfiltrador3' => 'no',
                'iptidPrecio' => $idPrecio
            ]);
        }

        return view('precios_detalle.index')->with(
            [
                'preciosdetalle'=>$preciosdetalle,
                'sumatoria' => $numero = 0,
                'sumatoriaCheckbox' => $numero2 = 0,
                'sumatoriaFuncion' => $numero3 = 0,
                'sumatoriaFuncion2' => $numero33 = 0,
                'sumatoriaidPrecioDetalle' => $numero4 = 0,
                'funcionIndicatoria' => $numero5 = 0,
                'PrecioDescripcion' => $PrecioDescripcion,

                'departamento' => $departamento = 1,
                'listaId' => $listaId = 1,
                'deptos' => $deptos,
                'listasprecios' => $listasprecios,
                'activarfiltrador1' => 'no',
                'activarfiltrador2' => 'no',
                'activarfiltrador3' => 'no',
                'iptidPrecio' => $idPrecio
        ]);
    }
    public function reportePDF()
    {
        
        $detalles = DB::select('SELECT deptos.Depto,  estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
        LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
        INNER JOIN deptos ON estudios.depto=deptos.id
        WHERE estudios.sucursal = ?
        ORDER BY  deptos.Depto', [session('idPrecioDetalle'), session('SUCURSAL')]);
       $cfdi = DB::table('cfdi_parametros')->select('CFDIRFC','CFDITEL','CFDIFCALLE', 'CFDIFNEXT', 'CFDIFNINT','CFDIFCOL','CFDISUCURSAL','CFDIFPAIS', 'CFDIFESTADO', 'CFDIFMUNICIPIO')
       ->where('id','=','1')->first();
        $pdf = Pdf::loadView('precios_detalle.reportedetalle',["cfdi"=>$cfdi,"detalles"=>$detalles])
		->setPaper(array(0,0,1000.00,1000), 'portrait');
        return $pdf->stream('REPORTE');
    }
    public function archivoExcel(Request $request)
    {
        $id = $request->get('idListaPrecio');
        return view('precios_detalle.archivoExcel', compact('id'));
    }
    
    public function exportarExcel()
    {
        
        return Excel::download(new ListaExport, 'lista.xlsx');
        //return new InvoicesExport();
        
    }

    public function importarExcel(Request $request)
    {
        try
        {
            $file = $request->file('file');
            $idpdetalle = (int)$request->get('idPrecioDetalle');
            //session(['idPrecioDetalle' => $idpdetalle]);

            DB::select('DELETE FROM precios_detalle WHERE id_Precio = ?', [$idpdetalle]);
            Excel::import(new ListaImport($idpdetalle), $file);
        }
        catch(Exception $e){
            return back()->with('message', 'Error');
        }
        return back()->with('message', 'Importación de precios completada');
    }

    public function create(){}

    public function store(Request $request)
    {   
        try{
            DB::beginTransaction();
            $precio = $request->get('UpdatePrecio');
            $idEstudio = $request->get('idEstudio');
            $idPrecio = $request->get('idPrecio');

            $checkboxes = $request->get('marcador');

            $contenidoPrecioDetalle = $request->get('contenidoPrecioDetalle');
            $cont = 0;
            while($cont < count($precio)){
                // $datosBooleanos = $checkboxes[$cont];
                if($checkboxes[$cont] === "1")
                {
                    $preciosDetalles = new PrecioDetalle();
                    $preciosDetalles->id_Estudio = $idEstudio[$cont];
                    $preciosDetalles->id_Precio =  $idPrecio[$cont];
                    $preciosDetalles->precio = $precio[$cont];
                    $preciosDetalles->sucursal = session('SUCURSAL');  
                    $preciosDetalles->save();
                 
                }
               if($checkboxes[$cont] === "0")
                {
                    $preciosDetalle = PrecioDetalle::find($request->get('idPrecioDetalle')[$cont]);
                    $preciosDetalle->id_Estudio = $idEstudio[$cont];
                    $preciosDetalle->id_Precio =  $idPrecio[$cont];
                    $preciosDetalle->precio = $precio[$cont];
                    $preciosDetalle->sucursal= session('SUCURSAL');  
                    $preciosDetalle->save();
                }
                if($checkboxes[$cont] === "0" && $precio[$cont] === "0")
                {
                    $preciosDetalle = PrecioDetalle::find($request->get('idPrecioDetalle')[$cont]);
                   
                    $preciosDetalle->delete();
                }
                $cont=$cont+1;
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        try{
            $precios = PrecioDetalle::find($id);
            $precios->delete();
            return redirect('/precio_detalle')->with('eliminar', 'Echo');
        }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
            //return $e->getMessage();
        }
    }
}
