<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'text',
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
        'updated_at' => 'datetime:d.m.Y',
    ];

    #####################################################################
    # RELATIONS                                                         #
    #####################################################################

    public function stupenki()
    {
        return $this->belongsTo(Stupenka::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
