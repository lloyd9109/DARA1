<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'otps';
    protected $primaryKey = 'otp_id';
    protected $fillable = ['email', 'otp_code', 'expires_at', 'is_used'];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
