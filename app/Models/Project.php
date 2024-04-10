<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'start_date', 'end_date', 'user_id'
    ];

    protected $casts = [
        'user_id' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class)->withPivot('is_leader')->withTimestamps();
    }

    public function leader()
    {
        return $this->teamMembers()->wherePivot('is_leader', true);
    }
}
