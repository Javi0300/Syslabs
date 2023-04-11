<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tomaxest;

class Tomaxests extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $actualizar, $editor_archivo, $editor_texto, $formula, $espaquete, $id_estxsol, $sucursal, $solicitud, $MuestraID, $Estudio, $Paquete, $Toma, $Fecha, $ClavePrueba, $Prueba, $Resultado, $Orden, $Estatus, $Importe, $DentroLimite, $Valores, $Medida, $TipoFormato, $autoanalizador, $Valmin, $ValMax, $TextoValores, $Hora, $word, $fecha_act, $fecha_sync, $flag_sucursales, $eliminar, $NombrePerfil, $altobajo, $antibiograma;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tomaxests.view', [
            'tomaxests' => Tomaxest::latest()
						->orWhere('actualizar', 'LIKE', $keyWord)
						->orWhere('editor_archivo', 'LIKE', $keyWord)
						->orWhere('editor_texto', 'LIKE', $keyWord)
						->orWhere('formula', 'LIKE', $keyWord)
						->orWhere('espaquete', 'LIKE', $keyWord)
						->orWhere('id_estxsol', 'LIKE', $keyWord)
						->orWhere('sucursal', 'LIKE', $keyWord)
						->orWhere('solicitud', 'LIKE', $keyWord)
						->orWhere('MuestraID', 'LIKE', $keyWord)
						->orWhere('Estudio', 'LIKE', $keyWord)
						->orWhere('Paquete', 'LIKE', $keyWord)
						->orWhere('Toma', 'LIKE', $keyWord)
						->orWhere('Fecha', 'LIKE', $keyWord)
						->orWhere('ClavePrueba', 'LIKE', $keyWord)
						->orWhere('Prueba', 'LIKE', $keyWord)
						->orWhere('Resultado', 'LIKE', $keyWord)
						->orWhere('Orden', 'LIKE', $keyWord)
						->orWhere('Estatus', 'LIKE', $keyWord)
						->orWhere('Importe', 'LIKE', $keyWord)
						->orWhere('DentroLimite', 'LIKE', $keyWord)
						->orWhere('Valores', 'LIKE', $keyWord)
						->orWhere('Medida', 'LIKE', $keyWord)
						->orWhere('TipoFormato', 'LIKE', $keyWord)
						->orWhere('autoanalizador', 'LIKE', $keyWord)
						->orWhere('Valmin', 'LIKE', $keyWord)
						->orWhere('ValMax', 'LIKE', $keyWord)
						->orWhere('TextoValores', 'LIKE', $keyWord)
						->orWhere('Hora', 'LIKE', $keyWord)
						->orWhere('word', 'LIKE', $keyWord)
						->orWhere('fecha_act', 'LIKE', $keyWord)
						->orWhere('fecha_sync', 'LIKE', $keyWord)
						->orWhere('flag_sucursales', 'LIKE', $keyWord)
						->orWhere('eliminar', 'LIKE', $keyWord)
						->orWhere('NombrePerfil', 'LIKE', $keyWord)
						->orWhere('altobajo', 'LIKE', $keyWord)
						->orWhere('antibiograma', 'LIKE', $keyWord)
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
		$this->actualizar = null;
		$this->editor_archivo = null;
		$this->editor_texto = null;
		$this->formula = null;
		$this->espaquete = null;
		$this->id_estxsol = null;
		$this->sucursal = null;
		$this->solicitud = null;
		$this->MuestraID = null;
		$this->Estudio = null;
		$this->Paquete = null;
		$this->Toma = null;
		$this->Fecha = null;
		$this->ClavePrueba = null;
		$this->Prueba = null;
		$this->Resultado = null;
		$this->Orden = null;
		$this->Estatus = null;
		$this->Importe = null;
		$this->DentroLimite = null;
		$this->Valores = null;
		$this->Medida = null;
		$this->TipoFormato = null;
		$this->autoanalizador = null;
		$this->Valmin = null;
		$this->ValMax = null;
		$this->TextoValores = null;
		$this->Hora = null;
		$this->word = null;
		$this->fecha_act = null;
		$this->fecha_sync = null;
		$this->flag_sucursales = null;
		$this->eliminar = null;
		$this->NombrePerfil = null;
		$this->altobajo = null;
		$this->antibiograma = null;
    }

    public function store()
    {
        $this->validate([
		'id_estxsol' => 'required',
		'sucursal' => 'required',
		'solicitud' => 'required',
		'MuestraID' => 'required',
		'Estudio' => 'required',
		'Toma' => 'required',
		'word' => 'required',
        ]);

        Tomaxest::create([ 
			'actualizar' => $this-> actualizar,
			'editor_archivo' => $this-> editor_archivo,
			'editor_texto' => $this-> editor_texto,
			'formula' => $this-> formula,
			'espaquete' => $this-> espaquete,
			'id_estxsol' => $this-> id_estxsol,
			'sucursal' => $this-> sucursal,
			'solicitud' => $this-> solicitud,
			'MuestraID' => $this-> MuestraID,
			'Estudio' => $this-> Estudio,
			'Paquete' => $this-> Paquete,
			'Toma' => $this-> Toma,
			'Fecha' => $this-> Fecha,
			'ClavePrueba' => $this-> ClavePrueba,
			'Prueba' => $this-> Prueba,
			'Resultado' => $this-> Resultado,
			'Orden' => $this-> Orden,
			'Estatus' => $this-> Estatus,
			'Importe' => $this-> Importe,
			'DentroLimite' => $this-> DentroLimite,
			'Valores' => $this-> Valores,
			'Medida' => $this-> Medida,
			'TipoFormato' => $this-> TipoFormato,
			'autoanalizador' => $this-> autoanalizador,
			'Valmin' => $this-> Valmin,
			'ValMax' => $this-> ValMax,
			'TextoValores' => $this-> TextoValores,
			'Hora' => $this-> Hora,
			'word' => $this-> word,
			'fecha_act' => $this-> fecha_act,
			'fecha_sync' => $this-> fecha_sync,
			'flag_sucursales' => $this-> flag_sucursales,
			'eliminar' => $this-> eliminar,
			'NombrePerfil' => $this-> NombrePerfil,
			'altobajo' => $this-> altobajo,
			'antibiograma' => $this-> antibiograma
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Tomaxest Successfully created.');
    }

    public function edit($id)
    {
        $record = Tomaxest::findOrFail($id);

        $this->selected_id = $id; 
		$this->actualizar = $record-> actualizar;
		$this->editor_archivo = $record-> editor_archivo;
		$this->editor_texto = $record-> editor_texto;
		$this->formula = $record-> formula;
		$this->espaquete = $record-> espaquete;
		$this->id_estxsol = $record-> id_estxsol;
		$this->sucursal = $record-> sucursal;
		$this->solicitud = $record-> solicitud;
		$this->MuestraID = $record-> MuestraID;
		$this->Estudio = $record-> Estudio;
		$this->Paquete = $record-> Paquete;
		$this->Toma = $record-> Toma;
		$this->Fecha = $record-> Fecha;
		$this->ClavePrueba = $record-> ClavePrueba;
		$this->Prueba = $record-> Prueba;
		$this->Resultado = $record-> Resultado;
		$this->Orden = $record-> Orden;
		$this->Estatus = $record-> Estatus;
		$this->Importe = $record-> Importe;
		$this->DentroLimite = $record-> DentroLimite;
		$this->Valores = $record-> Valores;
		$this->Medida = $record-> Medida;
		$this->TipoFormato = $record-> TipoFormato;
		$this->autoanalizador = $record-> autoanalizador;
		$this->Valmin = $record-> Valmin;
		$this->ValMax = $record-> ValMax;
		$this->TextoValores = $record-> TextoValores;
		$this->Hora = $record-> Hora;
		$this->word = $record-> word;
		$this->fecha_act = $record-> fecha_act;
		$this->fecha_sync = $record-> fecha_sync;
		$this->flag_sucursales = $record-> flag_sucursales;
		$this->eliminar = $record-> eliminar;
		$this->NombrePerfil = $record-> NombrePerfil;
		$this->altobajo = $record-> altobajo;
		$this->antibiograma = $record-> antibiograma;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'id_estxsol' => 'required',
		'sucursal' => 'required',
		'solicitud' => 'required',
		'MuestraID' => 'required',
		'Estudio' => 'required',
		'Toma' => 'required',
		'word' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Tomaxest::find($this->selected_id);
            $record->update([ 
			'actualizar' => $this-> actualizar,
			'editor_archivo' => $this-> editor_archivo,
			'editor_texto' => $this-> editor_texto,
			'formula' => $this-> formula,
			'espaquete' => $this-> espaquete,
			'id_estxsol' => $this-> id_estxsol,
			'sucursal' => $this-> sucursal,
			'solicitud' => $this-> solicitud,
			'MuestraID' => $this-> MuestraID,
			'Estudio' => $this-> Estudio,
			'Paquete' => $this-> Paquete,
			'Toma' => $this-> Toma,
			'Fecha' => $this-> Fecha,
			'ClavePrueba' => $this-> ClavePrueba,
			'Prueba' => $this-> Prueba,
			'Resultado' => $this-> Resultado,
			'Orden' => $this-> Orden,
			'Estatus' => $this-> Estatus,
			'Importe' => $this-> Importe,
			'DentroLimite' => $this-> DentroLimite,
			'Valores' => $this-> Valores,
			'Medida' => $this-> Medida,
			'TipoFormato' => $this-> TipoFormato,
			'autoanalizador' => $this-> autoanalizador,
			'Valmin' => $this-> Valmin,
			'ValMax' => $this-> ValMax,
			'TextoValores' => $this-> TextoValores,
			'Hora' => $this-> Hora,
			'word' => $this-> word,
			'fecha_act' => $this-> fecha_act,
			'fecha_sync' => $this-> fecha_sync,
			'flag_sucursales' => $this-> flag_sucursales,
			'eliminar' => $this-> eliminar,
			'NombrePerfil' => $this-> NombrePerfil,
			'altobajo' => $this-> altobajo,
			'antibiograma' => $this-> antibiograma
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Tomaxest Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Tomaxest::where('id', $id);
            $record->delete();
        }
    }
}
