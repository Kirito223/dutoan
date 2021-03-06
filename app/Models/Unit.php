<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Unit
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Unit extends Model
{
	use SoftDeletes;
	protected $table = 'unit';

	protected $fillable = [
		'name'
	];

	public function Evaluationcriterion()
	{
		return $this->hasMany('App\Models\Evaluationcriterion', 'unit',  'id');
	}
}
