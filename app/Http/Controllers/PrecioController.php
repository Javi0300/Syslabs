<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Tarifa;
use App\Models\Precio;
use App\Models\PrecioDetalle;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PrecioController extends Controller
{
    public function index()
    {
        $precios = DB::select('SELECT * FROM precios WHERE sucursal = ?', [session('SUCURSAL')]);
        return view('precios.index', ['precios'=>$precios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $precios = new Precio();
        $precios->Abreviatura = $request->get('CreateAbreviatura');
        $precios->Descripcion = $request->get('nombreCreateEmpresa');
        //$precios->Predeterminado = $request->get('CreatePredeterminado');
        $precios->sucursal = session('SUCURSAL');
        $precios->save();

        return redirect('precios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $id =  Crypt::decrypt($id);
        $cantidadEstudios = DB::select('SELECT COUNT(*) AS Estudios FROM estudios WHERE sucursal = ?', [session('SUCURSAL')]);
       

        /* $cont = 0;
        while($cont < count($cantidadEstudios))
        {
            $preciosDetalle = new PrecioDetalle();
            $preciosDetalle->id_Precio = $request->get('iptidPrecio');
            $preciosDetalle->sucursal= session('SUCURSAL');  
            $preciosDetalle->save();
            $cont=$cont+1;
        }

        for ($i = 1; $i <=10; $i++){
            // 5 * $i = 5 * $i;
        } */

        $numero = 0;
        $preciosdetalle = DB::select('SELECT estudios.idEstudio, estudios.Nombre AS nombreEstudio, precios_detalle.idPrecioDetalle, precios_detalle.precio FROM estudios
        LEFT JOIN precios_detalle ON estudios.idEstudio = precios_detalle.id_Estudio WHERE id_Precio = ?', [$id]);
        return view('precios_detalle.index')
        ->with([
            'preciosdetalle'=>$preciosdetalle,

            'sumatoria' => $numero
        ]);
    }

    public function edit($id)
    {
        
    }

    public function configurar()
    {

    }
    public function update(Request $request, $id)
    {
        $precio = Precio::find($id);
        $precio->Abreviatura = $request->get('UpdateAbreviatura');
        $precio->Descripcion = $request->get('nombreUpdateEmpresa');
        //$precios->Predeterminado = $request->get('CreatePredeterminado');
        $precio->sucursal = session('SUCURSAL');
        $precio->save();

        return redirect('precios');
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
            $precios = Precio::find($id);
            $precios->delete();
            return redirect('/precios')->with('eliminar', 'Echo');
        }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
            //return $e->getMessage();
        }
    }
}
