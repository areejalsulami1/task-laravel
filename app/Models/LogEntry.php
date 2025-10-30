<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    // خليه يشير لجدول logs بدل log_entries الافتراضي
    protected $table = 'logs';

    protected $fillable = ['user_id','action','details'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
