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
        'location',
        'user_id',
        'image',
        'country',
        'city',
        'name',
    ];

    protected $appends = ['image_small', 'image_origin'];

    protected $upload = [
        'origin' => null,
        'small' => '336x280',
        'optimal' => '640x480',
        'high' => '1024x768',
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
