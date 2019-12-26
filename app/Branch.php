<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model 
{

    protected $table = 'branches';


    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

     
    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}


