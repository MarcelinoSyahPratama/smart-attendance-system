<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    //
use HasFactory;
use HasUuids;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'address',
        'status',
        'description',
    ];

    public function newUniqueId()
    {
        return (string) Uuid::uuid4()->toString();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
