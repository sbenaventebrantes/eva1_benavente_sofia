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

	protected $appends = ['rut', 'nombre', 'apellido', 'telefono'];

	/**
	 * Accessors para mapear campos en inglés a español
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

	/**
	 * Mutators para mapear campos en español a inglés
	 */
	public function setRutAttribute($value)
	{
		$this->attributes['dni'] = $value;
	}

	public function setNombreAttribute($value)
	{
		$this->attributes['first_name'] = $value;
	}

	public function setApellidoAttribute($value)
	{
		$this->attributes['last_name'] = $value;
	}

	public function setTelefonoAttribute($value)
	{
		$this->attributes['phone_number'] = $value;
	}
}

