<?php

namespace App\Models;

use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Stupenka extends Model
{
    use HasFactory;
    use UploadImage;

    protected $table = 'stupenki';

    protected $fillable = [
        'count',
        'user_id',
        'image',
        'country',
        'city',
        'name',
    ];

    protected $appends = ['image_small', 'image_origin', 'image_high'];

    protected $with = ['city:name,id', 'country:name,id'];

    protected $withCount = ['comments'];

    protected $upload = [
        'origin' => null,
        'small' => '336x280',
        'optimal' => '640x480',
        'high' => '1024x768',
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
        'updated_at' => 'datetime:d.m.Y',
    ];

    protected $rootPathUpload = 'stupenki';

    #####################################################################
    # FUNCTIONS                                                         #
    #####################################################################

    //

    #####################################################################
    # RELATIONS                                                         #
    #####################################################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id');
    }

    #####################################################################
    # ACCESSORS                                                         #
    #####################################################################

    public function getImageOriginAttribute()
    {
        return  Storage::disk('public')->url('uploads/' . $this->rootPathUpload. '/origin/' . $this->image);
    }

    public function getImageSmallAttribute()
    {
        return  Storage::disk('public')->url('uploads/' . $this->rootPathUpload. '/small/' . $this->image);
    }

    public function getImageOptomalAttribute()
    {
        return  Storage::disk('public')->url('uploads/' . $this->rootPathUpload. '/optimal/' . $this->image);
    }

    public function getImageHighAttribute()
    {
        return  Storage::disk('public')->url('uploads/' . $this->rootPathUpload. '/high/' . $this->image);
    }
}
