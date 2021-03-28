<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function offers() 
    {
        return $this->belongsToMany(Offer::class);
    }
    
    public function users() 
    {
        return $this->belongsToMany(User::class);
    }
}
