<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
  use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservationCountThisMonth(): int
    {
        $today = Carbon::today();
        return $this->reservations()
            ->whereYear('create_at', $this->year)
            ->whereMonth('ceate_at', $today->month)
            ->count();
    }

    public function canReserve(Lesson $lesson): bool
    {
        if ($lesson->remainingCount() === 0) {
            return false;
        }
        if ($this->plan === 'gold') {
            return true;
        }
        return $this->reservationCountThisMonth() < 5;
    }
}
