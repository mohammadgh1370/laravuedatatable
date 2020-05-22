<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Info extends Model
{
    public static $blood_type = ['A+', 'B+', 'A-', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

    protected $fillable = [
        'user_id', 'weight', 'height', 'blood_type', 'birthday_at', 'address'
    ];

    protected $appends = ['shamsi_created_at'];

    /**
     * relation of bio with user.
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getShamsiCreatedAtAttribute()
    {
        return jdate($this->created_at)->format('Y/m/d H:i:s');
    }
}
