<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'precios';

    protected $fillable = ['idPrecio','Abreviatura','Descripcion','sucursal'];
	
    protected $primaryKey = 'idPrecio';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function precioDetalles()
    {
        return $this->hasMany('App\Models\PrecioDetalle', 'id_Precio', 'idPrecio');
    }
    
}
