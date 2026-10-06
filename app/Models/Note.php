<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'content', 'is_done'];

    protected $casts = ['is_done' => 'boolean'];

    public function items()
    {
        return $this->hasMany(CheckList::class)->orderBy('is_done')->orderBy('id');
    }
}