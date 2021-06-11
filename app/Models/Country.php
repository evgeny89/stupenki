<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $appends = ['type'];

    #####################################################################
    # RELATIONS                                                         #
    #####################################################################

    public function stupenki()
    {
        return $this->hasMany(Stupenka::class);
    }

    #####################################################################
    # ACCESSORS                                                         #
    #####################################################################

    public function getTypeAttribute()
    {
        return 'country';
    }
}
