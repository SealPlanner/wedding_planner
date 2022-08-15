<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = ['location','date','total_budget','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
