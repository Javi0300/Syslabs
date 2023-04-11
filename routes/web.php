<?php
use App\Models\Sucursales;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Deptos;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorAjaxController;
use App\Http\Controllers\EmpresaController;
use App\Http\Livewire\Estudios;
use App\Http\Controllers\DetalleGrupoAntibioticoController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PrecioDetalleController;
use App\Http\Controllers\Reportes\ReportePreciosController;
use App\Http\Controllers\RegistroResultadosController;
use App\Http\Controllers\CapturaResultadoController;

Route::get('/', function () {
    $sucursales = Sucursales::all();
    return view('auth.login', compact('sucursales'));
})->name('/');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('deptos', 'App\Http\Controllers\DepartamentoController')->middleware('auth');
Route::get('/deptos-pdf', [DepartamentoController::class, 'reportePDF'])->middleware('auth');
    
    Route::resource('doctores', 'App\Http\Controllers\DoctorController')->middleware('auth');
    Route::get('/doctores-pdf', [DoctorController::class, 'reportePDF'])->middleware('auth');

    Route::get('doctoresajax', [DoctorAjaxController::class, 'index'])->middleware('auth');
    Route::post('doctoresajaxstore', [DoctorAjaxController::class, 'store'])->middleware('auth');
    Route::post('doctoresajaxedit', [DoctorAjaxController::class, 'edit'])->middleware('auth');
    Route::post('doctoresajaxdestroy', [DoctorAjaxController::class, 'destroy'])->middleware('auth');



	Route::resource('empresas', 'App\Http\Controllers\EmpresaController')->middleware('auth');
    Route::get('/empresas-pdf', [EmpresaController::class, 'reportePDF'])->middleware('auth');

	//Route::view('pacientes', 'livewire.pacientes.index')->middleware('auth');
    Route::resource('pacientes', 'App\Http\Controllers\PacienteController')->middleware('auth');
    Route::post('pacientes.edit', [PacienteController::class, 'edit']);
    Route::get('/pacientes-pdf', [PacienteController::class, 'reportePDF'])->middleware('auth');


Route::resource('bacterias', 'App\Http\Controllers\BacteriaController')->middleware('auth');
Route::resource('antibioticos', 'App\Http\Controllers\AntibioticoController')->middleware('auth');
Route::resource('estudios', 'App\Http\Controllers\FormatoController')->middleware('auth');
Route::resource('metodos', 'App\Http\Controllers\MetodoController')->middleware('auth');

Route::resource('detallegrupoantibioticos', 'App\Http\Controllers\DetalleGrupoAntibioticoController')->middleware('auth');
Route::resource('pruebas', 'App\Http\Controllers\PruebaController')->middleware('auth');
Route::resource('valores', 'App\Http\Controllers\ValorController')->middleware('auth');

Route::resource('solicitudes', 'App\Http\Controllers\PruebaPacienteController')->middleware('auth');

Route::resource('paquetes', 'App\Http\Controllers\PaqueteController')->middleware('auth');
Route::resource('precios', 'App\Http\Controllers\PrecioController')->middleware('auth');
Route::resource('precios_detalle', 'App\Http\Controllers\PrecioDetalleController')->middleware('auth');
Route::get('/archivoExcel', [PrecioDetalleController::class, 'archivoExcel'])->middleware('auth');
Route::get('/exportarExcel', [PrecioDetalleController::class, 'exportarExcel'])->middleware('auth');
Route::get('/reporte', [ReportePreciosController::class, 'reportePDF'])->middleware('auth');

Route::post('importar/Excel', [PrecioDetalleController::class,'importarExcel'])->middleware('auth');

Route::resource('registro_resultados', 'App\Http\Controllers\RegistroResultadosController')->middleware('auth');
Route::POST('antibiograma', [RegistroResultadosController::class,'antibiogramaGA'])->middleware('auth');
Route::get('ver_antibiograma', [RegistroResultadosController::class,'ver_antibiograma'])->middleware('auth');
Route::get('guardarPDF', [RegistroResultadosController::class,'guardarPDF'])->middleware('auth')->name('guardarPDF');

Route::resource('monedero', 'App\Http\Controllers\MonederoController')->middleware('auth');

Route::resource('captura_resultados', 'App\Http\Controllers\CapturaResultadoController')->middleware('auth');
Route::get('crearformatocaptura', [CapturaResultadoController::class, 'CrearFormatoCaptura'])->name('crearformatocaptura');

Route::resource('filtros', 'App\Http\Controllers\FiltrosController')->middleware('auth');