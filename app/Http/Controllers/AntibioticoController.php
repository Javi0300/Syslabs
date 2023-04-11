<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antibiotico;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Exception;

class AntibioticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antibioticos = Antibiotico::all();
        return view('antibioticos.index')->with('antibioticos', $antibioticos);
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
        try
        {
            $Antibioticos = new Antibiotico();
            $Antibioticos->descripcion = $request->get('descripcion');
            $Antibioticos->save();
            return redirect('/antibioticos');
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $id =  Crypt::decrypt($id);
        return view('antibioticos.edit')->with([
            'antibiotico' => Antibiotico::findorFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $siemprehoy = Carbon::now();
        try{
            

        $Antibiotico = Antibiotico::find($id);

        $Antibiotico->descripcion = $request->get('descripcionEdit');
        $Antibiotico->save();
        return redirect('/antibioticos');
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
        try
        {
            $Antibiotico = Antibiotico::find($id);
            $Antibiotico->delete();
        }
        catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
        return redirect('/antibioticos')->with('eliminar', 'Echo');
    }
}
