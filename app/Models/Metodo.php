<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'metodos';

    protected $fillable = ['idMetodo','descripcion'];
	
    protected $primaryKey = 'idMetodo';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebas()
    {
        return $this->hasMany('App\Models\Prueba', 'id_Metodo', 'idMetodo');
    }
    
}
