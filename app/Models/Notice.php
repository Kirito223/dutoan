<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notice
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $file
 * @property int $to
 * @property int $kind
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Notice extends Model
{
	protected $table = 'notice';

	protected $casts = [
		'kind' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'file',
		'to',
		'kind'
	];
}
