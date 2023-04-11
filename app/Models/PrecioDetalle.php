<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioDetalle extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'precios_detalle';

    protected $fillable = ['idPrecioDetalle','id_Precio','id_Estudio','sucursal','precio'];
	
    protected $primaryKey = 'idPrecioDetalle';
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
    public function precio()
    {
        return $this->hasOne('App\Models\Precio', 'idPrecio', 'id_Precio');
    }
    
}
