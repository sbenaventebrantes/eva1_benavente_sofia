<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use HasFactory;

	protected $table = 'clients';

	protected $primaryKey = 'client_id';

	public $incrementing = true;

	protected $keyType = 'int';

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'phone_number',
		'date_of_birth',
	];

	protected $casts = [
		'date_of_birth' => 'date',
	];
}
