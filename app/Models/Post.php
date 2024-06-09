<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function createPost(array $data)
    {
        return self::create($data);
    }

    public function updatePost(array $data)
    {
        return $this->update($data);
    }

    public function deletePost()
    {
        return $this->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
