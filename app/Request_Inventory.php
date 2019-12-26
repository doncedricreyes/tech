<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Request_Inventory extends Model 
{

    protected $table = 'request_inventory';


    public function repairs()
    {
        return $this->hasMany(Repair::class,'id','repair_id');
    }

}

  
