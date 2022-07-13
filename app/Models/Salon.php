<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Salon
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Salon extends Model
{
	protected $table = 'salons';

	protected $casts = [
		'city_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'city_id',
		'status'
	];
}
