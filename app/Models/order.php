<?php

namespace App\Models;

use App\Models\prodect;
use App\Models\customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function customer(){
        return $this->belongsTo(customer::class);
        }
    public function prodect(){
        return $this->belongsTo(prodect::class);
    }
}
