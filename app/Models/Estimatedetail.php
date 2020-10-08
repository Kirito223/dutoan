<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estimatedetail
 * 
 * @property int $id
 * @property int $estimate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Estimatedetail extends Model
{
	protected $table = 'estimatedetail';

	protected $casts = [
		'estimate' => 'int'
	];

	protected $fillable = [
		'estimate'
	];
}
