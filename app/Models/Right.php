<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Right extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'SFx1',
        'SFx2',
        'SFx3',
        'SFx4',
        'SFx5',
        'SFx6',
        'SFx7',
        'SFx8',
        'SFx9',
        'SFx10',
        'SFx11',
        'SFx12',
        'SFx13',
        'SFx14',
        'SFx15',
        'SFx16',
        'SFx17',
        'SFx18',
        'SFx19',
        'SFx20',
        'SFx21',
        'SFx22',
        'SFx23',
        'SFx24',
        'SFx25',
        'SFx26',
        'SFx27',
        'SFx28',
        'SFx29',
        'SFx30',
        'SFx31',
        'SFx32',
        'SFx33',
        'SFx34',
        'SFx35',
    ];
    
    public function users() 
    {
        return $this->hasMany(User::class);
    }
}
