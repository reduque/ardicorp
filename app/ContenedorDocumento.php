<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContenedorDocumento extends Model
{
    protected $table = 'contenedordocumentos';
	protected $guarded = ['id'];

    public function tipo(){
        return $this->belongsTo('App\DocumentoTipo','documentostipo_id');
    }
	public function archivos(){
		return $this->hasMany('App\Documento','contenedordocumento_id');
	}
}
