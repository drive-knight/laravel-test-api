<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Color
 * 
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Color extends Model
{
	protected $table = 'colors';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
