<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Templateuse
 * 
 * @property int $id
 * @property int $template
 * @property int $department
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Templateuse extends Model
{
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
