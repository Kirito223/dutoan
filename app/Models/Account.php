<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $unit
 * @property string $rememberToken
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
	use Notifiable;
	protected $table = 'account';

	protected $casts = [
		'unit' => 'int'
	];

	protected $hidden = [
		'password', 'rememberToken'
	];

	protected $fillable = [
		'username',
		'password',
		'unit',
	];
}
