<?php

namespace App\Models\Idea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class standardData extends Model
{
    protected $table = 'standard_datas';
    use HasFactory;
    protected $fillable = [
        'name','value','year'
    ];
}
