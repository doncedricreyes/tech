<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Repair_Message extends Model
{
    use Notifiable;
    protected $table = 'repair_messages';
  
    public function techsupports(){
        return $this->hasMany(Techsupport::class,'id','sender_techsupport_id');
    }
    public function techsupport(){
        return $this->hasMany(Techsupport::class,'id','recipient_techsupport_id');
    }
    
    public function repairs(){
        return $this->hasMany(Repair::class,'id','sender_repair_id');
    }
    public function repair(){
        return $this->hasMany(Customers::class,'id','recipient_repair_id');
    }

    public function tickets(){
        return $this->hasMany(Ticket::class,'id','ticket_id');
    }

}