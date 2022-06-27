<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $fullname
 * @property int $type
 * @property string $phone
 * @property string $email
 * @property string $job
 * @property string $identification_number
 * @property string $identification_place
 * @property Carbon $identification_time
 * @property int $gender
 * @property Carbon $birthday
 * @property string $country
 * @property string $nationality
 * @property string $address
 * @property string|null $home_town
 * @property string|null $bank_number
 * @property string|null $bank_account
 * @property string|null $bank_name
 * @property string|null $note
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customer';

	protected $casts = [
		'type' => 'int',
		'gender' => 'int'
	];

	protected $dates = [
		'identification_time',
		'birthday'
	];
	public function getBirthdayAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }
	public function getIdentificationTimeAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }
	protected $fillable = [
		'admin_id',
		'code',
		'fullname',
		'type',
		'phone',
		'email',
		'job',
		'identification_number',
		'identification_place',
		'identification_time',
		'identification_address',
		'gender',
		'birthday',
		'country',
		'nationality',
		'address',
		'home_town',
		'bank_number',
		'bank_account',
		'bank_name',
		'bank_branch',
		'note'
	];
	public function contracts(){
        return $this->belongsToMany(Contract::class, 'contract_customer', 'id_customer', 'id_contract')->withPivot(['is_representative','note']);
    }

	public function contract_customer(){
		return $this->hasOne(ContractCustomer::class, 'id_customer', 'id');
	}

}
