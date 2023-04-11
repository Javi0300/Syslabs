<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Formato;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public function tablaFormatos(Request $request)
    {
        $position = 1;
        $sorts = $request->get('sorts');

        foreach($sorts as $sort){
            $tabla_formatos = Formato::find($sort);
            $tabla_formatos->Orden = $position;
            $tabla_formatos->save();
            $position++;
        }

    }
}
