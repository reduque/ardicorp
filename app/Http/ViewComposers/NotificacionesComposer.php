<?php
namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\ContenedorDocumento;

class NotificacionesComposer{
	public function compose(View $view){
		if (Auth::check()){
			$notificaciones=ContenedorDocumento::where('cargado',0)
			->join('documentosresponsables','contenedordocumentos.documentostipo_id','=','documentosresponsables.documentostipo_id')
			->join('contenedors','contenedor_id','=','contenedors.id')
			->where('documentosresponsables.user_id', Auth::user()->id)
			->groupBy('contenedors.id','contenedors.bl')
			->get(['contenedors.id', 'contenedors.bl']);
			$view->with('notificaciones', $notificaciones);
		}
	}
}