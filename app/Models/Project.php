<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth;
use App\Models\User;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'start_date', 'end_date', 'user_id', 'tasks_completed'
    ];

    protected $casts = [
        'user_id' => 'int',
    ];

    // Get all members that are on the project
    public function teamMembers()
    {
        return $this->belongsToMany(User::class)->withPivot('is_leader')->withTimestamps();
    }
}
