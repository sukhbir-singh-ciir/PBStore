<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaData extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'author_id',
        'meta_title',
        'meta_description',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}

