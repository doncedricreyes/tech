<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model 
{

    protected $table = 'brands';

 

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function techsupport()
    {
        return $this->hasOne(Techsupport::class);
    }
}
