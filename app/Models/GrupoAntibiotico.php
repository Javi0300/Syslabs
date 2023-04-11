<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAntibiotico extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'grupo_antibioticos';

    protected $fillable = ['idGrupoAntibiotico','descripcion', 'sucursal'];
	
    protected $primaryKey = 'idGrupoAntibiotico';

    public function detalleGrupoAntibioticos()
    {
        return $this->hasMany('App\Models\DetalleGrupoAntibiotico', 'id_GrupoAntibiotico', 'idGrupoAntibiotico');
    }
    
}
