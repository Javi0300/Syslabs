<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GehoOrdene;

class GehoOrdenes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $ordenGeho, $paterno, $materno, $nombre, $sexo, $fechaNacimiento, $edad, $edad_tipo, $fechaOrden, $sucursal, $estatus, $modificado, $folio, $expediente, $hospitalizacion, $cliente, $fechaSyslabs, $fechaGeho, $cama;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.gehoOrdenes.view', [
            'gehoOrdenes' => GehoOrdene::latest()
						->orWhere('ordenGeho', 'LIKE', $keyWord)
						->orWhere('paterno', 'LIKE', $keyWord)
						->orWhere('materno', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('sexo', 'LIKE', $keyWord)
						->orWhere('fechaNacimiento', 'LIKE', $keyWord)
						->orWhere('edad', 'LIKE', $keyWord)
						->orWhere('edad_tipo', 'LIKE', $keyWord)
						->orWhere('fechaOrden', 'LIKE', $keyWord)
						->orWhere('sucursal', 'LIKE', $keyWord)
						->orWhere('estatus', 'LIKE', $keyWord)
						->orWhere('modificado', 'LIKE', $keyWord)
						->orWhere('folio', 'LIKE', $keyWord)
						->orWhere('expediente', 'LIKE', $keyWord)
						->orWhere('hospitalizacion', 'LIKE', $keyWord)
						->orWhere('cliente', 'LIKE', $keyWord)
						->orWhere('fechaSyslabs', 'LIKE', $keyWord)
						->orWhere('fechaGeho', 'LIKE', $keyWord)
						->orWhere('cama', 'LIKE', $keyWord)
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
		$this->ordenGeho = null;
		$this->paterno = null;
		$this->materno = null;
		$this->nombre = null;
		$this->sexo = null;
		$this->fechaNacimiento = null;
		$this->edad = null;
		$this->edad_tipo = null;
		$this->fechaOrden = null;
		$this->sucursal = null;
		$this->estatus = null;
		$this->modificado = null;
		$this->folio = null;
		$this->expediente = null;
		$this->hospitalizacion = null;
		$this->cliente = null;
		$this->fechaSyslabs = null;
		$this->fechaGeho = null;
		$this->cama = null;
    }

    public function store()
    {
        $this->validate([
        ]);

        GehoOrdene::create([ 
			'ordenGeho' => $this-> ordenGeho,
			'paterno' => $this-> paterno,
			'materno' => $this-> materno,
			'nombre' => $this-> nombre,
			'sexo' => $this-> sexo,
			'fechaNacimiento' => $this-> fechaNacimiento,
			'edad' => $this-> edad,
			'edad_tipo' => $this-> edad_tipo,
			'fechaOrden' => $this-> fechaOrden,
			'sucursal' => $this-> sucursal,
			'estatus' => $this-> estatus,
			'modificado' => $this-> modificado,
			'folio' => $this-> folio,
			'expediente' => $this-> expediente,
			'hospitalizacion' => $this-> hospitalizacion,
			'cliente' => $this-> cliente,
			'fechaSyslabs' => $this-> fechaSyslabs,
			'fechaGeho' => $this-> fechaGeho,
			'cama' => $this-> cama
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'GehoOrdene Successfully created.');
    }

    public function edit($id)
    {
        $record = GehoOrdene::findOrFail($id);

        $this->selected_id = $id; 
		$this->ordenGeho = $record-> ordenGeho;
		$this->paterno = $record-> paterno;
		$this->materno = $record-> materno;
		$this->nombre = $record-> nombre;
		$this->sexo = $record-> sexo;
		$this->fechaNacimiento = $record-> fechaNacimiento;
		$this->edad = $record-> edad;
		$this->edad_tipo = $record-> edad_tipo;
		$this->fechaOrden = $record-> fechaOrden;
		$this->sucursal = $record-> sucursal;
		$this->estatus = $record-> estatus;
		$this->modificado = $record-> modificado;
		$this->folio = $record-> folio;
		$this->expediente = $record-> expediente;
		$this->hospitalizacion = $record-> hospitalizacion;
		$this->cliente = $record-> cliente;
		$this->fechaSyslabs = $record-> fechaSyslabs;
		$this->fechaGeho = $record-> fechaGeho;
		$this->cama = $record-> cama;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        ]);

        if ($this->selected_id) {
			$record = GehoOrdene::find($this->selected_id);
            $record->update([ 
			'ordenGeho' => $this-> ordenGeho,
			'paterno' => $this-> paterno,
			'materno' => $this-> materno,
			'nombre' => $this-> nombre,
			'sexo' => $this-> sexo,
			'fechaNacimiento' => $this-> fechaNacimiento,
			'edad' => $this-> edad,
			'edad_tipo' => $this-> edad_tipo,
			'fechaOrden' => $this-> fechaOrden,
			'sucursal' => $this-> sucursal,
			'estatus' => $this-> estatus,
			'modificado' => $this-> modificado,
			'folio' => $this-> folio,
			'expediente' => $this-> expediente,
			'hospitalizacion' => $this-> hospitalizacion,
			'cliente' => $this-> cliente,
			'fechaSyslabs' => $this-> fechaSyslabs,
			'fechaGeho' => $this-> fechaGeho,
			'cama' => $this-> cama
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'GehoOrdene Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = GehoOrdene::where('id', $id);
            $record->delete();
        }
    }
}
