<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Evaluationcriterion
 * 
 * @property int $id
 * @property string $name
 * @property int|null $parentId
 * @property string|null $path
 * @property int $department
 * @property int $unit
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Evaluationcriterion extends Model
{
	use SoftDeletes;
	protected $table = 'evaluationcriteria';

	protected $casts = [
		'parentId' => 'int',
		'department' => 'int',
		'unit' => 'int'
	];

	protected $fillable = [
		'name',
		'parentId',
		'path',
		'department',
		'unit'
	];
}
