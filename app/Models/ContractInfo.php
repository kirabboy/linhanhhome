<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContractInfo
 * 
 * @property int $id
 * @property int $id_contract
 * @property int $amount_earnest
 * @property int $price_room
 * @property float $price_electric
 * @property float $price_water
 * @property int $type_water
 * @property float $price_service
 * @property int|null $number_room
 * @property int|null $number_electric
 * @property int|null $number_water
 * @property int|null $number_service
 * @property string|null $note_room
 * @property string|null $note_electric
 * @property string|null $note_water
 * @property string|null $note_service
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ContractInfo extends Model
{
	protected $table = 'contract_info';

	protected $casts = [
		'id_contract' => 'int',
		'amount_earnest' => 'int',
		'price_room' => 'int',
		'price_electric' => 'float',
		'price_water' => 'float',
		'type_water' => 'int',
		'price_service' => 'float',
		'number_room' => 'int',
		'number_electric' => 'int',
		'number_water' => 'int',
		'number_service' => 'int'
	];

	protected $fillable = [
		'id_contract',
		'amount_earnest',
		'price_room',
		'price_electric',
		'price_water',
		'type_water',
		'price_service',
		'number_room',
		'number_electric',
		'number_water',
		'number_service',
		'note_room',
		'note_electric',
		'note_water',
		'note_service'
	];
}
