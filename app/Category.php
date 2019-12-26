<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'category';

 
    
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
