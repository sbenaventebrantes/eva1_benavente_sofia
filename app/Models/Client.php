<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'clients';

	protected $fillable = [
		'first_name',
		'last_name',
		'dni',
		'email',
		'phone_number',
		'date_of_birth',
	];

	protected $hidden = [
		'first_name',
		'last_name',
		'dni',
		'phone_number',
		'date_of_birth',
		'created_at',
		'updated_at',
	];

	protected $appends = ['rut', 'nombre', 'apellido', 'telefono'];

	/**
	 * Accessors para mapear campos en inglés a español en las respuestas
	 */
	public function getRutAttribute()
	{
		return $this->attributes['dni'] ?? null;
	}

	public function getNombreAttribute()
	{
		return $this->attributes['first_name'] ?? null;
	}

	public function getApellidoAttribute()
	{
		return $this->attributes['last_name'] ?? null;
	}

	public function getTelefonoAttribute()
	{
		return $this->attributes['phone_number'] ?? null;
	}
}



