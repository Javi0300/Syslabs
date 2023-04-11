<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'paquetes';

    protected $fillable = ['idPaquete','Abreviatura','Descripcion','indicaciones','notas_internas','Dias','Horas','Minutos'];
	
    protected $primaryKey = 'idPaquete';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paqueteDetalles()
    {
        return $this->hasMany('App\Models\PaqueteDetalle', 'id_Paquete', 'idPaquete');
    }
    
}
