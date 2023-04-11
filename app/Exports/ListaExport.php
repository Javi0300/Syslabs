<?php

namespace App\Exports;

use App\Models\PrecioDetalle;
use App\Models\Estudio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormattng;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;

class ListaExport implements /*FromCollection,WithHeadings,ShouldAutoSize,WithEvents*/ FromView 
{
    use Exportable;
    public function view(): View
    {
        return view('exports.lista', [
            'invoices' => DB::select('SELECT deptos.Depto,  estudios.espaquete, estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio, precios_detalle.id_Precio, precios_detalle.sucursal FROM estudios
            LEFT JOIN precios_detalle ON (estudios.idEstudio = precios_detalle.id_Estudio AND precios_detalle.id_Precio = ? AND precios_detalle.sucursal = estudios.sucursal)
            INNER JOIN deptos ON estudios.depto=deptos.id
            WHERE estudios.sucursal = ?', [session('idPrecioDetalle'), session('SUCURSAL')])
        ]);
    }

   /*  public function headings(): array
    {
        return [
            'ID',
            'Departamento',
            'Estudio/Paquete',
            'Precio',
        ];
    }

    public function collection()
    {
        return Estudio::select('estudios.idEstudio', 'deptos.Depto', 'estudios.Nombre as nombreEstudio', 'precios_detalle.precio')
        ->leftJoin('precios_detalle', function($join) {
            $join->on('estudios.idEstudio', '=', 'precios_detalle.id_Estudio')
                ->where('precios_detalle.id_Precio', '=', 16)
                ->where('precios_detalle.sucursal', '=', 'estudios.sucursal');
        })
        ->join('deptos', 'estudios.depto', '=', 'deptos.id')
        ->where('estudios.sucursal', '=', session('SUCURSAL'))
        ->get();
    }
    public function registerEvents(): array
    {
        //$excel->sheet->setSelectedCells('A1', 'B1')->protect();

        return [
            AfterSheet::class => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('DD4B39');
                
                $event->sheet->setSelectedCells('A1', 'D1')->getProtection();
            },
        ];
    } */
    
   /*  public function defaultStyles(Style $defaultStyle)
    {
    
        // Or return the styles array
        return [
            'A' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::RED],
            ],
        ];
    } */
    
   /*  public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            
        ];
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('\img\logo_syslabs_Horizontal.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B3');

        return $drawing;
    } */
}
