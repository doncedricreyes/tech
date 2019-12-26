<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model 
{

    protected $table = 'inventory';


    public function category(){
        return $this->hasMany(Category::class,'id','category_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

  
