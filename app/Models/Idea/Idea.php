<?php

namespace App\Models\Idea;

use App\Models\Master\Category;
use App\Models\Master\Department;
use App\Models\Master\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Idea extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ideaApproval()
    {
        return $this->hasMany(IdeaApproval::class);
    }

    public function ideaFile()
    {
        return $this->hasMany(IdeaFiles::class);
    }

    public function ideaLike()
    {
        return $this->hasMany(IdeaLikes::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'idea_likes');
    }

    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function ideaFiles()
    {
        return $this->hasMany(IdeaFiles::class);
    }

    public function approvals()
    {
        return $this->hasMany(IdeaApproval::class);
    }

    protected static function booted()
    {
        static::saving(function ($idea) {
            $idea->slug = Str::slug($idea->title);
        });
    }
}
