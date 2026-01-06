<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = ['name'];

    public function usersData()
    {
        return $this->belongsToMany(UserData::class, 'user_hobby');
    }
}
