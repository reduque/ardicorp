<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentosResponsable extends Model
{
    protected $table = 'documentosresponsables';
	protected $guarded = ['id'];
	public $timestamps = false;
}
