<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Noticereciver
 * 
 * @property int $id
 * @property int $notice
 * @property int $to
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Noticereciver extends Model
{
	protected $table = 'noticereciver';

	protected $casts = [
		'notice' => 'int',
		'to' => 'int'
	];

	protected $fillable = [
		'notice',
		'to'
	];
}
