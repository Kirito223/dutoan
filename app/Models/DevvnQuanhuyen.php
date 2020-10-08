<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DevvnQuanhuyen
 * 
 * @property string $maqh
 * @property string $name
 * @property string $type
 * @property string $matp
 *
 * @package App\Models
 */
class DevvnQuanhuyen extends Model
{
	protected $table = 'devvn_quanhuyen';
	protected $primaryKey = 'maqh';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'name',
		'type',
		'matp'
	];
}
