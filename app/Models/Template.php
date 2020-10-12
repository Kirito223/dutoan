<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
 *
 * @package App\Models
 */
class Template extends Model
{
	protected $table = 'template';

	protected $casts = [
		'time' => 'int',
		'department' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'time',
		'number',
		'date',
		'department'
	];
}
