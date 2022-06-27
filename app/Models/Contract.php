<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * 
 * @property int $id
 * @property int $id_room
 * @property int $name
 * @property int $type
 * @property Carbon $time_start
 * @property Carbon $time_end
 * @property Carbon $time_charge
 * @property int $is_earnest
 * @property float|null $amount_is_earnest
 * @property string $note
 * @property int $status
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Contract extends Model
{
	protected $table = 'contract';

	protected $casts = [
		'id_room' => 'int',
		'type' => 'int',
		'is_earnest' => 'int',
		'amount_is_earnest' => 'float',
		'status' => 'int'
	];

	protected $dates = [
		'time_start',
		'time_end',
		'time_charge'
	];

	protected $fillable = [
		'id_room',
		'name',
		'code',
		'type',
		'time_start',
		'time_end',
		'time_charge',
		'is_earnest',
		'amount_is_earnest',
		'note',
		'status'
	];

	public function contractinfo(){
        return $this->hasOne(ContractInfo::class, 'id_contract', 'id');
    }
	public function room(){
        return $this->hasOne(Room::class, 'id', 'id_room');
    }
	
	public function building(){
        return $this->belongsToOne(Building::class, 'room', 'building_id', 'id_room');
    }

	public function customers(){
        return $this->belongsToMany(Customer::class, 'contract_customer', 'id_contract', 'id_customer')->withPivot(['is_representative','note']);
    }

	public function customer(){
        return $this->belongsToOne(Customer::class, 'contract_customer', 'id_contract', 'id_customer')->withPivot(['is_representative','note']);
    }

	public function service_detail(){
		return $this->hasMany(ContractServiceDetail::class, 'id_contract', 'id');
	}
	public function contract_customer(){
		return $this->hasMany(ContractCustomer::class, 'id_contract', 'id');
	}

	public function invoices(){
		return $this->hasMany(Invoice::class, 'id_contract', 'id');

	}
}
