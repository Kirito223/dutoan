<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DevvnTinhthanhpho
 * 
 * @property string $matp
 * @property string $name
 * @property string $type
 *
 * @package App\Models
 */
class DevvnTinhthanhpho extends Model
{
	protected $table = 'devvn_tinhthanhpho';
	protected $primaryKey = 'matp';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'name',
		'type'
	];
}
