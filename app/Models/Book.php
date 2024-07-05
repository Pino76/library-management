<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'books';
    protected $table = self::TABLE_NAME;
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'isbn', 'author', 'genre_id', 'quantity', 'reserve', 'year'];


    public function genere(): HasOne
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }
}
