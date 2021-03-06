<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Template
 * 
 * @property int $id
 * @property string $name
 * @property int $time
 * @property string $number
 * @property Carbon $date
 * @property int $department
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Template extends Model
{
	use SoftDeletes;
	protected $table = 'template';

	protected $casts = [
		'time' => 'int',
		'department' => 'int',
		'accountsign' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'time',
		'number',
		'date',
		'department', 'accountsign'
	];

	public function Estimate()
	{
		return $this->hasMany('App\Models\Estimate', 'template', 'id');
	}
}
