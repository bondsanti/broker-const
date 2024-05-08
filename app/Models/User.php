<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $connection = 'mysql_user';
    protected $table = 'users';


    public function dep_ref()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function position_ref()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
