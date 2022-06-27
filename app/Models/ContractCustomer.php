<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContractCustomer
 * 
 * @property int $id
 * @property int $id_contract
 * @property int $id_customer
 * @property int|null $is_representative
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ContractCustomer extends Model
{
	protected $table = 'contract_customer';

	protected $casts = [
		'id_contract' => 'int',
		'id_customer' => 'int',
		'is_representative' => 'int'
	];

	protected $fillable = [
		'id_contract',
		'id_customer',
		'is_representative',
		'note',
	];
	public function customer(){
        return $this->hasOne(Customer::class, 'id', 'id_customer');
    }
}
