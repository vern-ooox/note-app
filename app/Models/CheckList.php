<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    protected $fillable = ['note_id', 'text', 'is_done'];

    protected $casts = ['is_done' => 'boolean', ];
}
