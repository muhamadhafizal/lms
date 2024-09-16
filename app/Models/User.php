<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndAbilities, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['user_name', 'user_email', 'user_language', 'user_status'])
        ->useLogName('user')
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
        // Chain fluent methods for configuration options
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_email',
        'password',
        'user_language',
        'user_status',
        'email_verified_at',
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
            'user_status' => 'boolean',
        ];
    }

    // Define the polymorphic relationship
    public function activities()
    {
        return $this->hasMany(Activity::class,'causer_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function securityGroups()
    {
        return $this->belongsToMany(SecurityGroup::class)->withTimestamps();
    }

    public function scopeRole($query, $roles)
    {
        $query = $query->whereHas('roles', function ($q) use ($roles) {
            if (is_array($roles)) {
                $q->whereIn('name', $roles);
            } else {
                $q->where('name', $roles);
            }
        });

        return $query;
    }
}
