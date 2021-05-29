<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stupenka extends Model
{
    use HasFactory;

    protected $table = 'stupenki';

    protected $fillable = [
        'count',
        'location',
        'user_id',
    ];

    #####################################################################
    # RELATIONS                                                         #
    #####################################################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
