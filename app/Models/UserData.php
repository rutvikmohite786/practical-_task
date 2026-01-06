<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'users_data';
    
    protected $fillable = ['name', 'profile_pic', 'phone', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'user_hobby');
    }
}
