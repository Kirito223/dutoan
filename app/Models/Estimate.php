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
 * @property int $kind
 * @property string $file
 * @property bool $accept
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $template
 *
 * @package App\Models
 */
class Estimate extends Model
{
	protected $table = 'estimates';

	protected $casts = [
		'unit' => 'int',
		'kind' => 'int',
		'accept' => 'bool',
		'template' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'unit',
		'date',
		'kind',
		'file',
		'accept',
		'template'
	];
}
