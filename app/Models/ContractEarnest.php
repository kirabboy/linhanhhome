<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContractEarnest
 * 
 * @property int $id
 * @property int $id_room
 * @property int $id_customer
 * @property string $code
 * @property string $name
 * @property float $price
 * @property Carbon $time_start
 * @property Carbon $time_end
 * @property string|null $note
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ContractEarnest extends Model
{
	protected $table = 'contract_earnest';

	protected $casts = [
		'id_room' => 'int',
		'id_customer' => 'int',
		'price' => 'float'
	];

	protected $dates = [
		'time_start',
		'time_end'
	];

	protected $fillable = [
		'id_room',
		'id_customer',
		'type',
		'code',
		'name',
		'price',
		'time_start',
		'time_end',
		'note'
	];
}
