<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    protected $table = 'contenedors';
	protected $guarded = ['id'];
//dependencias
    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }
    public function planta(){
        return $this->belongsTo('App\PlantaProcesadora','plantasprocesadora_id');
    }
    public function naviera(){
        return $this->belongsTo('App\Naviera','naviera_id');
    }
    public function agente(){
        return $this->belongsTo('App\Agentes','agentesaduanal_id');
    }
    public function permiso(){
        return $this->belongsTo('App\Permiso','permiso_id');
    }

	public function documentos(){
		return $this->hasMany('App\ContenedorDocumento');
	}
}
