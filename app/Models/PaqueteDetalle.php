<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteDetalle extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'paquete_detalle';

    protected $fillable = ['idPaqueteDetalle','id_Estudio','id_estudio_detalle','esseparador','Estudio', 'Orden', 'sucursal'];
	
    protected $primaryKey = 'idPaqueteDetalle';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudio()
    {
        return $this->hasOne('App\Models\Estudio', 'idEstudio', 'id_Estudio');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paquete()
    {
        return $this->hasOne('App\Models\Paquete', 'idPaquete', 'id_Paquete');
    }
    
}
