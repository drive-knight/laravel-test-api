<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Model
 * 
 * @property int $id
 * @property string|null $name
 * @property string $url
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'models';

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'url',
		'status'
	];
}
