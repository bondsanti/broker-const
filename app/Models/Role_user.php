<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'role_user';

    public function user_ref()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function position_ref()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
