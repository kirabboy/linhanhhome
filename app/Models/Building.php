<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;
use Illuminate\Support\Facades\Cache;

/**
 * Class Building
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $adress
 * @property string $owner
 * @property string $owner_phone
 * @property string $owner_email
 * @property int|null $note
 * @property string|null $introduce
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Building extends Model
{
	use Slug;
	protected $table = 'buildings';

	protected $casts = [

	];

	protected $fillable = [
		'admin_id',
		'code',
		'name',
		'slug',
		'avatar',
		'address',
		'owner',
		'owner_phone',
		'number_floor',
		'owner_email',
		'note',
		'messenger',
		'google_map',
		'introduce',
		'price_room',
		'type_water'
	];
	protected $attributes = [
        'avatar' => 'public/image/default-image.png'
    ];

	public static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = $model->createSlug($model->name, $model->id ? $model->id : 0);
        });
		static::saved(function () {
			Cache::flush();
		 });
        
    }
	public function floor(){
		return $this->hasMany(Floor::class, 'building_id');
	}
	public function room(){
		return $this->hasMany(Room::class, 'building_id');
	}

	public function admin(){
		return $this->belongsTo(Admin::class, 'admin_id');
	}
}
