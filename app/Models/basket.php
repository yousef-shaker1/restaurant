<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basket extends Model
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
