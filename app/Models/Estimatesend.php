<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estimatesend
 * 
 * @property int $id
 * @property int $estimate
 * @property int $from
 * @property int $to
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Estimatesend extends Model
{
	protected $table = 'estimatesend';

	protected $casts = [
		'estimate' => 'int',
		'from' => 'int',
		'to' => 'int'
	];

	protected $fillable = [
		'estimate',
		'from',
		'to'
	];
}
