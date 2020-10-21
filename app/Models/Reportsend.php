<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reportsend
 * 
 * @property int $id
 * @property int $report
 * @property int $from
 * @property int $to
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Reportsend extends Model
{
	protected $table = 'reportsend';

	protected $casts = [
		'report' => 'int',
		'from' => 'int',
		'to' => 'int'
	];

	protected $fillable = [
		'report',
		'from',
		'to'
	];
	public function Report()
	{
		return $this->belongsTo('App\Models\Report', 'report');
	}
}
