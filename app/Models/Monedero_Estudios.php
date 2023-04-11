<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monedero_Estudios extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'monedero_estudios_exclusiones';

    protected $fillable = ['sucursal','id_estudio'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudio()
    {
        return $this->hasOne('App\Models\Estudio', 'idEstudio', 'id_estudio');
    }
    
}
