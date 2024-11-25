<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'image',
        'image_path',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function metaData(): HasMany
    {
        return $this->hasMany(MetaData::class);
    }
}
