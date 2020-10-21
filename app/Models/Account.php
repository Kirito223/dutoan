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
 * @property string|null $rememberToken
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Account extends Model
{
	protected $table = 'account';

	protected $casts = [
		'unit' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'unit',
		'rememberToken',
		'name'
	];

	public function Estimate()
	{
		return $this->hasMany('App\Models\Estimate', 'accountsign', 'id');
	}
	public function Roleaccount()
	{
		return $this->hasMany('App\Models\Roleaccount', 'account', 'id');
	}
}
