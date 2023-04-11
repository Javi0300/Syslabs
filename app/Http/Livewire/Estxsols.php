<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estxsol;

class Estxsols extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $idEstxSol, $id_solicitud, $id_estudio, $sucursal, $Depto, $MuestraId, $Tomas, $Faltantes, $Importe, $Estatus, $Observaciones, $Fecha, $Imprimir, $Tubo, $abreviatura, $TipoFormato, $Noaplicadescuento, $VerificadoPor, $Publicado, $WordPDF, $Precio, $Iva, $ivaprct, $descimpte, $descprct, $GrupoPerfil, $EsPerfil, $fecha_act, $fecha_sync, $flag_sucursales, $eliminar, $NombrePerfil, $nombrepaciente;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.estxsols.view', [
            'estxsols' => Estxsol::latest()
						->orWhere('idEstxSol', 'LIKE', $keyWord)
						->orWhere('id_solicitud', 'LIKE', $keyWord)
						->orWhere('id_estudio', 'LIKE', $keyWord)
						->orWhere('sucursal', 'LIKE', $keyWord)
						->orWhere('Depto', 'LIKE', $keyWord)
						->orWhere('MuestraId', 'LIKE', $keyWord)
						->orWhere('Tomas', 'LIKE', $keyWord)
						->orWhere('Faltantes', 'LIKE', $keyWord)
						->orWhere('Importe', 'LIKE', $keyWord)
						->orWhere('Estatus', 'LIKE', $keyWord)
						->orWhere('Observaciones', 'LIKE', $keyWord)
						->orWhere('Fecha', 'LIKE', $keyWord)
						->orWhere('Imprimir', 'LIKE', $keyWord)
						->orWhere('Tubo', 'LIKE', $keyWord)
						->orWhere('abreviatura', 'LIKE', $keyWord)
						->orWhere('TipoFormato', 'LIKE', $keyWord)
						->orWhere('Noaplicadescuento', 'LIKE', $keyWord)
						->orWhere('VerificadoPor', 'LIKE', $keyWord)
						->orWhere('Publicado', 'LIKE', $keyWord)
						->orWhere('WordPDF', 'LIKE', $keyWord)
						->orWhere('Precio', 'LIKE', $keyWord)
						->orWhere('Iva', 'LIKE', $keyWord)
						->orWhere('ivaprct', 'LIKE', $keyWord)
						->orWhere('descimpte', 'LIKE', $keyWord)
						->orWhere('descprct', 'LIKE', $keyWord)
						->orWhere('GrupoPerfil', 'LIKE', $keyWord)
						->orWhere('EsPerfil', 'LIKE', $keyWord)
						->orWhere('fecha_act', 'LIKE', $keyWord)
						->orWhere('fecha_sync', 'LIKE', $keyWord)
						->orWhere('flag_sucursales', 'LIKE', $keyWord)
						->orWhere('eliminar', 'LIKE', $keyWord)
						->orWhere('NombrePerfil', 'LIKE', $keyWord)
						->orWhere('nombrepaciente', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->idEstxSol = null;
		$this->id_solicitud = null;
		$this->id_estudio = null;
		$this->sucursal = null;
		$this->Depto = null;
		$this->MuestraId = null;
		$this->Tomas = null;
		$this->Faltantes = null;
		$this->Importe = null;
		$this->Estatus = null;
		$this->Observaciones = null;
		$this->Fecha = null;
		$this->Imprimir = null;
		$this->Tubo = null;
		$this->abreviatura = null;
		$this->TipoFormato = null;
		$this->Noaplicadescuento = null;
		$this->VerificadoPor = null;
		$this->Publicado = null;
		$this->WordPDF = null;
		$this->Precio = null;
		$this->Iva = null;
		$this->ivaprct = null;
		$this->descimpte = null;
		$this->descprct = null;
		$this->GrupoPerfil = null;
		$this->EsPerfil = null;
		$this->fecha_act = null;
		$this->fecha_sync = null;
		$this->flag_sucursales = null;
		$this->eliminar = null;
		$this->NombrePerfil = null;
		$this->nombrepaciente = null;
    }

    public function store()
    {
        $this->validate([
		'idEstxSol' => 'required',
		'id_solicitud' => 'required',
		'id_estudio' => 'required',
		'sucursal' => 'required',
		'Depto' => 'required',
		'MuestraId' => 'required',
		'Tomas' => 'required',
        ]);

        Estxsol::create([ 
			'idEstxSol' => $this-> idEstxSol,
			'id_solicitud' => $this-> id_solicitud,
			'id_estudio' => $this-> id_estudio,
			'sucursal' => $this-> sucursal,
			'Depto' => $this-> Depto,
			'MuestraId' => $this-> MuestraId,
			'Tomas' => $this-> Tomas,
			'Faltantes' => $this-> Faltantes,
			'Importe' => $this-> Importe,
			'Estatus' => $this-> Estatus,
			'Observaciones' => $this-> Observaciones,
			'Fecha' => $this-> Fecha,
			'Imprimir' => $this-> Imprimir,
			'Tubo' => $this-> Tubo,
			'abreviatura' => $this-> abreviatura,
			'TipoFormato' => $this-> TipoFormato,
			'Noaplicadescuento' => $this-> Noaplicadescuento,
			'VerificadoPor' => $this-> VerificadoPor,
			'Publicado' => $this-> Publicado,
			'WordPDF' => $this-> WordPDF,
			'Precio' => $this-> Precio,
			'Iva' => $this-> Iva,
			'ivaprct' => $this-> ivaprct,
			'descimpte' => $this-> descimpte,
			'descprct' => $this-> descprct,
			'GrupoPerfil' => $this-> GrupoPerfil,
			'EsPerfil' => $this-> EsPerfil,
			'fecha_act' => $this-> fecha_act,
			'fecha_sync' => $this-> fecha_sync,
			'flag_sucursales' => $this-> flag_sucursales,
			'eliminar' => $this-> eliminar,
			'NombrePerfil' => $this-> NombrePerfil,
			'nombrepaciente' => $this-> nombrepaciente
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Estxsol Successfully created.');
    }

    public function edit($id)
    {
        $record = Estxsol::findOrFail($id);

        $this->selected_id = $id; 
		$this->idEstxSol = $record-> idEstxSol;
		$this->id_solicitud = $record-> id_solicitud;
		$this->id_estudio = $record-> id_estudio;
		$this->sucursal = $record-> sucursal;
		$this->Depto = $record-> Depto;
		$this->MuestraId = $record-> MuestraId;
		$this->Tomas = $record-> Tomas;
		$this->Faltantes = $record-> Faltantes;
		$this->Importe = $record-> Importe;
		$this->Estatus = $record-> Estatus;
		$this->Observaciones = $record-> Observaciones;
		$this->Fecha = $record-> Fecha;
		$this->Imprimir = $record-> Imprimir;
		$this->Tubo = $record-> Tubo;
		$this->abreviatura = $record-> abreviatura;
		$this->TipoFormato = $record-> TipoFormato;
		$this->Noaplicadescuento = $record-> Noaplicadescuento;
		$this->VerificadoPor = $record-> VerificadoPor;
		$this->Publicado = $record-> Publicado;
		$this->WordPDF = $record-> WordPDF;
		$this->Precio = $record-> Precio;
		$this->Iva = $record-> Iva;
		$this->ivaprct = $record-> ivaprct;
		$this->descimpte = $record-> descimpte;
		$this->descprct = $record-> descprct;
		$this->GrupoPerfil = $record-> GrupoPerfil;
		$this->EsPerfil = $record-> EsPerfil;
		$this->fecha_act = $record-> fecha_act;
		$this->fecha_sync = $record-> fecha_sync;
		$this->flag_sucursales = $record-> flag_sucursales;
		$this->eliminar = $record-> eliminar;
		$this->NombrePerfil = $record-> NombrePerfil;
		$this->nombrepaciente = $record-> nombrepaciente;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'idEstxSol' => 'required',
		'id_solicitud' => 'required',
		'id_estudio' => 'required',
		'sucursal' => 'required',
		'Depto' => 'required',
		'MuestraId' => 'required',
		'Tomas' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Estxsol::find($this->selected_id);
            $record->update([ 
			'idEstxSol' => $this-> idEstxSol,
			'id_solicitud' => $this-> id_solicitud,
			'id_estudio' => $this-> id_estudio,
			'sucursal' => $this-> sucursal,
			'Depto' => $this-> Depto,
			'MuestraId' => $this-> MuestraId,
			'Tomas' => $this-> Tomas,
			'Faltantes' => $this-> Faltantes,
			'Importe' => $this-> Importe,
			'Estatus' => $this-> Estatus,
			'Observaciones' => $this-> Observaciones,
			'Fecha' => $this-> Fecha,
			'Imprimir' => $this-> Imprimir,
			'Tubo' => $this-> Tubo,
			'abreviatura' => $this-> abreviatura,
			'TipoFormato' => $this-> TipoFormato,
			'Noaplicadescuento' => $this-> Noaplicadescuento,
			'VerificadoPor' => $this-> VerificadoPor,
			'Publicado' => $this-> Publicado,
			'WordPDF' => $this-> WordPDF,
			'Precio' => $this-> Precio,
			'Iva' => $this-> Iva,
			'ivaprct' => $this-> ivaprct,
			'descimpte' => $this-> descimpte,
			'descprct' => $this-> descprct,
			'GrupoPerfil' => $this-> GrupoPerfil,
			'EsPerfil' => $this-> EsPerfil,
			'fecha_act' => $this-> fecha_act,
			'fecha_sync' => $this-> fecha_sync,
			'flag_sucursales' => $this-> flag_sucursales,
			'eliminar' => $this-> eliminar,
			'NombrePerfil' => $this-> NombrePerfil,
			'nombrepaciente' => $this-> nombrepaciente
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Estxsol Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Estxsol::where('id', $id);
            $record->delete();
        }
    }
}
