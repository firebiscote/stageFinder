<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'grade',
        'comment',
        'company_id',
        'user_id',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function company() 
    {
        return $this->belongsTo(Company::class);
    }
}
