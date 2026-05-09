<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'clients';

	protected $fillable = [
		'rut',
		'nombre',
		'apellido',
		'email',
		'telefono',
	];
}

