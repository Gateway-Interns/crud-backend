<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'address',
        'age',
        'gender',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function markNotificationAsRead($notificationId)
    {
        $this->notifications()->where('id', $notificationId)->update(['read_at' => now()]);
    }
    public function markAllNotificationsAsRead()
    {
        $this->unreadNotifications->markAsRead();
    }
    public function markNotificationAsunread($notificationId)
    {
        $notification = $this->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->update(['read_at' => null]);
        }
    }
    public function deleteNotification($notificationId)
    {
        $this->notifications()->where('id', $notificationId)->delete();
    }
    public function sendPassowrdResetNotification($token){
        $url = 'http://127.0.0.1:8000/reset-password'.$token;
     //   $this ->notify(new ResetPasswordNotification(url))
    }
}
