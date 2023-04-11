<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monedero extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'monedero';

    protected $fillable = ['IdMonedero','sucursal','minimocompra','porcentajeregalo','duracionmeses','activo'];
	protected $primaryKey = 'IdMonedero';
}
