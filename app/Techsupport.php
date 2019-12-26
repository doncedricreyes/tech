<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\TechsupportResetPasswordNotification;

class Techsupport extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'techsupport';
    protected $table = 'techsupports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','email', 'password','contact','role','status'
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
        $this->notify(new TechsupportResetPasswordNotification($token));
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function ticket_message()
    {
        return $this->belongsTo(Ticket_Message::class);
    }

    public function repair_message()
    {
        return $this->belongsTo(Repair_Message::class);
    }
 
}
