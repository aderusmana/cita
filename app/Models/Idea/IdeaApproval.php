<?php

namespace App\Models\Idea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaApproval extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
}
