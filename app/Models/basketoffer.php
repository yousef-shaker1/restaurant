<?php

namespace App\Models;

use App\Models\offer;
use App\Models\customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class basketoffer extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function customer(){
        return $this->belongsTo(customer::class);
        }
    public function offer(){
        return $this->belongsTo(offer::class);
    }
}
