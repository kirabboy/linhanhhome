<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Floor
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Floor extends Model
{
	protected $table = 'floors';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'building_id',
		'code',
		'name'
	];
	public static function boot()
    {
        parent::boot();
        
        static::deleting(function($model) { 
            // before delete() method call this
            $model->building()->update(['number_floor' => DB::raw('number_floor - 1')]);
       });
        
    }
	public function building(){
		return $this->belongsTo(Building::class, 'building_id');
	}
	public function room(){
		return $this->hasMany(Room::class, 'floor_id');
	}
}
