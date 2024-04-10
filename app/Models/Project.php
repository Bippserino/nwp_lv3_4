<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth;
use App\Models\User;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'start_date', 'end_date', 'user_id'
    ];

    protected $casts = [
        'user_id' => 'int',
    ];

    public function teamMembers()
    {
        return $this->belongsToMany(User::class)->withPivot('is_leader')->withTimestamps();
    }

    public function leader()
    {
        return $this->teamMembers()->wherePivot('is_leader', 1);
    }

    public function users() {
        $user_id = auth()->user();
        return $this->belongsToMany('App\Models\User', 'project_user')->wherePivot('user_id', $user_id);
    }
}
