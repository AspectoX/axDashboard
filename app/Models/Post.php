<?php

namespace App\Models;

use App\Models\User;
use App\Models\Author;
use App\Models\Source;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 'category_id', 'source_id', 'author_id',
        'status', 'features',
        'title', 'slug', 'introtext', 'fulltext',
        'image','image_url','image_caption', 'image_credits',
        'gallery', 'gallery_url', 'gallery_caption','gallery_credits',
        'meta_decription', 'meta_key', 'meta_author',
    ];


    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function source():BelongsTo{
        return $this->belongsTo(Source::class);
    }

    public function author():BelongsTo{
        return $this->belongsTo(Author::class);
    }
}
