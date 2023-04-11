<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'sucursales';

    protected $fillable = ['idSucursal','descripcion','flag_sync','propagar','sync_tablas','bloquea_edicion','lic_autorizado','fecha_act','fecha_sync',
    'flag_sucursales','eliminar'];
    
    protected $primarykey = 'idSucursal';
}
