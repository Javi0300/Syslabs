<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleGrupoAntibiotico extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'detalle_grupo_antibioticos';

    protected $fillable = ['idDetalleGrupoAntibiotico','id_GrupoAntibiotico','id_Antibiotico', 'sucursal'];
	

    protected $primaryKey = 'idDetalleGrupoAntibiotico';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function antibiotico()
    {
        return $this->hasOne('App\Models\Antibiotico', 'idAntibiotico', 'id_Antibiotico');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function grupoAntibiotico()
    {
        return $this->hasOne('App\Models\GrupoAntibiotico', 'idGrupoAntibiotico', 'id_GrupoAntibiotico');
    }
    
}
