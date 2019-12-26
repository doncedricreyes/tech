<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\RepairResetPasswordNotification;

class Repair extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'repair';
    protected $table = 'repairs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','email', 'password','contact','address','role','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RepairResetPasswordNotification($token));
    }

 
    public function branches(){
        return $this->hasMany(Branch::class,'id','branch_id');
    }

    public function ticket_repair()
    {
        return $this->belongsTo(Ticket_Repair::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function repair_message()
    {
        return $this->belongsTo(Repair_Message::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function request_inventory()
    {
        return $this->belongsTo(Request_Inventory::class);
    }
}
