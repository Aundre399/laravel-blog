<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //protected $guarded = [];

    //protected $fillable = ['title', 'excerpt', 'body'];

    //protected $with = ['category','author'];

    //search filter for post controller
    public function scopefilter($query, array $filters)
    {
        $query->when($filters ['search'] ?? false, function($query, $search){

            $query
            ->where('title', 'like', '%' . $search . '%')
            ->orwhere('body', 'like', '%' . $search . '%');

        });

        $query->when($filters ['categoty'] ?? false, function($query, $category)
        {
            $query->whereHas('category', function($query, $category)
            {
                $query->where ('slug', $category);
            });

            //$query
            // ->whereExists (function($query, $category){
            //     $query
            //     ->from('categories')
            //     ->whereColumn('category.id', 'posts.category_id')
            //     ->where('category.slug', $category );
            // });


        });


    }

    public function comments()
    {
        return $this-> hasmany(Comment::class);
    }

    public function Category()
    {
        return $this-> belongsTo(Category::class);

    }

    public function author()
    {
        return $this-> belongsTo(user::class, 'user_id');
    }
}
