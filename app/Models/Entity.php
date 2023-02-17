<?php

namespace App\Models;

use App\Models\Tweets\Entities\EntityDatabaseCollection;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $guarded = [];

    public function newCollection(array $models = [])
    {
        return new EntityDatabaseCollection($models);
    }
}
