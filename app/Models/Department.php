<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $commune
 * @property int $district
 * @property int $province
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $parentDepartment
 * @property string|null $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'department';

	protected $casts = [
		'commune' => 'int',
		'district' => 'int',
		'province' => 'int',
		'parentDepartment' => 'int'
	];

	protected $fillable = [
		'name',
		'address',
		'commune',
		'district',
		'province',
		'phone',
		'email',
		'parentDepartment',
		'path'
	];
	public function Estimate()
	{
		return $this->hasMany('App\Models\Estimate', 'unit', 'id');
	}
}
