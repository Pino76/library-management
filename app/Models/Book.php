<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory , SoftDeletes;

    public const TABLE_NAME = 'books';
    protected $table = self::TABLE_NAME;
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'isbn', 'author', 'genre_id', 'quantity', 'available', 'year'];


    public function genere(): HasOne
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user')
            ->withPivot('expire_date','borrowed_date','returned_date')
            ->withTimestamps();
    }
}
