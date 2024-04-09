<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'umur',
        'avatar'
    ];

    protected static $logAttributes = ['name', 'username'];

    protected static $igonoreChangedAttributes = ['updated_at'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Melakukan {$eventName} pada user";
    }

    public function getIsAdminAttribute()
    {
        return $this->hasRole('Rekam Medis');
    }
    
    public function getIsUserAttribute()
    {
        return $this->hasRole('Perawat');
    }

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}
