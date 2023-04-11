<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antibiotico extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'antibioticos';

    protected $fillable = ['idAntibiotico','descripcion', 'sucursal'];
    
    protected $primaryKey = 'idAntibiotico';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleGrupoAntibioticos()
    {
        return $this->hasMany('App\Models\DetalleGrupoAntibiotico', 'id_Antibiotico', 'idAntibiotico');
    }
    
}
