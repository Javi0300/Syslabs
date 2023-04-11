<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tomaxest extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tomaxest';

    protected $fillable = ['actualizar','editor_archivo','editor_texto','formula','espaquete','id_estxsol','sucursal','solicitud','MuestraID','Estudio','Paquete','Toma','Fecha','ClavePrueba','Prueba','Resultado','Orden','Estatus','Importe','DentroLimite','Valores','Medida','TipoFormato','autoanalizador','Valmin','ValMax','TextoValores','Hora','word','fecha_act','fecha_sync','flag_sucursales','eliminar','NombrePerfil','altobajo','antibiograma'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function antibiogramas()
    {
        return $this->hasMany('App\Models\Antibiograma', 'id_tomaxest', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estxsol()
    {
        return $this->hasOne('App\Models\Estxsol', 'idEstxSol', 'id_estxsol');
    }
    
}
