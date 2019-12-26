<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';


    public function inventory(){
        return $this->hasMany(Inventory::class,'id','inventory_id');
    }

    
    public function repairs(){
        return $this->hasMany(Repair::class,'id','repair_id');
    }


}

  
