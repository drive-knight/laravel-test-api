<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stock
 * 
 * @property int $id
 * @property int $model_id
 * @property int|null $salon_id
 * @property int|null $color_id
 * @property int|null $year
 * @property int|null $price
 * @property float|null $power
 * @property bool $reserved
 * @property string|null $desc
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Stock extends Model
{
	protected $table = 'stock';

	protected $casts = [
		'model_id' => 'int',
		'salon_id' => 'int',
		'color_id' => 'int',
		'year' => 'int',
		'price' => 'int',
		'power' => 'float',
		'reserved' => 'bool'
	];

	protected $fillable = [
		'model_id',
		'salon_id',
		'color_id',
		'year',
		'price',
		'power',
		'reserved',
		'desc'
	];
}
