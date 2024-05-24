<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'customers';

    public function notify_ref()
    {
        return $this->belongsTo(Notify::class, 'notify_id', 'id');
    }

    public function img_ref()
    {
        return $this->hasMany(Image::class, 'cus_id', 'id');
    }

    public function file_ref()
    {
        return $this->hasMany(File::class, 'cus_id', 'id');
    }

}
