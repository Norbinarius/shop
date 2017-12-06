<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $fillable = ['model_name', 'disc','price', 'image', 'ammount', 'company_id'];

    public function company() {
        return $this->belongsTo(Companies::class,'company_id');
    }
}
