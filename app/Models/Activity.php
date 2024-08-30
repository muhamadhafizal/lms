<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    public function scopeSearch($query, $request)
    {
        if ($request->search) {
            $query->where('log_name', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%')
                ->orWhere('event', 'like', '%'.$request->search.'%')
                ->orWhereHas('user', function ($user) use ($request) {
                    $user->where('user_name', 'like', '%'.$request->search.'%');
                });
        }

        return $query;
    }
}