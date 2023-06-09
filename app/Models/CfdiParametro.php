<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CfdiParametro extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cfdi_parametros';

    protected $fillable = ['CFDISUCURSAL','CFDIRFC','CFDIRAZON','CFDITEL','CFDIMAIL','CFDIWEB','CFDIFCALLE','CFDIFNEXT','CFDIFNINT','CFDIFCOL','CFDIFCP','CFDIFMUNICIPIO','CFDIFESTADO','CFDIFPAIS','CFDIFREFERENCIA','CFDIECALLE','CFDIENEXT','CFDIENINT','CFDIECOL','CFDIECP','CFDIEMUNICIPIO','CFDIEESTADO','CFDIEPAIS','CFDIEREFERENCIA','CFDIIMP','CFDIURL','CFDIPROVEEDOR','CFDIUSUARIO','CFDIPASSPAC','CFDICERPAC','CFDILLAVE','CFDIPASSCER','CFDICERCFDI','CFDIFECHADESPUES','CFDIFECHADESPUES1','CFDIFECHAANTES','CFDIFECHAANTES1','CFDICERSERIAL','CDFINUMAPROBACION','CFDIAÑOAPROBACION','CFDISERIE','CFDIDESDE','CFDIHASTA','CFDIULTIMO','FACTLOGO','CFDIVENCIMIENTOCHK','CFDIVENCIMIENTODATE','CFDIPAC','CFDIREGIMEN','CFDIREGIMENCVESAT','CFDIRUTADATA','CFDIRETENCIONES','CFDIUSUARIOMAIL','CFDICONTRASENAMAIL','CFDICORREOCOPIAMAIL','CFDIPUERTOMAIL','CFDISERVIDORMAIL','CFDITITULOMAIL','CFDIMENSAJEMAIL','CFDISMTP','CFDIUSUARIOMASCARA','CFDICOMPLEMENTO','sucursal','fecha_act','fecha_sync','flag_sucursales','eliminar','cfdiretivaprct','cfdiretisrprct','cfdiretisr'];
	
}
