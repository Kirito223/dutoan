<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $date
 * @property int $creator
 * @property int $status
 * @property string $estimate
 * @property int $kind
 * @property int $signer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'report';

	protected $casts = [
		'creator' => 'int',
		'status' => 'int',
		'kind' => 'int',
		'signer' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'date',
		'creator',
		'status',
		'estimate',
		'kind',
		'signer', 'content'
	];

	public function Department()
	{
		return $this->belongsTo('App\Models\Department', 'creator');
	}

	public function Reportsend()
	{
		return $this->hasMany('App\Models\Reportsend', 'report', 'id');
	}
}
