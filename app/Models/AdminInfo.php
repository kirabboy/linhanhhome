<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminInfo
 * 
 * @property int $id
 * @property int $admin_id
 * @property string|null $fullname
 * @property string|null $email
 * @property string|null $phone
 * @property Carbon|null $birthday
 * @property int|null $gender
 * @property string|null $address
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class AdminInfo extends Model
{
	protected $table = 'admin_info';

	protected $casts = [
		'admin_id' => 'int',
		'gender' => 'int'
	];

	protected $dates = [
		'birthday'
	];

	protected $fillable = [
		'admin_id',
		'fullname',
		'email',
		'phone',
		'birthday',
		'gender',
		'address'
	];
	public function getBirthdayAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
