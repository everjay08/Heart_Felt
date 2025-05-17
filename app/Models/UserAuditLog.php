<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuditLog extends Model
{
    // Disable auto timestamps if you want to manually manage created_at, updated_at (optional)
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'old_value',    // singular - must match DB column
        'new_value',    // singular
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'old_value' => 'array',
        'new_value' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
