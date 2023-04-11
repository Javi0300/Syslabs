<?php

namespace App\Imports;

use App\Models\PrecioDetalle;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;

class ListaImport implements ToModel,SkipsEmptyRows, WithHeadingRow, WithValidation,SkipsOnFailure
{
    use Importable,SkipsFailures;
    protected $idpdetalle;

    public function __construct(int $idpdetalle)
    {
        $this->idpdetalle = $idpdetalle;
    }
    
    public function model(array $row)
    {
        return new PrecioDetalle([
            //'idPrecioDetalle' => $row[0], //a
            'id_Precio' => $this->idpdetalle,
            'id_Estudio' => $row['id'],
            'precio' => $row['precio'],
            'sucursal' => session('SUCURSAL'),
            
        ]);
    }

    public function rules(): array
    {
        return [
            'precio' => [
                'required',
                'numeric',
            ],
        ];
    }
   
}