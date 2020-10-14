<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Templatedetail
 * 
 * @property int $id
 * @property int $template
 * @property int $evaluation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Templatedetail extends Model
{
	use SoftDeletes;
	protected $table = 'templatedetail';

	protected $casts = [
		'template' => 'int',
		'evaluation' => 'int'
	];

	protected $fillable = [
		'template',
		'evaluation'
	];
}
