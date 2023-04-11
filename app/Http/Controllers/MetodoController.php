<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\Metodo;

class MetodoController extends Controller
{

    public function index()
    {
        /* if(User::where('email', $email)->count() > 0){
            #code
        } */
        
        $metodos = Metodo::all();
        return view('metodos.index')->with('metodos', $metodos);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /* try{ */

            /* $request->validate([
                'descripcion' => 'required',
            ]); */
            request()->validate([
                'descripcion' => ['required']
            ], [
                'descripcion' => 'El campo de descripción es necesario.'
            ]);
            $metodos = new Metodo();
            $metodos->descripcion = $request->get('descripcion');
            $metodos->save();
            return redirect('metodos');
        /* }
        catch(Exception $e)
        {
            return back()->with('error', $e->getMessage());
        } */
    }
    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $id =  Crypt::decrypt($id);
        $metodo = Metodo::findorFail($id);
        return view('metodos/index')->with('metodo', $metodo);
        /* $where = array('id' => $request->id);
        $metodos  = Metodo::where($where)->first();
      
        return Response()->json($metodos); */
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
        try{
            $id =  Crypt::decrypt($id);
            $metodo = Metodo::find($id);
            $metodo->descripcion = $request->get('Descripcion');
            $metodo->save();
            return redirect('metodos');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
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
            if(DB::select('SELECT * FROM pruebas WHERE id_Metodo = ?', [$id]))
            {
                return redirect('/metodos')->with('pruebas', 'Este método esta registrado en una prueba.');
            }
            $metodo = Metodo::find($id);
            $metodo->delete();
            return redirect('/metodos')->with('eliminar', 'Echo');
        }
        catch(Exception $e)
        {
            return back()->with('integrityviolation', $e->getMessage());
        }
    }
}
