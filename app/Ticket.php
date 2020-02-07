<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{

    protected $table = 'tickets';


    public function customers()
    {
        return $this->hasMany(Customer::class,'id','customer_id');
    }

    
    public function products()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }

    public function techsupports()
    {
        return $this->hasMany(Techsupport::class,'id','techsupport_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class,'id','branch_id');
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class,'id','repair_id');
    }
    public function ticket_message()
    {
        return $this->belongsTo(Ticket_Message::class);
    }

    public function ticket_repair()
    {
        return $this->belongsTo(Ticket_Repair::class);
    }

    public function repair_message()
    {
        return $this->belongsTo(Repair_Message::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}

  
