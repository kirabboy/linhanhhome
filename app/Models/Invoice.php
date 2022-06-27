<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 * 
 * @property int $id
 * @property int $id_contract
 * @property int $code
 * @property int $name
 * @property Carbon $date_create
 * @property Carbon $date_expired
 * @property float $amount_room
 * @property float $amount_electric
 * @property float $amount_water
 * @property float $amount_service
 * @property float $total
 * @property float $amount_paid
 * @property float $amount_rest
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Invoice extends Model
{
	protected $table = 'invoice';

	protected $casts = [
		
	];

	protected $dates = [
		'date_create',
		'date_expired'
	];

	protected $fillable = [
		'id_contract',
		'month',
		'year', 
		'code',
		'name',
		'date_create',
		'date_expired',
		'amount_room',
		'amount_electric',
		'amount_water',
		'amount_service',
		'total',
		'amount_paid',
		'amount_rest'
	];

	public function contract(){
		return $this->hasOne(Contract::class,'id', 'id_contract');
	} 
}
