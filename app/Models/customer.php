<?php

namespace App\Models;

use App\Models\order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function orders()
    {
        return $this->hasMany(order::class);
    }
}
