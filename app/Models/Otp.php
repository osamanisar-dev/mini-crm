<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $guarded=[];

    public function employee(){
        return $this->hasOne(Otp::class);
    }
    use HasFactory;
}
