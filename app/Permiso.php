<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
	protected $guarded = ['id'];

//dependencias
    public function destino(){
        return $this->belongsTo('App\Destino');
    }
    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
