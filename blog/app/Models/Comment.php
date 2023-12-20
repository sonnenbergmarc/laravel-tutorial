<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author() //Laravel assumes foreign key is author_id which is why we have to be explicit.
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
