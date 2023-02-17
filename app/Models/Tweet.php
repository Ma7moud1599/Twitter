<?php

namespace App\Models;

use App\Models\Tweets\Entities\EntityExtractor;
use App\Models\Tweets\Entities\EntityType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function (Tweet $tweet) {
            $tweet->entities()->createMany(
                (new EntityExtractor($tweet->body))->getAllEntities()
            );
        });
    }

    /**
     * Undocumented function
     *
     * @param  Builder  $builder
     * @return void
     */
    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function originalTweet()
    {
        return $this->hasOne(Tweet::class, 'id', 'original_tweet_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function retweets()
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function retweetedTweet()
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function media()
    {
        return $this->hasMany(TweetMedia::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function replies()
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mentions()
    {
        return $this->hasMany(Entity::class)
            ->whereType(EntityType::MENTION);
    }
}
