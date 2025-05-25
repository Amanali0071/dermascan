<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDoctorChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'image',
    ];
    public function doctor()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function patient()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    // Message.php
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

}
