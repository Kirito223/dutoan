<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Roleaccount
 * 
 * @property int $id
 * @property int $role
 * @property int $account
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Roleaccount extends Model
{
	protected $table = 'roleaccount';

	protected $casts = [
		'role' => 'int',
		'account' => 'int'
	];

	protected $fillable = [
		'role',
		'account'
	];

	public function Account()
	{
		return $this->belongsTo('App\Models\Account', 'account');
	}
}
