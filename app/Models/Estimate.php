<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estimate
 * 
 * @property int $id
 * @property string $name
 * @property int $unit
 * @property Carbon $date
 * @property string $file
 * @property bool $accept
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Estimate extends Model
{
	protected $table = 'estimates';

	protected $casts = [
		'unit' => 'int',
		'accept' => 'bool'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'unit',
		'date',
		'file',
		'accept'
	];
}
