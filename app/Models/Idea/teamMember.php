<?php

namespace App\Models\Idea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teamMember extends Model
{
    protected $fillable = [
        'idea_id','leader_id', 'member_id'
    ];
    use HasFactory;
}

