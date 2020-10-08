<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DevvnXaphuongthitran
 * 
 * @property string $xaid
 * @property string $name
 * @property string $type
 * @property string $maqh
 *
 * @package App\Models
 */
class DevvnXaphuongthitran extends Model
{
	protected $table = 'devvn_xaphuongthitran';
	protected $primaryKey = 'xaid';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'name',
		'type',
		'maqh'
	];
}
