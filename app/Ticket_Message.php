<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Ticket_Message extends Model
{
    use Notifiable;
    protected $table = 'ticket_messages';
  
    public function techsupports(){
        return $this->hasMany(Techsupport::class,'id','sender_techsupport_id');
    }
    public function techsupport(){
        return $this->hasMany(Techsupport::class,'id','recipient_techsupport_id');
    }
    
    public function customers(){
        return $this->hasMany(Customer::class,'id','sender_customer_id');
    }
    public function customer(){
        return $this->hasMany(Customers::class,'id','recipient_customer_id');
    }

    public function tickets(){
        return $this->hasMany(Ticket::class,'id','ticket_id');
    }

}