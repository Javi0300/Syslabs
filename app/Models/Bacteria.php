<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bacteria extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'bacterias';

    protected $fillable = ['idBacteria','descripcion'];
	
    protected $primaryKey = 'idBacteria';
}
