<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Report extends Model 
{

    protected $table = 'reports';


    public function repairs()
    {
        return $this->hasMany(Repair::class,'id','repair_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class,'id','ticket_id');
    }
}

  
