<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $table = 'commission';

    protected $fillable = ['admin_id', 'contract_id', 'amount', 'status'];

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function contract(){
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }
}
