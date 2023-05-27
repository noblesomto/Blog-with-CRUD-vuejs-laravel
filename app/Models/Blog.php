<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id', 
        'blog_title', 
        'blog_desc', 
        'blog_picture', 
        'blog_status', 
    ];

    public function sluggable(): array
    {
        return [
            'blog_slug' => [
                'source' => 'blog_title'
            ]
        ];
    }
}
