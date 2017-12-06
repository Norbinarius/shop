<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    public $table = "bucket";

    protected $fillable = ['device_id', 'ordered', 'user_id'];

    public function device() {
        return $this->belongsTo(Devices::class,'device_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
