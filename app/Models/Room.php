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
 * Class Room
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $id_floor
 * @property int $type
 * @property int $purpose
 * @property int $acreage
 * @property string $note
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Room extends Model
{
	use Slug;

	protected $table = 'rooms';

	protected $casts = [
		'floor_id' => 'int',
		'type' => 'int',
		'purpose' => 'int',
		'acreage' => 'int'
	];

	protected $fillable = [
		'code',
		'id',
		'building_id',
		'floor_id',
		'code',
		'name',
		'name_blog',
		'slug',
		'avatar',
		'type',
		'purpose',
		'acreage',
		'price',
		'note',
		'status',
		'asset',
		'description'
	];

	protected $attributes = [
        'avatar' => 'public/image/default-image.png'
    ];

	public static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = $model->createSlug($model->name_blog, $model->id ? $model->id : 0);
        }); 
        static::saved(function () {
			Cache::flush();
		 });
    }

	public function contract()
	{
		return $this->hasMany(Contract::class,'id_room', 'id');
	}

	public function building(){
		return $this->belongsTo(Building::class,'building_id', 'id');
	}
	public function floor(){
		return $this->belongsTo(Floor::class,'floor_id', 'id');
	}
}
