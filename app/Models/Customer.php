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

}
