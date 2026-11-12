<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Fires a user-facing notification — the single place every admin action
     * that should alert a customer (order status, sample stage, ticket
     * status) goes through, so the trigger list stays in one place.
     */
    public static function notifyUser(int $userId, string $title, ?string $description = null): void
    {
        static::create([
            'user_id'     => $userId,
            'title'       => $title,
            'description' => $description,
            'status'      => self::STATUS_UNREAD,
            'role'        => self::ROLE_USER,
        ]);
    }
}
