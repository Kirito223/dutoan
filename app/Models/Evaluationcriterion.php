<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluationcriterion
 * 
 * @property int $id
 * @property string $name
 * @property int $parentId
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $department
 *
 * @package App\Models
 */
class Evaluationcriterion extends Model
{
	protected $table = 'evaluationcriteria';

	protected $casts = [
		'parentId' => 'int',
		'department' => 'int'
	];

	protected $fillable = [
		'name',
		'parentId',
		'path',
		'department'
	];
}
