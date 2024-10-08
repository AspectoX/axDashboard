<?php

namespace App\Models;

use App\Models\User;
use App\Models\Author;
use App\Models\Source;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'source_id', 'author_id',
        'status', 'features',
        'title', 'slug', 'introtext', 'fulltext',
        'publish_up','publish_down', 'updated_by',
        'imageintro', 'imageintro_title','imageintro_url', 'imageintro_caption', 'imageintro_credits',
        'image','image_url','image_caption', 'image_credits',
        'gallery', 'gallery_url', 'gallery_caption','gallery_credits',
        'video', 'video_url', 'video_caption', 'video_credits',
        'audio', 'audio_url', 'audio_caption', 'audio_credits',
        'meta_decription', 'meta_key', 'meta_author',
        'trash', 'access', 'hits', 'order', 'featured_ordering'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function article():BelongsTo{
        return $this->belongsTo(Article::class);
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
