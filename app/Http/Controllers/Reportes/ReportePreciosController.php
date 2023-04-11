<?php

namespace App\Http\Controllers\Reportes;

use App\Models\solicitud;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\PrecioDetalle;

class ReportePreciosController extends Controller
{
    public function reportePDF()
    {
        $detalles = DB::select('SELECT deptos.Depto,  estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
        LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
        INNER JOIN deptos ON estudios.depto=deptos.id
        WHERE estudios.sucursal = ?
        ORDER BY  deptos.Depto', [session('idPrecioDetalle'), session('SUCURSAL')]);
       $cfdi = DB::table('cfdi_parametros')->select('CFDIRFC','CFDITEL','CFDIFCALLE', 'CFDIFNEXT', 'CFDIFNINT','CFDIFCOL','CFDISUCURSAL','CFDIFPAIS', 'CFDIFESTADO', 'CFDIFMUNICIPIO')
       ->where('id','=','1')->first();

        $siemprehoy = Carbon::now()->toDateString();
        $actualhora = Carbon::now()->isoFormat('H:mm:ss A');

            $fpdf = new headerfooter('L','mm',array(140,216));  //Media Carta
            $fpdf->AliasNbPages(); 
            $fpdf->AddPage();


        foreach ($detalles as $detalle)
        {
            if($detalle->espaquete === "1")
            {
                $fpdf->cell(60,6,utf8_decode("PAQUETE "."/ ". $detalle->Depto),0,false,'R');
            }
            if($detalle->espaquete === "0")
            {
                $fpdf->cell(60,6,utf8_decode("ESTUDIO "."/ ".$detalle->Depto),0,false,'R');
            }
            $fpdf->cell(60,6,utf8_decode($detalle->nombreEstudio),0,false);
            $fpdf->cell(60,6,utf8_decode("$ ".number_format($detalle->precio,2, '.')),0,false);
            //$fpdf->Cell(20, 6, utf8_decode($detalle->precio),0,0,'R');
            $fpdf->Ln(4);

        }

        $fpdf->Output();
        exit;
    }

}