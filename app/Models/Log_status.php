<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_status extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'logs_status';

    protected $fillable = ['user_id', 'cus_id', 'date_at'];

    // public function user_log_ref()
    // {
    //     return $this->belongsTo(User::class, 'id', 'user_id');
    // }
}
