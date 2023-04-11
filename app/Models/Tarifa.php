<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tarifas';

    protected $fillable = ['idtarifa','id_empresa','id_estudio','sucursal','tarifa','Tarifa2','Marcada','fecha_act','fecha_sync','flag_sucursales','eliminar'];
	
    protected $primaryKey = 'idtarifa';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'idEmpresa', 'id_empresa');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudio()
    {
        return $this->hasOne('App\Models\Estudio', 'idEstudio', 'id_estudio');
    }
    
}
