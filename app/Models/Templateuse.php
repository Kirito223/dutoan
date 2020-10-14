<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Templateuse
 * 
 * @property int $id
 * @property int $template
 * @property int $department
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Templateuse extends Model
{
	use SoftDeletes;
	protected $table = 'templateuse';

	protected $casts = [
		'template' => 'int',
		'department' => 'int'
	];

	protected $fillable = [
		'template',
		'department'
	];
}
