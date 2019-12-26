<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Ticket_Repair extends Model
{
    use Notifiable;
    protected $table = 'ticket_repairs';
  


    
    public function repairs(){
        return $this->hasMany(Repair::class,'id','repair_id');
    }


    public function tickets(){
        return $this->hasMany(Ticket::class,'id','ticket_id');
    }

}