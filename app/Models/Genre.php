<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Genre extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'genres';
    protected $table = self::TABLE_NAME;
    protected $primaryKey = 'id';
    protected $fillable = ['name'];


    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
