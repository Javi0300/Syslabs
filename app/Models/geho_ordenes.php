<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class geho_ordenes extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'geho_ordenes';

    protected $fillable = ['ordenGeho','paterno','materno','nombre','sexo','fechaNacimiento','edad','edad_tipo','fechaOrden','sucursal','estatus','modificado','folio','expediente','hospitalizacion','cliente','fechaSyslabs','fechaGeho','cama'];
	
}
