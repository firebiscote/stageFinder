<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'wage',
        'comment',
        'start',
        'end',
        'seat',
        'company_id',
        'locality_id',
    ];

    public function locality() 
    {
        return $this->belongsTo(Locality::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
