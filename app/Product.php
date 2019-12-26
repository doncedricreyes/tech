<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';


    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

  
