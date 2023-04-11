<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estudio;

class Estudios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $idEstudio, $ColorTitulo, $AlineacionTitulo, $Notas_Internas, $Indicaciones, $Sexo, $ventaindividual, $Codigo, $Descripcion, $Dias, $Horas, $Minutos, $depto, $sucursal, $Nombre, $Abreviatura, $Tomas, $Frecuencia, $Tipoformato, $Notas, $TiempoProceso, $TipoMuestra, $Instrucciones, $DatosTecnicos, $Encabezado, $Tubo, $Noaplicadescuento, $espaquete, $fecha_act, $fecha_sync, $flag_sucursales, $eliminar, $SucProceso;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.estudios.view', [
            'estudios' => Estudio::latest()
						->orWhere('idEstudio', 'LIKE', $keyWord)
						->orWhere('ColorTitulo', 'LIKE', $keyWord)
						->orWhere('AlineacionTitulo', 'LIKE', $keyWord)
						->orWhere('Notas_Internas', 'LIKE', $keyWord)
						->orWhere('Indicaciones', 'LIKE', $keyWord)
						->orWhere('Sexo', 'LIKE', $keyWord)
						->orWhere('ventaindividual', 'LIKE', $keyWord)
						->orWhere('Codigo', 'LIKE', $keyWord)
						->orWhere('Descripcion', 'LIKE', $keyWord)
						->orWhere('Dias', 'LIKE', $keyWord)
						->orWhere('Horas', 'LIKE', $keyWord)
						->orWhere('Minutos', 'LIKE', $keyWord)
						->orWhere('depto', 'LIKE', $keyWord)
						->orWhere('sucursal', 'LIKE', $keyWord)
						->orWhere('Nombre', 'LIKE', $keyWord)
						->orWhere('Abreviatura', 'LIKE', $keyWord)
						->orWhere('Tomas', 'LIKE', $keyWord)
						->orWhere('Frecuencia', 'LIKE', $keyWord)
						->orWhere('Tipoformato', 'LIKE', $keyWord)
						->orWhere('Notas', 'LIKE', $keyWord)
						->orWhere('TiempoProceso', 'LIKE', $keyWord)
						->orWhere('TipoMuestra', 'LIKE', $keyWord)
						->orWhere('Instrucciones', 'LIKE', $keyWord)
						->orWhere('DatosTecnicos', 'LIKE', $keyWord)
						->orWhere('Encabezado', 'LIKE', $keyWord)
						->orWhere('Tubo', 'LIKE', $keyWord)
						->orWhere('Noaplicadescuento', 'LIKE', $keyWord)
						->orWhere('espaquete', 'LIKE', $keyWord)
						->orWhere('fecha_act', 'LIKE', $keyWord)
						->orWhere('fecha_sync', 'LIKE', $keyWord)
						->orWhere('flag_sucursales', 'LIKE', $keyWord)
						->orWhere('eliminar', 'LIKE', $keyWord)
						->orWhere('SucProceso', 'LIKE', $keyWord)
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
		$this->idEstudio = null;
		$this->ColorTitulo = null;
		$this->AlineacionTitulo = null;
		$this->Notas_Internas = null;
		$this->Indicaciones = null;
		$this->Sexo = null;
		$this->ventaindividual = null;
		$this->Codigo = null;
		$this->Descripcion = null;
		$this->Dias = null;
		$this->Horas = null;
		$this->Minutos = null;
		$this->depto = null;
		$this->sucursal = null;
		$this->Nombre = null;
		$this->Abreviatura = null;
		$this->Tomas = null;
		$this->Frecuencia = null;
		$this->Tipoformato = null;
		$this->Notas = null;
		$this->TiempoProceso = null;
		$this->TipoMuestra = null;
		$this->Instrucciones = null;
		$this->DatosTecnicos = null;
		$this->Encabezado = null;
		$this->Tubo = null;
		$this->Noaplicadescuento = null;
		$this->espaquete = null;
		$this->fecha_act = null;
		$this->fecha_sync = null;
		$this->flag_sucursales = null;
		$this->eliminar = null;
		$this->SucProceso = null;
    }

    public function store()
    {
        $this->validate([
		'idEstudio' => 'required',
		'depto' => 'required',
		'sucursal' => 'required',
		'Nombre' => 'required',
		'espaquete' => 'required',
		'eliminar' => 'required',
		'SucProceso' => 'required',
        ]);

        Estudio::create([ 
			'idEstudio' => $this-> idEstudio,
			'ColorTitulo' => $this-> ColorTitulo,
			'AlineacionTitulo' => $this-> AlineacionTitulo,
			'Notas_Internas' => $this-> Notas_Internas,
			'Indicaciones' => $this-> Indicaciones,
			'Sexo' => $this-> Sexo,
			'ventaindividual' => $this-> ventaindividual,
			'Codigo' => $this-> Codigo,
			'Descripcion' => $this-> Descripcion,
			'Dias' => $this-> Dias,
			'Horas' => $this-> Horas,
			'Minutos' => $this-> Minutos,
			'depto' => $this-> depto,
			'sucursal' => $this-> sucursal,
			'Nombre' => $this-> Nombre,
			'Abreviatura' => $this-> Abreviatura,
			'Tomas' => $this-> Tomas,
			'Frecuencia' => $this-> Frecuencia,
			'Tipoformato' => $this-> Tipoformato,
			'Notas' => $this-> Notas,
			'TiempoProceso' => $this-> TiempoProceso,
			'TipoMuestra' => $this-> TipoMuestra,
			'Instrucciones' => $this-> Instrucciones,
			'DatosTecnicos' => $this-> DatosTecnicos,
			'Encabezado' => $this-> Encabezado,
			'Tubo' => $this-> Tubo,
			'Noaplicadescuento' => $this-> Noaplicadescuento,
			'espaquete' => $this-> espaquete,
			'fecha_act' => $this-> fecha_act,
			'fecha_sync' => $this-> fecha_sync,
			'flag_sucursales' => $this-> flag_sucursales,
			'eliminar' => $this-> eliminar,
			'SucProceso' => $this-> SucProceso
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Estudio Successfully created.');
    }

    public function edit($id)
    {
        $record = Estudio::findOrFail($id);

        $this->selected_id = $id; 
		$this->idEstudio = $record-> idEstudio;
		$this->ColorTitulo = $record-> ColorTitulo;
		$this->AlineacionTitulo = $record-> AlineacionTitulo;
		$this->Notas_Internas = $record-> Notas_Internas;
		$this->Indicaciones = $record-> Indicaciones;
		$this->Sexo = $record-> Sexo;
		$this->ventaindividual = $record-> ventaindividual;
		$this->Codigo = $record-> Codigo;
		$this->Descripcion = $record-> Descripcion;
		$this->Dias = $record-> Dias;
		$this->Horas = $record-> Horas;
		$this->Minutos = $record-> Minutos;
		$this->depto = $record-> depto;
		$this->sucursal = $record-> sucursal;
		$this->Nombre = $record-> Nombre;
		$this->Abreviatura = $record-> Abreviatura;
		$this->Tomas = $record-> Tomas;
		$this->Frecuencia = $record-> Frecuencia;
		$this->Tipoformato = $record-> Tipoformato;
		$this->Notas = $record-> Notas;
		$this->TiempoProceso = $record-> TiempoProceso;
		$this->TipoMuestra = $record-> TipoMuestra;
		$this->Instrucciones = $record-> Instrucciones;
		$this->DatosTecnicos = $record-> DatosTecnicos;
		$this->Encabezado = $record-> Encabezado;
		$this->Tubo = $record-> Tubo;
		$this->Noaplicadescuento = $record-> Noaplicadescuento;
		$this->espaquete = $record-> espaquete;
		$this->fecha_act = $record-> fecha_act;
		$this->fecha_sync = $record-> fecha_sync;
		$this->flag_sucursales = $record-> flag_sucursales;
		$this->eliminar = $record-> eliminar;
		$this->SucProceso = $record-> SucProceso;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'idEstudio' => 'required',
		'depto' => 'required',
		'sucursal' => 'required',
		'Nombre' => 'required',
		'espaquete' => 'required',
		'eliminar' => 'required',
		'SucProceso' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Estudio::find($this->selected_id);
            $record->update([ 
			'idEstudio' => $this-> idEstudio,
			'ColorTitulo' => $this-> ColorTitulo,
			'AlineacionTitulo' => $this-> AlineacionTitulo,
			'Notas_Internas' => $this-> Notas_Internas,
			'Indicaciones' => $this-> Indicaciones,
			'Sexo' => $this-> Sexo,
			'ventaindividual' => $this-> ventaindividual,
			'Codigo' => $this-> Codigo,
			'Descripcion' => $this-> Descripcion,
			'Dias' => $this-> Dias,
			'Horas' => $this-> Horas,
			'Minutos' => $this-> Minutos,
			'depto' => $this-> depto,
			'sucursal' => $this-> sucursal,
			'Nombre' => $this-> Nombre,
			'Abreviatura' => $this-> Abreviatura,
			'Tomas' => $this-> Tomas,
			'Frecuencia' => $this-> Frecuencia,
			'Tipoformato' => $this-> Tipoformato,
			'Notas' => $this-> Notas,
			'TiempoProceso' => $this-> TiempoProceso,
			'TipoMuestra' => $this-> TipoMuestra,
			'Instrucciones' => $this-> Instrucciones,
			'DatosTecnicos' => $this-> DatosTecnicos,
			'Encabezado' => $this-> Encabezado,
			'Tubo' => $this-> Tubo,
			'Noaplicadescuento' => $this-> Noaplicadescuento,
			'espaquete' => $this-> espaquete,
			'fecha_act' => $this-> fecha_act,
			'fecha_sync' => $this-> fecha_sync,
			'flag_sucursales' => $this-> flag_sucursales,
			'eliminar' => $this-> eliminar,
			'SucProceso' => $this-> SucProceso
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Estudio Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Estudio::where('id', $id);
            $record->delete();
        }
    }
}
