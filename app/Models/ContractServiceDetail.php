<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContractServiceDetail
 * 
 * @property int $id
 * @property int $type
 * @property float $start_number
 * @property float $end_number
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon $input_date
 * @property int $status
 * @property Carbon|null $confirm_date
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ContractServiceDetail extends Model
{
	protected $table = 'contract_service_detail';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'type' => 'int',
		'start_number' => 'float',
		'end_number' => 'float',
		'status' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date',
		'input_date',
		'confirm_date'
	];

	protected $fillable = [
		'id',
		'id_contract',
		'type',
		'start_number',
		'end_number',
		'month',
		'year',
		'input_date',
		'status',
		'confirm_date'
	];
	public function contract(){
        return $this->hasOne(Contract::class, 'id', 'id_contract');
    }
	
}
