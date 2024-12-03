<?php

namespace App\Models\Idea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaLikes extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
}
