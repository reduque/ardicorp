<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoTipo extends Model
{
    protected $table = 'documentostipos';
	protected $guarded = ['id'];

	public function responsable(){
		return $this->belongsToMany('App\User', 'documentosresponsables', 'documentostipo_id', 'user_id');
	}
}
