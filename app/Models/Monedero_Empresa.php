<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monedero_Empresa extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'monedero_empresas';

    protected $fillable = ['sucursal','id_empresa'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'idEmpresa', 'id_empresa');
    }
    
}
