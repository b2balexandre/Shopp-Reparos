<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Helpers\BlogHelper;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'author_name',
        'category',
        'tags',
        'published',
        'published_at',
        'views',
        'reading_time'
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'tags' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if (empty($post->meta_title)) {
                $post->meta_title = $post->title;
            }
            if (empty($post->reading_time)) {
                $post->reading_time = self::calculateReadingTime($post->content);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if ($post->isDirty('content')) {
                $post->reading_time = self::calculateReadingTime($post->content);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getExcerptAttribute($value)
    {
        return $value ?: Str::limit(strip_tags($this->content), 160);
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    public function getReadingTimeTextAttribute()
    {
        return $this->reading_time ? $this->reading_time . ' min de leitura' : null;
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public static function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $wordsPerMinute = 200; // velocidade média de leitura
        return ceil($wordCount / $wordsPerMinute);
    }

    public function getMetaKeywordsStringAttribute()
    {
        return $this->meta_keywords ? implode(', ', $this->meta_keywords) : '';
    }

    public function getTagsStringAttribute()
    {
        return $this->tags ? implode(', ', $this->tags) : '';
    }

    public function getCanonicalUrlAttribute()
    {
        return url('/blog/' . $this->slug);
    }

    public function getShareUrlAttribute()
    {
        return $this->canonical_url;
    }

    public function getStructuredDataAttribute()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $this->title,
            'description' => $this->meta_description ?: $this->excerpt,
            'image' => $this->featured_image ? BlogHelper::getImageUrl($this->featured_image) : null,
            'author' => [
                '@type' => 'Organization',
                'name' => $this->author_name
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Shopp Reparos',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('img/logohorizontal.png')
                ]
            ],
            'datePublished' => $this->published_at?->toISOString(),
            'dateModified' => $this->updated_at->toISOString(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $this->canonical_url
            ]
        ];
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? BlogHelper::getImageUrl($this->featured_image) : null;
    }
}